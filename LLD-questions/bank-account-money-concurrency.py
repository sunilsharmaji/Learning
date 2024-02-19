import threading

class BankAccount:
    def __init__(self, balance):
        self.balance = balance
        self.lock = threading.Lock()

    def deposit(self, amount):
            # self.lock.acquire()
            print(f"Depositing ${amount}")
            self.balance += amount
            print(f"New balance: ${self.balance}")
            # self.lock.release()

    def withdraw(self, amount):
            # self.lock.acquire()
            if self.balance >= amount:
                print(f"Withdrawing ${amount}")
                self.balance -= amount
                print(f"New balance: ${self.balance}")
            else:
                print("Insufficient funds!")
            # self.lock.release()
l = threading.Lock()
def transfer_money(sender, receiver, amount):
    # with threading.Lock():
        l.acquire()
        sender.withdraw(amount)
        receiver.deposit(amount)
        l.release()

if __name__ == "__main__":
    # Initialize two bank accounts
    account1 = BankAccount(1000)
    account2 = BankAccount(500)

    # Create threads for concurrent transactions
    thread1 = threading.Thread(target=transfer_money, args=(account1, account2, 200))
    thread2 = threading.Thread(target=transfer_money, args=(account2, account1, 300))

    # Start the threads
    thread1.start()
    thread2.start()

    # Wait for threads to finish
    thread1.join()
    thread2.join()

    # Display final balances
    print(f"Final balance in Account 1: ${account1.balance}")
    print(f"Final balance in Account 2: ${account2.balance}")
