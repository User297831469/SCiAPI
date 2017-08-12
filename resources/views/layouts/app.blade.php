<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>SciAPI</title>

        <!-- jQuery -->
        <script src="js/jquery.js"></script>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Bootstrap Core JS -->
        <script src="js/bootstrap.js"></script>

        <!-- Custom CSS -->
        <link href="css/style.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- clippy -->
        <script src="js/clipboard.min.js"></script>

        <!-- Font Awesome -->
        <link href="css/font-awesome.css" rel="stylesheet">

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ URL::asset('img/atom.png') }}">

        <!-- Bootstrap  Social Icons -->
        <link href="css/bootstrap-social.css" rel="stylesheet" >

        <!-- three.js-->
        <script src="js/three.min.js"></script>

    </head>
    <body>
        <div id="app">
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
                        <a class="navbar-brand" href="#">SciAPI</a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="#api">API</a>
                            </li>
                            <li>
                                <a href="#library">Library</a>
                            </li>
                            <li>
                                <a href="#contribute">Contribute</a>
                            </li>
                            <li>
                                <a href="#widgets">Widgets</a>
                            </li>
                            <li>
                                <a href="https://app.swaggerhub.com/apis/MackEdweise/SCiAPI/1.0.1">Docs</a>
                            </li>
                            @if(is_null($user))
                                <li>
                                    <a href="{{ route('login') }}">Login</a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container -->
            </nav>

            @yield('content')
        </div>

    </body>

    <footer>
        @yield('footer')
    </footer>

</html>
