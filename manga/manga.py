# coding: utf-8
import requests
from bs4 import BeautifulSoup
import time


req = requests.get("http://voirscan.com/")
soup = BeautifulSoup(req.text, "html.parser")
div = soup.find('div', {'class': 'listthumbx'})

if div != None:
    for i in div.findAll('li'):
        img = i.find('div', {'class': 'thumbx'}).find('a')
        img["title"] = ""
        print(img)
        print(i.find('div', {'class': 'lx'}).find('a').text.replace('Hot', '').replace("’", "'"))
        print(i.find('span', {'class': 'cli'}).find('a'))
        print(i.find('span', {'class': 'cli'}).find('i').text[:-2])

else:
    req = requests.get("https://byemanga.com/")
    soup = BeautifulSoup(req.text, "html.parser")
    div = soup.find('div', {'class': 'listupd'})

    for i in div.findAll('div', {'class': 'uta'}):
        img = i.find('div', {'class': 'imgu'}).find('a').find('img')
        hrefAttr = i.find('div', {'class': 'imgu'}).find('a')
        hrefAttr = hrefAttr["href"]
        aImg = "<a href=" + str(hrefAttr) + ">" + str(img) + "</a>"
        title = i.find('div', {'class': 'luf'}).find('a').find('h3').text.replace("’", "'")
        title = title[:title.find("Chapter")-1]
        lastScan = i.find('div', {'class': 'luf'}).find('ul').find('li')
        lastScanName = lastScan.find('a')
        lastScanTime = lastScan.find('span').find('i').text
        #######################
        print(aImg)
        print(title)
        print(lastScanName)
        print(lastScanTime)
