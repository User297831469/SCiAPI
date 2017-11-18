var API_KEY = "$2y$10$5a1NNdQKUuQyvMwxf.KC0.RLf60fwaPR/v0/raLyGrnoHCjdckfE2";    // Get an API key by signing up for free!

var sciapi = {};

var QEDOperations = {
    0: "X",
    1: "Y",
    2: "Z",
    3: "H"
};

window.firebase ||  document.write('<script src="https://www.gstatic.com/firebasejs/4.1.3/firebase.js"><\/script>');

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

//install firebase
function initFirebase(){
    if(window.firebase) {
        // initialize firebase
        var config = {
            apiKey: "AIzaSyBufTBL0usG9NB6KDNx0pxl9QMIHpd2_mM",
            authDomain: "qed-database.firebaseapp.com",
            databaseURL: "https://qed-database.firebaseio.com",
            projectId: "qed-database",
            storageBucket: "qed-database.appspot.com",
            messagingSenderId: "501436822535"
        };
        window.firebase.initializeApp(config);
    }
}

$(document).ready(function(){
    initFirebase();
    sciapi["QEDCompute"] = function(operationID,deviceID,alpha,beta){
        console.log("Calling on QED");
        var updates = {};
        var operationObject = {};
        operationObject[QEDOperations[operationID]] = [alpha,beta];
        updates['/devices/' + deviceID] = operationObject;
        firebase.database().ref().update(updates).then(function(){
            firebase.database().ref().child('devices/' + deviceID).on("value", function (snapshot) {
                console.log(snapshot.val());
                if(snapshot.val().hasOwnProperty('result')) {
                    var nextAlpha = snapshot.val().result;
                    alert('Computed result of' + QEDOperations[operationID] + '(' + alpha.toString() + ',' + beta.toString() + '): ' + nextAlpha.toString());
                }
            });
        });
    }
});