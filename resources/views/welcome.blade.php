<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SCAPI</title>

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
                <a class="navbar-brand" href="#">SCAPI</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#api">API</a>
                    </li>
                    <li>
                        <a href="#fork">Fork</a>
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
                            <h1 class="title">S</h1><text class="title">cinetific</text> <h1 class="title">C</h1><text class="title">omputational</text> <h1 class="title">A</h1><text class="title">pplication</text> <h1 class="title">P</h1><text class="title">rogramming</text> <h1 class="title">I</h1><text class="title">nterface</text>
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
<span>$.post('scapi.herokuapp.com/force-between-charges(charge1[C],charge2[C],distance[m],permeability[C^2/Nxm^2])',</span>
<span>    {</span>
<span>          charge1: -1.60217662 × 10^-19, // Optional parameter values.</span>
<span>          charge2: 1.60217662 × 10^-19,  // Without parameters, we will give you the code to perform the operation.</span>
<span>          permeability: 8.85 x 10^-12,   // With parameters, we will also provide an answer.</span>
<span>          _token: api-token              // Get an API token by signing up for free!</span>
<span>    })</span>
<span>    .done(function(data){</span>
<span>          var code = data.code;      // The JavaScript code that performs the operation.</span>
<span>          var formula = data.formula // The mathematical formula used in the computation, in text.</span>
<span>          var result = data.result;  // The answer we calculated if you provided parameters with the request.</span>
<span>          var widget = data.widget;  // A widget containing the formula in text, JavaScript code,</span>
<span>                                     // an associated Wolfram Alpha widget and a related photograph.</span>
<span>    });</span></pre>
            </div>
            <hr>
        </div>

        <div id="fork">
            <div class="jumbotron">
                <p>
                    This is an ongoing project, and anyone can participate! If you'd like to learn about Laravel, PHP, JavaScript, Restful APIs or science
                    check out the GitHub repository. If you would ike to participate but aren't interested in coding, and know your stuff in a field of
                    science or mathematics, you can add computations to the api right here on the site.
                </p>
                <br>
                <div class="col-md-3 col-sm-12 text-center github">
                    <a class="btn btn-lg btn-social-icon btn-github">
                        <span class="fa fa-github"></span>
                    </a>
                </div>
            </div>
            <hr>
        </div>

        <div id="widgets">
            <!-- Title -->
            <div class="row">
                <div class="col-lg-12">
                    <h3>All Widgets</h3>
                </div>
            </div>
            <!-- /.row -->

            <!-- Page Features -->
            <div class="row text-center">

                <div class="col-md-4 col-sm-6 hero-feature">
                    <div class="thumbnail">
                        <img src="img/photos/heat-sink.jpg" alt="heat sink">
                        <div class="caption">
                            <h3>Thermal Conductivity</h3>
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

            </div>
            <!-- /.row -->
            <hr>
        </div>
        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; HardBoot 2017</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
