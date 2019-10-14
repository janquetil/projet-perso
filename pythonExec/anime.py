# coding: utf-8
import requests
from bs4 import BeautifulSoup


req = requests.get("https://gum-gum-streaming.com/")
soup = BeautifulSoup(req.text, "html.parser")

print(soup)
