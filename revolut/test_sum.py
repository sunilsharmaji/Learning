import unittest
import sum
import checkExcept

class Add(unittest.TestCase):

    def setUp(self) -> None:
        # print("Setup is callled.")
        # Arrange
        self.a = 10
        self.b = 10
        return super().setUp()
    
    def tearDown(self) -> None:
        # print("Tear Down is callled.")
        return super().tearDown()
    
    def test_sum1(self):
        # Act
        res = sum.sum(self.a, self.b)
        # Assert
        self.assertEqual(res, self.a+self.b)

    
    def test_except(self):
        # Act
        # res = sum.sum( self.b,self.a)
        # Assert
        self.assertRaises(,checkExcept.checkExcept,100)


# class Sub(unittest.TestCase):
#     def test_func_1(self):
#         pass

#     def test_func_2(self):
#         pass

#     def testfunc_2(self):
#         pass

if __name__ == "__main__":
    unittest.main()