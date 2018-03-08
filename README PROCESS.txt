magic.js will create an array of video ID's
the array is POST to runScraper.php

the scraper runs a python file scrape_youtube.py with the array sent as args

the python file will scrape a youtube downloading website for the mp3 of each video
the mp3 link will be printed and stored within php file which will be
printed again and stored as response for magic.js

the download links are opened from magic.js which saves the mp3 file