<div class="col-md-4 col-sm-6" style="margin-bottom: 30px;">
    <div class="thumbnail">
        <div style="height:160px;width:inherit;overflow-y:hidden;">
            <img style="max-width: 100%" src="{{ !is_null($widget->image) ? 'http://www.datablue.stream/SCiAPI/'.$widget->image : 'http://www.datablue.stream/SCiAPI/half-atom.png'}}" alt="image">
        </div>
        <div style="height:350px;" class="caption">
            <div class="row text-center">
                <h3 style="display: inline; color: #363636;">{{ $widget->name }}</h3><a class="my-tool-tip-{{ $widget->id }}" style="display: inline; color: #7c7c7c; margin-left: 10px;" data-target="#updateModal-{{ $widget->id }}" data-toggle="modal"><i class="fa fa-pencil-square fa-fw"></i></a>
            </div>
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home-{{ $widget->id }}"><img style="width: 30px;" src="http://www.datablue.stream/SCiAPI/atom-icon.png" alt="f(x)"></a></li>
                <li><a data-toggle="tab" href="#menu-{{ $widget->id }}-2"><img style="width: 30px;" src="http://www.datablue.stream/SCiAPI/logo-JavaScript.png" alt="JS"></a></li>
                <li><a data-toggle="tab" href="#menu-{{ $widget->id }}-3"><img style="width: 30px;" src="http://www.datablue.stream/SCiAPI/calc-icon.png" alt="Calc"></a></li>
                @if(!is_null($widget->wolfram))
                    <li><a data-toggle="tab" href="#menu-{{ $widget->id }}-4"><img style="width: 30px;" src="http://www.datablue.stream/SCiAPI/logo-wolfram-alpha.png" alt="Wolfram"></a></li>
                @endif
            </ul>

            <div style="overflow-y:scroll;height:260px;" class="tab-content text-center">
                <div id="home-{{ $widget->id }}" class="tab-pane fade in active">
                    <img class="formula" src="{{ 'http://www.datablue.stream/SCiAPI/'.$widget->formula }}" alt="">
                    <br>
                    <div class="text-left">
                        <p>
                            {{ $widget->description }}
                        </p>
                    </div>
                </div>
                <div id="menu-{{ $widget->id }}-2" class="tab-pane fade text-left">
                    <pre id="code-{{ $widget->id }}">
                         @foreach(explode("\n", $widget->code) as $line)
                            <span>{{ $line }}</span>
                        @endforeach
                    </pre>
                </div>
                <div id="menu-{{ $widget->id }}-3" class="tab-pane fade text-left">
                    <button class="btn btn-success" id="submit-{{ $widget->id }}-btn">Calculate</button>
                </div>
                @if(!is_null($widget->wolfram))
                    <div id="menu-{{ $widget->id }}-4" class="tab-pane fade" style="height:250px;">
                        {!! html_entity_decode($widget->wolfram) !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<script>
    $(".my-tool-tip-" + "{{ $widget->id }}").tooltip();
    function {{ str_replace(" ", "_", $widget->name).'Func' }}() {
        var code = "";
        @foreach(explode("\n", $widget->code) as $line)
            code += " {{ str_replace(array("\n", "\r"), '', $line) }}";
        @endforeach
        this.func = new Function("return " + code)();
        var params = code.split("(")[1].split(")")[0].split(",");
        var title = code.split("(")[0].split(" ")[2];
        for (var param in params){
            var field = '<div class="row" style="margin-bottom:10px; margin-top:10px; margin-right: auto; margin-left: auto;">' +
                    '<h4 style="color: #363636;"><b>' + params[param].split('_').join(' ') + '</b></h4>' +
                    '</div>' +
                    '<div class="row" style="width: 250px; margin-bottom:10px; margin-top:10px; margin-right: auto; margin-left: auto;">' +
                    '<input required id="' + params[param].split('_').join(' ') + '-{{ $widget->id }}' + '" name="' + params[param].split('_').join(' ') + '-{{ $widget->id }}' + '" type="number" class="form-control" placeholder="1">' +
                    '</div>';
            $('#menu-{{ $widget->id }}-3').prepend(field);
        }
        $('#submit-{{ $widget->id }}-btn').on('click', function(){
            var values = [];
            for  (var param in params){
                values.push($('#' + param + '-{{ $widget->id }}').val());
            }
            var result = this.func.apply(this,values);
            alert("The solution to the " + title + " problem is " + result.toString());
        });
    };
    {{ str_replace(" ", "_", $widget->name).'Func' }}();
</script>
<style>
    #code-{{ $widget->id }} {
        background: #303030;
        color: #f1f1f1;
        padding: 10px 16px;
        border-radius: 2px;
        border-top: 4px solid #00aeef;
        -moz-box-shadow: inset 0 0 10px #000;
        box-shadow: inset 0 0 10px #000;
    }

    #code-{{ $widget->id }} span {
        display: block;
        line-height: 1.5rem;
        counter-increment: line;
    }
    #code-{{ $widget->id }} span:before {

        content: counter(line);
        display: inline-block;
        padding: 0 .5em;
        margin-right: .5em;
        color: #888

    }
