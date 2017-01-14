from twisted.internet.protocol import Factory, Protocol
from twisted.internet import reactor

class IphoneChat(Protocol):
	def connectionMade(self):
		print "a client connected"

	def connectionMade(self):
		self.factory.clients.append(self)
		print "clients are ", self.factory.clients

	def connectionLost(self, reason):
		self.factory.clients.remove(self)

	def dataReceived(self, data):
		data.yup

	def message(self, message):
        	self.transport.write(message + '\n')

factory = Factory()
factory.clients = []
factory.protocol = IphoneChat
reactor.listenTCP(80, factory)
print "Iphone Chat server started"
reactor.run()
