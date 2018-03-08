var counter = 1;

var btn = document.getElementById('btn');
var div = document.getElementById('random-info');

btn.addEventListener('click', function(){
    if(counter === 1){
        var ourRequest = new XMLHttpRequest();
    ourRequest.open('GET', '/js/db.json');
    ourRequest.onload = function(){
        var foo = JSON.parse(ourRequest.responseText);
        render(foo);
    };
    ourRequest.send();
    counter++;
    }
});

function render(data){
    var htmlString = '';

    for(i = 0; i < data.length; i++){
        htmlString += '<p><b>' + data[i].name +'</b></p>';
    }
    div.insertAdjacentHTML('beforeend',htmlString);
}