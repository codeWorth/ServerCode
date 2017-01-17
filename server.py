from twisted.internet.protocol import Factory, Protocol
from twisted.internet import reactor
import random

class Game:
    def __init__(self, player1, player2):
        self.player1 = player1
        self.player2 = player2
        self.player1Pending = []
        self.player2Pending = []
        self.history = []
        self.canSend1 = True
        self.canSend2 = True
        self.accepted1 = False
        self.accepted2 = False
        self.player1.game = self
        self.player1.isP1 = True
        self.player2.game = self

    def processMessageOnSend(self, message, destPlayer):
        if (message[1] == "q"):
            self.endGame(message)
        elif (message[1] == "e"):
            destPlayer.message("<s")

    def tryPopPending1(self):
        if (self.canSend1 and len(self.player1Pending) > 0):
            msg = self.player1Pending.pop(0)
            
            if (msg[0] == ">"):
                self.player1.message(msg)
                self.history.append(msg)
            elif (msg[0] == "<"):
                self.processMessageOnSend(msg, self.player1)
            else:
                self.player1.message(msg)
            
            self.canSend1 = False

    def tryPopPending2(self):
        if (self.canSend2 and len(self.player2Pending) > 0):
            msg = self.player2Pending.pop(0)
            
            if (msg[0] == ">"):
                self.player2.message(msg)
                self.history.append(msg)
            elif (msg[0] == "<"):
                self.processMessageOnSend(msg, self.player2)
            else:
                self.player2.message(msg)
                
            
            self.canSend2 = False

    def addMessage(self, player, message):
        if (player.isP1):
            self.player2Pending.append(message)
            self.tryPopPending2()
        else:
            self.player1Pending.append(message)
            self.tryPopPending1()
        
    def recievedConfirm(self, player):
        if (player.isP1):
            self.canSend1 = True
            self.tryPopPending1()
        else:
            self.canSend2 = True
            self.tryPopPending2()
        

    def hasPlayer(self, player):
        if (player == self.player1 or player == self.player2):
            return True
        else:
            return False

    def playerAccepted(self, player):
        if (player.isP1):
            print("P1",player,"accepted")
            self.accepted1 = True
        else:
            print("P2",player,"accepted")
            self.accepted2 = True

        if (self.accepted1 and self.accepted2):
            mm_games.append(self)
            mm_requests.remove(self)
            self.addMessage(self.player1, "c" + self.player1.ID)
            self.addMessage(self.player2, "c" + self.player2.ID)

            print("Game created with", self.player1, "and", self.player2)

            firstPlayer = round(random.random() * 2)
            if (firstPlayer == 0):
                self.addMessage(self.player1, "<e")
            else:
                self.addMessage(self.player2, "<e")

    def endGame(self, endMessage):
        print("Ending game",self)
        
        self.player1.message(endMessage)
        self.player2.message(endMessage)
        
        if (self.accepted1 and self.accepted2):
            mm_games.remove(self)
        else:
            mm_requests.remove(self)
            

        self.player1.reset()
        self.player2.reset()

class IphoneClient(Protocol):
    rank = 0
    name = ""
    ID = 0
    game = None
    isP1 = False
    
    def connectionMade(self):
        print("a client connected")

    def connectionMade(self):
        self.factory.clients.append(self)
        print("clients are ", self.factory.clients)

    def connectionLost(self, reason):
        self.factory.clients.remove(self)

    def dataReceived(self, data):
        print("From", self, ":", data)
        if(data[0] == "<"):
            self.processControlMessage(data)
        elif(data[0] == ">"):
            self.processGameMessage(data)
        elif(data[0] == "^"):
            self.processQueueMessage(data)

    def message(self, message):
        print("To", self, ":", message)
        self.transport.write(message + '\n')

    def processControlMessage(self, message):
        if (message[1] == "p"):
            self.game.recievedConfirm(self)
        else:
            self.game.addMessage(self, message)
        

    def processGameMessage(self, message):
        self.game.addMessage(self, message)

    def attemptMatchPlayer(self):
        print("Player", self, "added to queries")
        mm_queries.append(self)
        
        for player in mm_queries[:-1]:
            if (player.rank == self.rank):
                game = Game(self, player)
                mm_requests.append(game)
                mm_queries.remove(self)
                mm_queries.remove(player)

                self.message("j")
                player.message("j")
                print("Match request created, players:", self, player)
                return

    def reset(self):
        self.game = None
        self.isP1 = False

    def processQueueMessage(self, message):
        if (message[1] == 'n'):
            parts = message.split("u")
            info = parts[0]
            username = parts[1]
            
            self.rank = int(info[2:])
            self.name = username

            self.attemptMatchPlayer()
        elif (message[1] == 'a'):
            if (self.game):
                self.ID = message[2:]
                self.game.playerAccepted(self)
            else:
                print("Error, no game in list for player", self)

        elif (message[1] == 'c'):
            if (self.game == None):
                mm_queries.remove(self)
                print("Player", self, "removed from queries")
            else:
                self.game.endGame("r")


mm_queries = []
mm_requests = []
mm_games = []
                                     
factory = Factory()
factory.clients = []
factory.protocol = IphoneClient
reactor.listenTCP(800, factory)
print("Iphone server started")
reactor.run()
