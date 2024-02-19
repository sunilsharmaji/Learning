'''
1. Parking spaces
2. Vehicle - Type, registratio number
3. Multi story parking
4. Exit
5. Entry
6. Payment
7. Inventry
8. Ticket
'''
from enum import Enum
class VehicleType(Enum):
    Small = 1
    Medium = 2
    Large = 3
    ExtraLarge = 4




class ParkingLot:
    def __init__(self, spaces, story)
        # self.parkings = [[{i:False} for i in range(j+1,j+1+spaces)] for j in range(0,story*spaces, spaces)]
        self.parkings = {}

        for i in range(1,story+1):
            for j in range(spaces):
                self.parkings[str(i)+","+str(j)] = False

    def getParking(self):
        for parking, status in self.parkings:
            if status == False:
                return parking
        return None
    
    def allotParking(self, parking, tick):

    



        

class Vehicle:
    def __init__(self, reg_no, size):
        self.reg_no = reg_no
        self.size = size

class Ticket:
    def __init__(self, VehicleType, reg_no) -> None:
        self.VehicleType = VehicleType
        self.reg_no = reg_no
        self.enter_time = time.time()
    


