<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SCiAPI</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/heroic-features.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href="css/font-awesome.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/path4200.png">
    <link href="css/bootstrap-social.css" rel="stylesheet" >

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">SCiAPI</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#api">API</a>
                    </li>
                    <li>
                        <a href="#contribute">Contribute</a>
                    </li>
                    <li>
                        <a href="#widgets">Widgets</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-7 col-xs-12 col-md-7 col-lg-7">
                    <div class="header-content">
                        <div class="header-content-inner col-md-offset-2 col-lg-offset-4">
                            <h1 class="title">S</h1><text class="title">cientific</text> <h1 class="title">C</h1><text class="title">omputational</text> <h1 class="title">i</h1> <h1 class="title">A</h1><text class="title">pplication</text> <h1 class="title">P</h1><text class="title">rogramming</text> <h1 class="title">I</h1><text class="title">nterface</text>
                        </div>
                    </div>
                </div>
                <div id="spin" class="col-sm-5 col-xs-12 col-md-5 col-lg-5 spacer-2 hidden-xs hidden-sm">
                    <img src="img/path4200.png" alt="">
                </div>
            </div>
        </div>
    </header>

    <div class="container">

        <div id="api">
        <!-- Jumbotron -->
            <div class="jumbotron">
                <p>An open-source API for embedding those tough scientific computations in your application with ease. Scientific formulas and relationships have been
                developed and implemented, let's not repeat that work every time we want to create a science-based application! This is for researchers, educators and developers.
                </p>
                <br>
                <p>JavaScript API usage example:</p>
                <br>
            <pre>
