var API_KEY = "123456789abcdefghijklmnopqrstuvwxyz";    // Get an API key by signing up for free!

$.post('https://sciapi.herokuapp.com/request/list',
    {
        _api_key: API_KEY
    })
    .done(function(data){

        var status = data.status;                       // The status of the request.
        if(status == 'success'){
            var code = data.code;                       // The JavaScript code that performs each operation.
            var definitions = "jQuery.fn.extend({";
            var count = 0;
            for (var name in code){                     // Dynamically extends jQuery with functions based on the computations in the SciAPI database.
                if(code.hasOwnProperty(name)){
                    var params = code[name].split("(")[1].split(")")[0];

                    definitions +=   name + ": function(" + params + ") {" +
                                     "return this.each(function(" + params + ") {" +
                                     code[name].split('{')[1].split('}')[0] + "});},";
                count += 1;
                }
            }
            definitions += "});";
            eval(definitions);                          // Evaluates dynamic jQuery extensions.

            console.log("Extended jQuery with " + count + "functions!");
        }
        else{

            console.log("An API error occurred: " + data.message);
        }
});

