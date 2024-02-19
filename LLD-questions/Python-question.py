'''
Decorator creation
'''

def logger(function):
    def wrapper(*args, **kwargs):
        print("wrapper is called",args[0], kwargs["key"])
        return_val = function(*args, **kwargs)
        return return_val
    return wrapper

@logger
def output(name, key):
    print("output function", name)
    pass

print(output("ramesh", key = "sdfsdf"))

'''
Generator creation
'''