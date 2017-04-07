<div class="col-md-4 col-sm-6 hero-feature">
    <div class="thumbnail">
        <img src="{{ 'http://23.248.66.120:9090/'.$widget->image }}" alt="heat sink">
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