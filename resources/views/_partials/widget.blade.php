<div class="col-md-4 col-sm-6" style="margin-bottom: 30px;">
    <div class="thumbnail">
        <div style="width:inherit;overflow-y:hidden;">
            <img src="{{ !is_null($widget->image) ? 'http://23.248.66.120:9090/'.$widget->image : 'http://23.248.66.120:9090/half-atom.png'}}" alt="image">
        </div>
        <div style="height:350px;" class="caption">
            <div class="row text-center">
                <h3 style="display: inline; color: #363636;">{{ $widget->name }}</h3><a class="my-tool-tip-{{ $widget->id }}" style="display: inline; color: #7c7c7c; margin-left: 10px;" data-toggle="tooltip" data-placement="top" title="You don't have permission to edit this widget. Think something is missing or could be done better? Sign up for SCiAPI to contribute!" href="{{ route('home') }}"><i class="fa fa-pencil-square fa-fw"></i></a>
            </div>
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home-{{ $widget->id }}"><img style="width: 30px;" src="http://23.248.66.120:9090/atom-icon.png" alt="f(x)"></a></li>
                <li><a data-toggle="tab" href="#menu-{{ $widget->id }}-2"><img style="width: 30px;" src="http://23.248.66.120:9090/logo-JavaScript.png" alt="JS"></a></li>
                @if(!is_null($widget->wolfram))
                    <li><a data-toggle="tab" href="#menu-{{ $widget->id }}-3"><img style="width: 30px;" src="http://23.248.66.120:9090/logo-wolfram-alpha.png" alt="Wolfram"></a></li>
                @endif
            </ul>

            <div style="overflow-y:scroll;height:260px;" class="tab-content text-center">
                <div id="home-{{ $widget->id }}" class="tab-pane fade in active">
                    <img class="formula" src="{{ 'http://23.248.66.120:9090/'.$widget->formula }}" alt="">
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
                @if(!is_null($widget->wolfram))
                    <div id="menu-{{ $widget->id }}-3" class="tab-pane fade" style="height:250px;">
                        {!! html_entity_decode($widget->wolfram) !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<script>$(".my-tool-tip-" + "{{ $widget->id }}").tooltip();</script>
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