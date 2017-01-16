from twisted.internet.protocol import Factory, Protocol
from twisted.internet import reactor

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

    def tryPopPending1(self):
        if (self.canSend1 and len(self.player1Pending) > 0):
            msg = self.player1Pending.pop(0)
            
            self.player1.transport.write(msg + "\n")
            if (msg[0] == ">"):
                self.history.append(msg)
            
            self.canSend1 = False

    def tryPopPending2(self):
        if (self.canSend2 and len(self.player2Pending) > 0):
            msg = self.player2Pending.pop(0)
            
            self.player2.transport.write(msg + "\n")
            if (msg[0] == ">"):
                self.history.append(msg)
            
            self.canSend2 = False

    def addMessageFrom1(self, message):
        self.player2Pending.append(message)
        self.tryPopPending2()

    def addMessageFrom2(self, message):
        self.player1Pending.append(message)
        self.tryPopPending1()

    def recievedConfirm1(self):
        self.canSend1 = True
        self.tryPopPending1()

    def recievedConfirm2(self):
        self.canSend2 = True
        self.tryPopPending2()

    def hasPlayer(self, player):
        if (player == self.player1 or player == self.player2):
            return True
        else:
            return False

class IphoneClient(Protocol):
    rank = 0
    name = ""
    
    def connectionMade(self):
        print("a client connected")

    def connectionMade(self):
        self.factory.clients.append(self)
        print("clients are ", self.factory.clients)

    def connectionLost(self, reason):
        self.factory.clients.remove(self)

    def dataReceived(self, data):
        print(data[0])
        if(data[0] == "<"):
            self.processControlMessage(data)
        elif(data[0] == ">"):
            self.processGameMessage(data)
        elif(data[0] == "^"):
            self.processQueueMessage(data)

    def message(self, message):
        self.transport.write(message + '\n')

    def processControlMessage(self, message):
        print("oops")

    def processGameMessage(self, message):
        print("oops")

    def attemptMatchPlayer(self):
        print("attempting to match player with name ", self.name, " and rank ", self.rank)
        for player in mm_queries:
            if (player.rank == self.rank):
                game = Game(self, player)
                mm_requests.append(game)
                mm_queries.remove(self)
                mm_queries.remove(player)

                self.message("j")
                player.message("j")
                print("Match request created, players: ", self, ", ", player)
                return

        print("Player ", self, "added to queries")
        mm_queries.append(self)

    def processQueueMessage(self, message):
        if (message[1] == 'n'):
            parts = message.split("u")
            info = parts[0]
            username = parts[1]
            
            self.rank = int(info[2:])
            self.name = username

            self.attemptMatchPlayer()
        elif (message[1] == 'a'):
            game = gameContainingPlayer(mm_requests, self)
            if (game):
                game.playerAccepted(self)
                print("Player ", self, " accepted game request")
            else:
                print("Error, no game in list for player ", self)


mm_queries = []
mm_requests = []
mm_games = []

def gameContainingPlayer(listOfGames, player):
    for game in listOfGames:
        if (game.hasPLayer(player)):
            return game

    return
                                     
factory = Factory()
factory.clients = []
factory.protocol = IphoneClient
reactor.listenTCP(800, factory)
print("Iphone server started")
reactor.run()
