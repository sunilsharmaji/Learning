# Input:
# https://www.revolut.com/rewards-personalised-cashback-and-discounts/

# Expected output:
# https://www.rev.me/<url identifier>
# 0-9-10 a-z-26 A-Z- 26 = 62
class UrlShorten:
    def __init__(self) -> None:
        self.cache = {}
        self.shorturl = "https://www.rev.me/"
        self.keyGenerator = self.getKey()

    def createShortUrl(self, longurl):
        key = str(next(self.keyGenerator))
        self.cache[key] = longurl
        shortUrl = self.shorturl+key
        return shortUrl

    def getLongUrl(self, shorturl):
        print(self.cache, shorturl)
        components = shorturl.split("/")
        
        key = components[-1]
        # print(key)
        if key in self.cache:
            return self.cache[key]
        return "No such url exist."

    def getKey(self):
        for i in range(100):
            yield i



