var API_KEY = "123456789abcdefghijklmnopqrstuvwxyz";    // Get an API key by signing up for free!

var sciapi = {};

var mathjs = document.createElement('script');          // Imports math.js
mathjs.src = "http://cdnjs.cloudflare.com/ajax/libs/mathjs/3.14.2/math.min.js";
document.head.appendChild(mathjs);

function defineFunctions(definitions){                  // Creates dynamic function definitions.
    var count = 0;
    for(var name in definitions) {
        if(definitions.hasOwnProperty(name)) {
            var params = definitions[name].split("(")[1].split(")")[0];
            var title = definitions[name].split("(")[0].split(" ");
            title = title[title.length - 1];
            console.log(title + " function has params: " + params);
            var func = new Function("return " + definitions[name].replace(/[\n\r]+/g, ' '))();
            sciapi[title] = func;
            count += 1;
        }
    }
    console.log("Defined " + count + " functions!");
}

$.post('https://sciapi.herokuapp.com/list',
    {
        _api_key: API_KEY
    })
    .done(function(data){

        var status = data.status;                       // The status of the request.
        if(status == 'success'){
            var code = JSON.parse(data.code);           // The JavaScript code that performs each operation.
            defineFunctions(code);
        }
        else{
            console.log("An API error occurred: " + data.message);
        }
    });
