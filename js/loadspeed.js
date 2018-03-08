var page = require('webpage').create(),
    system = require('system'),
    t, address;

if(system.args.length === 1){
    console.log('Usage: loadspeed.js URL');
    phantom.exit();
}

t = Date.now();
address = system.args[1];

page.open(address, function(status){
    if(status !== 'success'){
        console.log('failed to load URL');
    }else{
        t = Date.now() - t;
        console.log('Loading ' + system.args[1]);
        console.log('Time to load: ' + t + 'ms');
    }
    phantom.exit();
});