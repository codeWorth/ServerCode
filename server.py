from twisted.internet.protocol import Factory, Protocol from
twisted.internet import reactor

class Game:
    def __init__(self, player1, player2):
        self.player1 = player1
        self.player2 = player2
        self.player1Pending = []
        self.player2Pending = []
        self.history = []
        self.canSend1 = True
        self.canSend2 = True

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

class IphoneChat(Protocol):
    def connectionMade(self):
        print "a client connected"

    def connectionMade(self):
        self.factory.clients.append(self)
        print "clients are ", self.factory.clients

    def connectionLost(self, reason):
        self.factory.clients.remove(self)

    def dataReceived(self, data):
        if(data[0] == "<"):
            self.processControlMessage(data[1:])
        elif(data[0] == ">"):
            self.processGameMessage(data[1:])
        elif(data[0] == "^"):
            self.processQueueMessage(data[1:)

    def message(self, message):
        self.transport.write(message + '\n')

    def processControlMessage(self, message):

    def processGameMessage(self, message):

    def processQueueMessage(self, message):

factory = Factory()
factory.clients = []
factory.protocol = IphoneChat
reactor.listenTCP(80, factory)
print "Iphone Chat server started"
reactor.run()
