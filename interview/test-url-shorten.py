from urlshorten import UrlShorten
import unittest


class Check(unittest.TestCase):

    def setUp(self) -> None:
        self.longurl = "https://www.revolut.com/rewards-personalised-cashback-and-discounts/"
        return super().setUp()
    
    def test_short_url(self):
        urlshorten = UrlShorten()
        shorturl = urlshorten.createShortUrl(self.longurl)
        longUrl = urlshorten.getLongUrl(shorturl)
        self.assertEqual(longUrl, self.longurl)

if __name__ == "__main__":
    unittest.main()
