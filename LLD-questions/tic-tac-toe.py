'''
It is a two player game.
it is a 3*3 matrix
to win the game either in the row or in column or diagonally same 0 or 1 be placed
'''
from collections import deque
from enum import Enum
import random
# Game state
class state(Enum):
    not_started: 0
    in_progress: 1
    completed: 2
    tie: 3


class Board:
    def __init__(self, size):
        self.size = size
        self.grid = [[-1]* self.size for _ in range(self.size)]
        self.choices = [ i for i in range(self.size**2)]

    def displayBoard(self):
        print("--------")
        for i in range(self.size):
            for j in range(self.size):
                print(self.grid[i][j], end=" ")
            print("\n")

    def updateCell(self, val, point):
        row, col = point
        self.grid[row][col] = val

    
    def random(self):
        return random.choice(self.choices)
    
    def getCell(self, pos):
        row = pos // self.size
        col = pos % self.size
        return row, col
    

class Player:
    def __init__(self, id: int, name:str):
        self.id = id
        self.name = name
    
# Game Base class
class ticTacToe:
    def __init__(self, board: Board):
        self.state = "not_started"
        self.players = []
        self.winner = None
        self.board = board
        self.queue = deque([])

    def play(self):
        self.state = "in_progress"
        while self.queue and self.state == "in_progress":
            
            curr_player = self.queue.popleft()
            pos = self.board.random()
            # print(pos)
            self.board.choices.remove(pos)
            cell = self.board.getCell(pos)
            # print("cell ",cell)
            self.board.updateCell(curr_player.id, cell)
            self.board.displayBoard()
            if self.checkWinCondition(cell):
                self.winner = curr_player.id
                self.state = "completed"
                break
            if(not self.board.choices):
                break
            self.queue.append(curr_player)
        if self.state == "in_progress":
            self.state = "tie"
        return self.state, self.winner

    def checkWinCondition(self, cell):
        row = self.checkWinInRow(cell)
        col = self.checkWinInCol(cell)
        diagonal = self.checkWinDiagonally(cell)
        print(row, col, diagonal)
        return row or col or diagonal
    
    def checkWinDiagonally(self,cell):
        row, col = cell
        if (row + col) != self.board.size or (row - col)!=0:
            return False  
        check1 = check2 = True
        prev = self.board.grid[0][0]
        prev1 = self.board.grid[0][self.board.size - 1]
        for i in range(1, self.board.size):
            if self.board.grid[i][i]!= prev:
                check1 = False
                break
            if self.board.grid[i][self.board.size - i - 1]!= prev1:
                check2 = False
                break
            prev = self.board.grid[i][i]
            prev1 = self.board.grid[i][self.board.size - i - 1]
        return check1 or check2
    
    def checkWinInCol(self, cell):
        row, col = cell
        check = True
        prev = self.board.grid[0][col]
        # print("prev ",prev)
        for r in range(1, self.board.size):
            # print("condi",self.board.grid[r][col])
            if self.board.grid[r][col]!= prev:
                check = False
                break
            prev = self.board.grid[r][col]
        return check
    
    def checkWinInRow(self,cell): 
        row, col = cell
        check = True
        prev = self.board.grid[row][0]
        for c in range(1, self.board.size):
            if self.board.grid[row][c]!= prev:
                check = False
                break
            prev = self.board.grid[row][c]
        return check

    def addPlayer(self, player: Player):
        self.players.append(player)
        self.queue.append(player)

    def getWinner(self):
        return self.winner

# Creating two player
player1 = Player(1, "Ramesh")
player2 = Player(2, "Suresh")

# Setting up Game board
board = Board(3)

# Tic Tac Toe Instance
game = ticTacToe(board)
game.addPlayer(player1)
game.addPlayer(player2)
print(game.queue)

print(game.play())





