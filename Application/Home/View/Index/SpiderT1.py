import requests

payload = {'ie': 'utf-8', 'kw': 'red', 'fr': 'search'}
r = requests('http://tieba.baidu.com/f', param = payload)

print(r.url)
