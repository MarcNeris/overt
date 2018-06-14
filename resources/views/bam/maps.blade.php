@extends('layouts.overtsidebar')

@section('css')
        <script src=""></script>

       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/echarts.min.js"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts-gl/echarts-gl.min.js"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts-stat/ecStat.min.js"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/extension/dataTool.min.js"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/map/js/china.js"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/map/js/world.js"></script>
       <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=ZUONbpqGBsYGXNIYHicvbAbM"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/extension/bmap.min.js"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/simplex.js"></script>

@stop

@section('content')

<div class="row"> 
    
    <div class="col-md-9">
        <div class="card card-nav-tabs">
          <h4 class="card-header card-header-rose">@if(session()->has('NomFta'))
                {{ session()->get('NomFta') }} | Monitoramento Ativo
            @endif

          </h4>
          <div class="card-body">
            <div id="container" style="height: 400px"></div>
          </div>
        </div>
    </div>

</div>


@endsection




@section('js')
<script type="text/javascript">
var dom = document.getElementById("container");
var myChart = echarts.init(dom);
var app = {};
option = null;


//$.get('https://ecomfe.github.io/echarts-examples/public/data/asset/geo/USA.json', function () {
$.get("{{ asset('assets/crm/js/brazil.json') }}", function () {

    option = {
        title: {
            text: 'USA Population Estimates (xxxx)',
            subtext: 'Data from www.census.gov',
            sublink: 'http://www.census.gov/popest/data/datasets.html',
            left: 'right'
        },
        tooltip: {
            trigger: 'item',
            showDelay: 0,
            transitionDuration: 0.2,
            formatter: function (params) {
                var value = (params.value + '').split('.');
                value = value[0].replace(/(\d{1,3})(?=(?:\d{3})+(?!\d))/g, '$1,');
                return params.seriesName + '<br/>' + params.name + ': ' + value;
            }
        },
        visualMap: {
            left: 'right',
            min: 500000,
            max: 38000000,
            inRange: {
                color: ['#313695', '#4575b4', '#74add1', '#abd9e9', '#e0f3f8', '#ffffbf', '#fee090', '#fdae61', '#f46d43', '#d73027', '#a50026']
            },
            text:['High','Low'],           // 文本，默认为数值文本
            calculable: true
        },
        toolbox: {
            show: true,
            //orient: 'vertical',
            left: 'left',
            top: 'top',
            feature: {
                dataView: {readOnly: false},
                restore: {},
                saveAsImage: {}
            }
        },
        series: [
            {
                name: 'USA PopEstimates',
                type: 'map',
                roam: true,
                map: 'USA',
                itemStyle:{
                    emphasis:{label:{show:true}}
                },
                // 文本位置修正
                textFixed: {
                    Alaska: [20, -20]
                },
                data:[
                    
                    {name: 'Betim', value: 4822023},

                ]
            }
        ]
    };

    myChart.setOption(option);
});;
if (option && typeof option === "object") {
    myChart.setOption(option, true);
}
       </script>

@stop