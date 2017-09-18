<div id="root-{{ $widget->id }}" class="col-md-4 col-sm-6">
    <div class="thumbnail">
        <div id="img-container-{{ $widget->id }}" >
            <img id="img-{{ $widget->id }}" src="{{ !is_null($widget->image) ? 'http://www.datablue.stream/SCiAPI/'.$widget->image : 'http://www.datablue.stream/SCiAPI/half-atom.png'}}" alt="image">
        </div>
        <div id="body-{{ $widget->id }}" class="caption">
            <div class="row text-center">
                <h3 id="name-{{ $widget->id }}">{{ $widget->name }}</h3><a class="my-tool-tip-{{ $widget->id }}" id="tool-tip-{{ $widget->id }}" data-toggle="tooltip" data-placement="top" title="You don't have permission to edit this widget. Think something is missing or could be done better? Sign up for SCiAPI to contribute!" href="{{ route('home') }}"><i class="fa fa-pencil-square fa-fw"></i></a>
            </div>
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home-{{ $widget->id }}"><img id="tab-1-{{ $widget->id }}" src="http://www.datablue.stream/SCiAPI/atom-icon.png" alt="f(x)"></a></li>
                <li><a data-toggle="tab" href="#menu-{{ $widget->id }}-2"><img id="tab-2-{{ $widget->id }}" src="http://www.datablue.stream/SCiAPI/logo-JavaScript.png" alt="JS"></a></li>
                <li><a data-toggle="tab" href="#menu-{{ $widget->id }}-3"><img id="tab-3-{{ $widget->id }}" src="http://www.datablue.stream/SCiAPI/calc-icon.png" alt="Calc"></a></li>
                @if(!is_null($widget->wolfram))
                    <li><a data-toggle="tab" href="#menu-{{ $widget->id }}-4"><img id="tab-4-{{ $widget->id }}" src="http://www.datablue.stream/SCiAPI/logo-wolfram-alpha.png" alt="Wolfram"></a></li>
                @endif
            </ul>

            <div id="tabs-{{ $widget->id }}" class="tab-content text-center">
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
                    <div id="menu-{{ $widget->id }}-4" class="tab-pane fade">
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
        var func = new Function("return " + code)();
        var params = code.split("(")[1].split(")")[0].split(",");
        var title = code.split("(")[0].split(" ")[2];
        for (var param in params) {
            var field = '<div class="row label-{{ $widget->id }}">' +
                    '<h4><b>' + params[param].split('_').join(' ') + '</b></h4>' +
                    '</div>' +
                    '<div class="row form-{{ $widget->id }}">' +
                    '<input required id="' + params[param] + '-{{ $widget->id }}' + '" name="' + params[param] + '-{{ $widget->id }}' + '" type="number" class="form-control" placeholder="1">' +
                    '</div>';
            $('#menu-{{ $widget->id }}-3').prepend(field);
        }
        $('#submit-{{ $widget->id }}-btn').on('click', function () {
            var values = [];
            for (var param in params) {
                values.push($('#' + params[param] + '-{{ $widget->id }}').val());
            }
            var result = func.apply(null, values);
            alert("The solution to the " + title + " problem is " + result.toFixed(2));
        });
    };
    {{ str_replace(" ", "_", $widget->name).'Func' }}();
</script>
<style>

    #name-{{ $widget->id }} {
        display: inline;
        color: #363636;
    }

    #body-{{ $widget->id }} {
        height: 400px;
    }

    #tool-tip-{{ $widget->id }} {
        display: inline;
        color: #7c7c7c;
        margin-left: 10px;
    }

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

    #tab-1-{{ $widget->id }}, #tab-2-{{ $widget->id }}, #tab-3-{{ $widget->id }}, #tab-4-{{ $widget->id }} {
        width: 30px;
    }

    #menu-{{ $widget->id }}-4 {
        height: 250px;
    }

    #tabs-{{ $widget->id }} {
        overflow-y:scroll;
        height:310px;
    }

    #img-container-{{ $widget->id }} {
        height:160px;
        width:inherit;
        overflow-y:hidden;
    }

    #img-{{ $widget->id }} {
        max-width: 100%;
    }

    #root-{{ $widget->id }} {
        margin-bottom: 30px;
    }

    .form-{{ $widget->id }} {
        width: 250px;
        margin-bottom:5px;
        margin-top:5px;
        margin-right: auto;
        margin-left: auto;
    }

    .label-{{ $widget->id }} {
        margin-bottom:5px;
        margin-top:5px;
        margin-right: auto;
        margin-left: auto;
    }
</style>