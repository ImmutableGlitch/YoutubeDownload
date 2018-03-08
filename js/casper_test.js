var casper = require('casper').create()

var script = document.createElement('script')
script.src = 'http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js'
script.type = 'text/javascript'
document.getElementsByTagName('head')[0].appendChild(script)

casper.start('http://anything2mp3.com/', function () {
  this.waitForSelector('#edit-url')
  this.echo('Found searchbox\n')
  this.sendKeys('#edit-url', 'https://www.youtube.com/watch?v=Rqnw5IfbZOU')
  this.echo('Sent keys\n')
  this.click('#edit-submit--2')  
  this.capture('/var/www/html/foo1.jpg', undefined, {
      format: 'jpg',
      quality: 75
  })
  this.echo('Clicked search button and took screenshot')
  this.echo('Taking another sreenshot in 3 secs')  
  this.wait(3000)  
  this.capture('/var/www/html/foo2.jpg', undefined, {
      format: 'jpg',
      quality: 75
  })
})

if (casper.cli.args.length < 1) {
  casper.echo('Usage: $casperjs casper_test.js URL_HERE').exit(1)
} else {
  casper.run()
}
