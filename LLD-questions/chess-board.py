class Board:
    def __init__(self):
        self.grid = [[]]

class Player:
    def __init__(self, id, color):
        self.id = id
        self.color = color

class ChessGame:
    def __init__(self, board: Board):
        self.board = board
        self.players = list()
        self.winner = None
        self.state = "not_started"
        

