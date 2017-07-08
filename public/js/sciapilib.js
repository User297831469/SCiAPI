var API_KEY = "123456789abcdefghijklmnopqrstuvwxyz";    // Get an API key by signing up for free!

$.post('https://sciapi.herokuapp.com/request/list',
    {
        _api_key: API_KEY
    })
    .done(function(data){

        var status = data.status;                       // The status of the request.
        if(status == 'success'){
            var code = data.code;                       // The JavaScript code that performs each operation.
            var definitions = "";
            var count = 0;
            for (var name in code){                     // Dynamically defines functions based on the computations in the SciAPI database.
                if(code.hasOwnProperty(name)){
                    var params = code[name].split("(")[1].split(")")[0];
                    console.log("function " + name + " has params: " + params);
                    definitions += code[name];
                count += 1;
                }
            }
            eval(definitions);                          // Evaluates dynamic function definitions.

            console.log("Defined " + count + "functions!");
        }
        else{

            console.log("An API error occurred: " + data.message);
        }
});

