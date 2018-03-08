var page = require('webpage').create();

//page.settings.resourceTimeout = 1500;
page.onResourceRequested = function(request) {
  console.log('Request ' + JSON.stringify(request, undefined, 4));
};

page.onResourceReceived = function(response) {
  console.log('Receive ' + JSON.stringify(response, undefined, 4));
};
page.open('http://chriscomputing.tk');
phantom.exit();