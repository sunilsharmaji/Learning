'''
1. Players
2. Board
3. snakes
4. ladders
5. Dice
6. Game
'''
import random

class Board:
    def __init__(self, rows, columns):
        self.rows = rows
        self.columns = columns
        self.snakes = {}
        self.ladders = {}
        self.grid = [[i for i in range(j+1, j+11)] for j in range(0,self.rows*self.columns,self.columns)]

    def addSnake(self, start: tuple, end: tuple):
        if self.grid[start[0]][start[1]] > self.grid[end[0]][end[1]]:
            self.snakes[start]=end
        else:
            raise Exception("Not a snake ladder")

    def addLadder(self, start: tuple, end: tuple):
        if self.grid[start[0]][start[1]] < self.grid[end[0]][end[1]]:
            self.ladders[start]=end
        else:
            raise Exception("Not a valid ladder")
    
    def nextMove(self, old, val):
        cell, value = old
        row, column = cell
        newval = value + val
        newrow = newval // self.rows
        newcol = newval % self.columns
        newpos = (newrow, newcol)
        if newpos in self.ladders:
            newpos = self.ladders[newpos]
            newval = self.grid[newrow][newcol]
        if newpos in self.snakes:
            newpos = self.snakes[newpos]
            newval = self.grid[newrow][newcol]
        return [newpos,newval]
        
        
class Player:
    def __init__(self, id, name):
        self.id = id
        self.name = name
        self.pos = [(0,0), 0]

class Dice:
    def __init__(self, numberofDice):
        self.numberofDice = numberofDice
    
    def rollTheDice(self):
        return random.randrange(1, self.numberofDice*6)


board = Board(10, 10)
board.addLadder((0,5), (2,5))
board.addLadder((3,5), (5,5))
board.addSnake((6,6), (2,2))
board.addSnake((9,9), (0,2))
player1 = Player(1,"player1")
player2 = Player(2,"player2")

dice = Dice(2)
    
class Game:
    def __init__(self, Board: Board):
        self.board = Board
        self.players = []
        self.state = "not_started"
        self.winner = None

    def addPlayerToGame(self, player: Player):
        self.players.append(player)

    def play(self):
        if self.state == "not_started":
            self.state = "inprogress"
        queue = deque(self.players)
        while queue:
            current_player = queue.popleft()
            dice_value = dice.rollTheDice()
            index, val  = current_player.pos
            nextpos = self.board.nextMove(index, val)
            if nextpos[1] >= self.board.grid[-1][-1]:
                self.state = "complete"
                self.winner = current_player
                break
            queue.append(current_player)
            

        

game = Game(board)
game.addPlayerToGame(player1)
game.addPlayerToGame(player2)
game.play()


    