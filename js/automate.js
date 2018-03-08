var casper = require('casper').create();
var x = require('casper').selectXPath;

casper.userAgent('Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)');
casper.start('http://anything2mp3.com/', function(){
    this.waitForSelector('#edit-url');
});

casper.then(function() {
    this.sendKeys('#edit-url', 'https://www.youtube.com/watch?v=Y-KsutWy3UU');
    console.log('pasting link');
});

casper.thenClick('#edit-submit--2', function(){
    console.log('clicking button');
});

casper.then(function (){
    this.waitForSelector(x('//*[@id="block-system-main"]/a'));
    var link_found = document.querySelector(x('//*[@id="block-system-main"]/a'));
    var result = link_found.getAttribute('href');
    console.log(link_found);
    console.log(result);
});

casper.run();