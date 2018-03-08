var page = require('webpage').create();

page.open('http://example.com', function(status) {
  console.log("Status: " + status);
  phantom.exit();
});