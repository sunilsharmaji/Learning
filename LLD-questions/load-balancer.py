# Server class
class Server:
    def __init__(self, serverId:) -> None:
        self.isHealthy = True
        self.serverId = serverId
    
    def setHealthy(self, healthy):
        self.isHealthy = healthy
    
    def isHealthy(self):
        return self.isHealthy
    
# Load balancer
class LoadBalancer:
    instance = None
    servers = []
    strategy = None
    @staticmethod
    def getSingleton():
        if instance == None:
            instance = LoadBalancer()
        return instance
    
    def addServer(self, server: Server):
        self.servers.append(server)

    def removeServer(self, server):
        self.servers.remove(server)
    
    def loadBalancingStrategy(self, strategy):
        self.strategy = strategy
    
    def getServer(self, request):
        return self.strategy.getServer(self.servers, request)

class LeastConnectionStrategy:
    def __init__(self) -> None:
        self.minconnection = 10

    
    def getServer(self, servers):
        for server in servers: 
            if server.isHealthy():
                connections = self.getConnections(server)
                if (connections < minConnections):
                    minConnections = connections
                    selectedServer = server
        return selectedServer


    def getConnections(self, server):
        return 0           
            
        


if __name__ == "__main__":
    server1 = Server("sever1")
    server2 = Server("sever2")

    LoadBalancer = LoadBalancer.getSingleton()
    LoadBalancer.addServer(server1)
    LoadBalancer.addServer(server2)

    strategy = RoundRobinStrategy()
    LoadBalancer.loadBalancingStrategy(strategy)

    request1 = input()
