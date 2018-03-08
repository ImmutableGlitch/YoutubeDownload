"""Testing the phantomJS framework"""


def grabLink():
    """Run the driver"""
    driver = webdriver.PhantomJS()
    driver.get('http://anything2mp3.com')
    
    search_box = driver.find_element_by_xpath('//*[@id="edit-url"]')
    search_box.send_keys(sys.argv[1])
    search_box.submit()
    
    print "Getting download link"
    download_link = None
    while download_link is None:
        try:
            download_link = driver.find_element_by_xpath('//*[@id="block-system-main"]/a')
        except:
            pass
    print("RESULT: %s" % download_link.get_attribute('href'))

import sys
if len(sys.argv) > 1:
    from selenium import webdriver
    print("Downloading %s..." % sys.argv[1])
    grabLink()
else:
    print "Usage: test.py 'input_link_here' "