<span>// Requesting a calculation using a function name and parameter footprint.</span>
<span>$.post('sciapi.herokuapp.com/Force_Between_Charges)',</span>
<span>    {</span>
<span>          charge1: -1.60217662 × 10^-19, // Optional parameter values.</span>
<span>          charge2: 1.60217662 × 10^-19,  // Without parameters, we will give you the code to perform the operation.</span>
<span>          permeability: 8.85 x 10^-12,   // With parameters, we will also insert the parameters into the code.</span>
<span>          _token: api-token              // Get an API token by signing up for free!</span>
<span>    })</span>
<span>    .done(function(data){</span>
<span>          var code = data.code;      // The JavaScript code that performs the operation.</span>
<span>                                     // The code will be populated with any parameters provided with the request.</span>
<span>          var widget = data.widget;  // A widget containing the formula in text, JavaScript code,</span>
<span>                                     // an associated Wolfram Alpha widget and a related photograph.</span>
<span>    });</span></pre>
            </div>
            <hr>
        </div>

        <div id="contribute">
            <div class="row">
                <div class="jumbotron">
                    <p>
                        This is an ongoing project, and anyone can participate! If you'd like to learn about Laravel, PHP, JavaScript, APIs or science
                        check out the GitHub repository. If you would like to participate but aren't interested in coding, and know your stuff in a field of
                        science or mathematics, you can add computations to the api right here on the site.
                    </p>
                    <br>
                    <div class="col-md-12 col-sm-12 text-center github">
                        <a href="https://github.com/MackEdweise/scapi" class="btn btn-lg btn-social btn-block btn-github">
                            <span class="fa fa-github"></span> Fork the Code
                        </a>
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <a class="btn btn-lg btn-success" data-target="#createModal" data-toggle="modal">Add a Computation Module!</a>
            </div>
            <div class="row">
                <hr>
            </div>
        </div>

        <div id="widgets">
            <div class="row text-center">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h3>All Widgets</h3>
                </div>
            </div>

            <div class="row text-center">

                <div class="row">
                    <div class="col-md-4 col-sm-6 hero-feature">
                        <div class="thumbnail">
                            <img src="img/photos/heat-sink.jpg" alt="image">
                            <div class="caption">
                                <h3>Thermal Conductivity</h3>
                                <h5>(Example)</h5>
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#home"><img class="widget-tab" src="img/path4200.png" alt="f(x)"></a></li>
                                    <li><a data-toggle="tab" href="#menu2"><img class="widget-tab" src="img/logo-JavaScript.png" alt="JS"></a></a></li>
                                    <li><a data-toggle="tab" href="#menu3"><img class="widget-tab" src="img/logo-wolfram-alpha.png" alt="Wolfram"></a></li>
                                </ul>

                                <div class="tab-content">
                                    <div id="home" class="tab-pane fade in active">
                                        <img class="formula" src="img/formulas/thermal-conductivity.png" alt="">
                                        <br>
                                        <div class="text-left">
                                            <b>P</b> is the thermal conductance, which is the amount of heat transferred per time delta t.<br>
                                            <b>Q</b> is heat.<br>
                                            <b>t</b> is time.<br>
                                            <b>A</b> is the cross sectional area of the thermal conductor interface.<br>
                                            <b>T</b> is the initial temperature difference.<br>
                                            <b>d</b> is the thickness of the material.<br>
                                            <b>k</b> is the thermal conductivity constant for the material.
                                        </div>
                                    </div>
                                    <div id="menu2" class="tab-pane fade text-left">
                                    <pre>
    <span>function thermal_conductivity(A,k,dT,d){</span>
    <span>      var P = (k*A*dT)/d;</span>
    <span>      return P</span>
    <span>}</span>
                                        </pre>
                                    </div>
                                    <div id="menu3" class="tab-pane fade wolfram">
                                        <script type="text/javascript" id="WolframAlphaScripteecbfe12bf874a4606bb5074f6c3634b" src="//www.wolframalpha.com/widget/widget.jsp?id=eecbfe12bf874a4606bb5074f6c3634b&output=popup"></script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @foreach($widgets as $widget)

                    <div class="col-md-4 col-sm-6 hero-feature">
                        <div class="thumbnail">
                            <img src="{{ 'http://23.248.66.120:9090/'.$widget->image }}" alt="image">
                            <div class="caption">
                                <h3>Thermal Conductivity</h3>
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#home"><img class="widget-tab" src="img/path4200.png" alt="f(x)"></a></li>
                                    <li><a data-toggle="tab" href="#menu2"><img class="widget-tab" src="img/logo-JavaScript.png" alt="JS"></a></a></li>
                                    <li><a data-toggle="tab" href="#menu3"><img class="widget-tab" src="img/logo-wolfram-alpha.png" alt="Wolfram"></a></li>
                                </ul>

                                <div class="tab-content">
                                    <div id="home" class="tab-pane fade in active">
                                        <img class="formula" src="{{ 'http://23.248.66.120:9090/'.$widget->formula }}" alt="">
                                        <br>
                                        <div class="text-left">
                                            <p>
                                                {{ $widget->description }}
                                            </p>
                                        </div>
                                    </div>
                                    <div id="menu2" class="tab-pane fade text-left">
                                        <pre>
                                            {{ $widget->code }}
                                        </pre>
                                    </div>
                                    <div id="menu3" class="tab-pane fade wolfram">
                                        {{ $widget->wolfram }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach

            </div>
            <hr>
        </div>
        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; <a href="http://www.hardboot.co">HardBoot</a> 2017</p>
                </div>
            </div>
        </footer>
        <div id="createModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Create a computation widget</h4>
                    </div>
                    <form class="form-horizontal" name="group-form" enctype="multipart/form-data" role="form" method="POST" action="{{ route('create') }}">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="space-inside">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <h4><b>Name</b></h4>
                                            <input required id="name" name="name" type="text" class="form-control " placeholder="Capacitance">
                                        </div>
                                        <div class="row">
                                            <h4><b>Description</b></h4>
                                            <textarea value="" required id="description" name="description" type="text" class="form-control " placeholder="Describe the formula. Note its parameters."></textarea>
                                        </div>
                                        <div class="row">
                                            <h4><b>JavaScript Code</b></h4>
                                            <textarea value="" required id="code" name="code" type="text" class="form-control " placeholder="function myFormula(){"></textarea>
                                        </div>
                                        <div class="row">
                                            <h4><b>Wolfram Alpha Widget</b></h4>
                                            <p>
                                                In order to obtain the wolfram alpha widget link, please create your widget by following <a href="http://developer.wolframalpha.com/widgetbuilder/?_ga=1.182823846.1022345723.1491431803">Wolfram Alpha's instructions</a>.
                                                At the end, paste the embed link with the "popup" option into this field.
                                            </p>
                                            <input required id="wolfram" name="wolfram" type="text" class="form-control " placeholder="<script>...</script>">
                                        </div>
                                        <div class="row">
                                            <h4><b>Related Image</b></h4>
                                            <input type="file" name="image" id="image" size="20" />
                                        </div>
                                        <div class="row">
                                            <h4><b>Formula Image</b></h4>
                                            <input type="file" name="formula" id="formula" size="20" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="row">
                                <button type="submit" class="btn btn-success">Create</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
