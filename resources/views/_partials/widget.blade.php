<div class="col-md-4 col-sm-6 hero-feature">
    <div class="thumbnail">
        <img src="{{ !is_null($widget->image) ? 'http://23.248.66.120:9090/'.$widget->image : 'img/path4200.png'}}" alt="image">
        <div class="caption">
            <div class="row">
                <h3 class="subtitle">{{ $widget->name }}</h3><a class='my-tool-tip' data-toggle="tooltip" data-placement="top" title="Want to edit this because you made a mistake or think something isn't right? Let us know why and we can help." href="mailto:marcusedwards@hotmail.ca"><i class="fa fa-pencil-square fa-fw"></i></a>
            </div>
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home-{{ $widget->id }}"><img class="widget-tab" src="img/path4200.png" alt="f(x)"></a></li>
                <li><a data-toggle="tab" href="#menu-{{ $widget->id }}-2"><img class="widget-tab" src="img/logo-JavaScript.png" alt="JS"></a></li>
                @if(!is_null($widget->wolfram))
                    <li><a data-toggle="tab" href="#menu-{{ $widget->id }}-3"><img class="widget-tab" src="img/logo-wolfram-alpha.png" alt="Wolfram"></a></li>
                @endif
            </ul>

            <div class="tab-content">
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
                    <pre>
                         @foreach(explode("\n", $widget->code) as $line)
                            <span>{{ $line  }}</span>
                        @endforeach
                    </pre>
                </div>
                @if(!is_null($widget->wolfram))
                    <div id="menu-{{ $widget->id }}-3" class="tab-pane fade wolfram">
                        {!! html_entity_decode($widget->wolfram) !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>