
## About SciAPI

This is an ongoing project. The goal is to create an open-source API for embedding scientific computations into web applications with ease. The full documentation can be found on Hitch (https://www.hitchhq.com/sciapi) or on Swaggerhub (https://app.swaggerhub.com/apis/MackEdweise/SCiAPI/1.0.1).

## Response Format

A successful request to the API returns a JSON object with four attributes. The first two are the "status" and "message". The "status" attribute gives the status of the request. The message provides feedback from the API. The others are the "code" and "widget". The value of the "code" attribute is the JavaScript code that performs the requested operation. The code will be populated with any parameters provided with the request. The "widget" attribute has a rendered html widget containing the formula in text, JavaScript code, an associated Wolfram Alpha widget and a related photograph.

For example:
```
{
  "status": "success"
  "message": "successfully requested function Thermal Conductivity"
  "code": "function thermal_conductivity(area,constant,temperature_difference,thickness){
              var conductivity = (constant*area*temperature_difference)/thickness;
              return conductivity;
           }",
  "widget" :"<html>rendered html widget here</html>"
}  
```

## Contributing

I hope that people will contribute and learn something through this project, whether it be programming, mathematics or science related. If you are interested in contributing, feel free to modify the code and make pull requests. I will review requests to do so. Also, on the website http://www.sciapi.ca, you can add computation modules to the API using an interactive UI.

## License

This API is open source. I encourage you to use it or its components in your own projects... or better yet, contribute to SciAPI! 
The API interacts with Wolfram Alpha's widget builder (http://developer.wolframalpha.com/widgetbuilder/), and math.js by Jos de Jong (http://mathjs.org/index.html).

Copyright 2017 Marcus Edwards

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
