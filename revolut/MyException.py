class MyException(Exception):
    def __init__(self, msg, error_code) -> None:
        super().__init__(msg)
        self.error_code = error_code