import requests, sys
from bs4 import BeautifulSoup

def grabLink(vid):
    
    r = requests.get(
        "http://www.youtubeinmp3.com/download/?video=https://youtube.com/watch?v=" + vid)
    soup = BeautifulSoup(r.content, "html.parser")
    link = soup.find("a", {"id": "download"}).get("href")

    print "http://www.youtubeinmp3.com" + link


#If args are passed then begin downloading
if len(sys.argv) > 1:
    # For each arg sent
    for i in range(1,len(sys.argv)):
        grabLink(sys.argv[i])

else:
    print "Usage: scrape_youtube.py 'videoID' "
