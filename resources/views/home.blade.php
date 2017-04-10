@extends('layouts.app')


@section('content')
    <!-- Page Content -->
    <header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-7 col-xs-12 col-md-7 col-lg-7">
                    <div class="header-content">
                        <div class="hidden-xs">
                            <div class="header-content-inner text-left col-md-offset-2 col-lg-offset-4">
                                <h1 class="title">S</h1><text class="title">cientific</text> <h1 class="title">C</h1><text class="title">omputat</text><h1 class="title">i</h1><text class="title">onal</text> <h1 class="title">A</h1><text class="title">pplication</text> <h1 class="title">P</h1><text class="title">rogramming</text> <h1 class="title">I</h1><text class="title">nterface</text>
                            </div>
                        </div>
                        <div class="hidden-md hidden-lg hidden-sm">
                            <div class="header-content-inner text-left col-md-offset-2 col-lg-offset-4">
                                <div class="row">
                                    <div class="title-sub">
                                        <h1 class="title">S</h1><text class="title">cientific</text>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="title-sub">
                                        <h1 class="title">C</h1><text class="title">omputat</text><h1 class="title">i</h1><text class="title">onal</text>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="title-sub">
                                        <h1 class="title">A</h1><text class="title">pplication</text>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="title-sub">
                                        <h1 class="title">P</h1><text class="title">rogramming</text>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="title-sub">
                                        <h1 class="title">I</h1><text class="title">nterface</text>
                                    </div>
                                </div>
                            </div>
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
            <div class="row">
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
<span>$.post('sciapi.herokuapp.com/request/Force_Between_Charges)',</span>
<span>    {</span>
<span>          charge1: -1.60 * 10 ** -19,       // Optional parameter values.</span>
<span>          charge2: 1.60 * 10 ** -19,        // Without parameters, we will give you the code to perform the operation.</span>
<span>          permeability: 8.85 * 10 ** -12,   // With parameters, we will also insert the parameters into the code.</span>
<span>          _api_key: api-key                 // Get an API key by signing up for free!</span>
<span>    })</span>
<span>    .done(function(data){</span>
<span>          var code = data.code;       // The JavaScript code that performs the operation.</span>
<span>                                      // The code will be populated with any parameters provided with the request.</span>
<span>          var widget = data.widget;   // A widget containing the formula in text, JavaScript code,</span>
<span>                                      // an associated Wolfram Alpha widget and a related photograph.</span>
<span>          var message = data.message; // Feedback from the API, including any errors and suggestions.</span>
<span>          var status = data.status;   // The status of the request.</span>
<span>    });</span>
                    </pre>
                </div>
            </div>
            <div class="row text-center centered">
                <div class="col-md-offset-3 col-sm-offset-3 col-lg-offset-3 col-xs-offset-1 col-md-6 col-sm-6 col-lg-6 col-xs-10 centered">
                    @if (!is_null($user))
                        <h4>Your API Key is:</h4>
                        <div class="input-group">
                            <input id="clipboard-target" class="form-control" value="{{ $user->key }}" readonly>
                            <span data-toggle="tooltip" title="Copied!" class="input-group-addon btn btn-info clip-button" data-clipboard-target="#clipboard-target">
                                <img class="clippy" src="{{ URL::asset('img/clippy.svg') }}" width="15">
                            </span>
                        </div>
                    @else
                        <a class="btn btn-lg btn-success" href="{{ route('register') }}">Get an API Key</a>
                    @endif
                </div>
            </div>
            <div class="row">
                <hr>
            </div>
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
                </div>
            </div>
            <div class="row">
                <a href="https://github.com/MackEdweise/SCiAPI" class="btn btn-lg btn-social btn-block btn-github" style="width:260px;margin-left:auto;margin-right:auto;margin-bottom:25px;">
                    <span class="fa fa-github"></span> Fork the Code
                </a>
            </div>
            <div class="row text-center">
                @if (!is_null($user))
                    <a class="btn btn-lg btn-success" style="width:260px;" data-target="#createModal" data-toggle="modal">Add a Computation Module</a>
                @else
                    <a class="btn btn-lg btn-success" style="width:260px;" href="{{ route('register') }}">Register to Add Content</a>
                @endif
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

                    @foreach($widgets as $widget)

                        @include('_partials.widget', ['widget' => $widget])

                    @endforeach

                </div>
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
        @if (!is_null($user))
            <div id="createModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add a Computation</h4>
                        </div>
                        <form class="form-horizontal" name="group-form" enctype="multipart/form-data" role="form" method="POST" action="{{ route('create') }}">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <div class="space-inside">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row field">
                                                <h4 class="subtitle"><b>Name *</b></h4><a class='my-tool-tip' data-toggle="tooltip" data-placement="top" title="Name the Computation."><i class='glyphicon glyphicon-info-sign'></i></a>
                                            </div>
                                            <div class="row field">
                                                <input required id="name" name="name" type="text" class="form-control" placeholder="Capacitance">
                                            </div>
                                            <div class="row field">
                                                <h4 class="subtitle"><b>Description *</b></h4><a class='my-tool-tip' data-toggle="tooltip" data-placement="top" title="Describe the formula. Note its parameters."><i class='glyphicon glyphicon-info-sign'></i></a>
                                            </div>
                                            <div class="row field">
                                                <textarea value="" required id="description" name="description" type="text" class="form-control " placeholder="This is a known relationship from physics, chemistry, biology, astronomy, electronics, etc."></textarea>
                                            </div>
                                            <div class="row field">
                                                <h4 class="subtitle"><b>JavaScript Code *</b></h4><a class='my-tool-tip' data-toggle="tooltip" data-placement="top" title="Please use unique, descriptive parameter names for your function and best coding practices. Please make any necessary explanations in the description. If you don't know what to put here, please enter '//TODO - need a dev!'"><i class='glyphicon glyphicon-info-sign'></i></a>
                                            </div>
                                            <div class="row field">
                                                <textarea value="" required id="code" name="code" type="text" class="form-control " placeholder="function myFormula(){"></textarea>
                                            </div>
                                            <div class="row field">
                                                <h4 class="subtitle"><b>Wolfram Alpha Widget</b></h4><a class='my-tool-tip' data-toggle="tooltip" data-placement="top" title="In order to obtain the wolfram alpha widget link, please create your widget by following Wolfram Alpha's instructions at developer.wolframalpha.com /widgetbuilder. At the end, paste the embed link with the 'popup' option into this field."><i class='glyphicon glyphicon-info-sign'></i></a>
                                            </div>
                                            <div class="row field">
                                                <input id="wolfram" name="wolfram" type="text" class="form-control " placeholder="<script>...</script>">
                                            </div>
                                            <div class="row field">
                                                <h4 class="subtitle"><b>Related Photo</b></h4><a class='my-tool-tip' data-toggle="tooltip" data-placement="top" title="Ideally a picture that relates to the science!"><i class='glyphicon glyphicon-info-sign'></i></a>
                                            </div>
                                            <div class="row field">
                                                <input type="file" name="image" id="image" size="20" />
                                            </div>
                                            <div class="row field">
                                                <h4 class="subtitle"><b>Formula Image *</b></h4><a class='my-tool-tip' data-toggle="tooltip" data-placement="top" title="Please upload an image of the formula in readable text."><i class='glyphicon glyphicon-info-sign'></i></a>
                                            </div>
                                            <div class="row field">
                                                <input required type="file" name="formula" id="formula" size="20" />
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
        @endif
    </div>
@endsection

@section('footer')

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script>
        $(".my-tool-tip").tooltip();

        new Clipboard('.clip-button');

        $('body').on('hidden.bs.tooltip', function (e) {
            $(e.target).data("bs.tooltip").inState = { click: false, hover: false, focus: false }
        });

        $(document).ready(function(){
            $('.clip-button').tooltip({
                trigger: 'click'
            });
        });
    </script>

@endsection