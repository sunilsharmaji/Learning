import MyException  
def checkExcept(val):
    if val == 100:
        res = val/0
        raise MyException("Not a valid number.")
    else:
        return True