</style>
<div id="updateModal-{{ $widget->id }}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-left">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit this Computation</h4>
            </div>
            <form class="form-horizontal" name="group-form" enctype="multipart/form-data" role="form" method="POST" action="{{ route('update', ['id' => $widget->id]) }}">
                {{ csrf_field() }}
                <div class="modal-body text-left">
                    <div class="space-inside">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row field">
                                    <h4 class="subtitle"><b>Name *</b></h4><a class='my-tool-tip' data-toggle="tooltip" data-placement="top" title="Name the Computation."><i class='glyphicon glyphicon-info-sign'></i></a>
                                </div>
                                <div class="row field">
                                    <input value="{{ $widget->name }}" required id="name" name="name" type="text" class="form-control" placeholder="Capacitance">
                                </div>
                                <div class="row field">
                                    <h4 class="subtitle"><b>Description *</b></h4><a class='my-tool-tip' data-toggle="tooltip" data-placement="top" title="Describe the formula. Note its parameters."><i class='glyphicon glyphicon-info-sign'></i></a>
                                </div>
                                <div class="row field">
                                    <textarea value="" required id="description" name="description" type="text" class="form-control " placeholder="This is a known relationship from physics, chemistry, biology, astronomy, electronics, etc.">{{ $widget->description }}</textarea>
                                </div>
                                <div class="row field">
                                    <h4 class="subtitle"><b>JavaScript Code *</b></h4><a class='my-tool-tip' data-toggle="tooltip" data-placement="top" title="Please use unique, descriptive parameter names for your function and best coding practices. Please make any necessary explanations in the description. If you don't know what to put here, please enter '//TODO - need a dev!'"><i class='glyphicon glyphicon-info-sign'></i></a>
                                </div>
                                <div class="row field">
                                    <textarea value="" required id="code" name="code" type="text" class="form-control " placeholder="function myFormula(){">{{ $widget->code }}</textarea>
                                </div>
                                <div class="row field">
                                    <h4 class="subtitle"><b>Wolfram Alpha Widget</b></h4><a class='my-tool-tip' data-toggle="tooltip" data-placement="top" title="In order to obtain the wolfram alpha widget link, please create your widget by following Wolfram Alpha's instructions at developer.wolframalpha.com /widgetbuilder. At the end, paste the embed link with the 'popup' option into this field."><i class='glyphicon glyphicon-info-sign'></i></a>
                                </div>
                                <div class="row field">
                                    <input value="{{ $widget->wolfram }}" id="wolfram" name="wolfram" type="text" class="form-control " placeholder="<script>...</script>">
                                </div>
                                <div class="row field">
                                    <h4 class="subtitle"><b>Related Photo</b></h4><a class='my-tool-tip' data-toggle="tooltip" data-placement="top" title="Ideally a picture that relates to the science!"><i class='glyphicon glyphicon-info-sign'></i></a>
                                </div>
                                <div class="row field">
                                    <input type="file" name="image" id="image" size="20" />
                                </div>
                                <div class="row field">
                                    <h4 class="subtitle"><b>Formula Image</b></h4><a class='my-tool-tip' data-toggle="tooltip" data-placement="top" title="Please upload an image of the formula in readable text."><i class='glyphicon glyphicon-info-sign'></i></a>
                                </div>
                                <div class="row field">
                                    <input type="file" name="formula" id="formula" size="20" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>