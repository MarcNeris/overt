@extends('layouts.overtsidebar')
@section('css')
<script src="{{ asset('assets/crm/js/echarts.min.js') }}"></script>
@stop
@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card ">
            <div class="card-header card-header-info card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">attach_money</i>
                </div>
                <h4 class="card-title">Monitoramento Curva A de Clientes</h4>
                <div class="ct-chart" id="dailySalesChart"></div>
            </div>
            <div class="card-body">
                <div id="e140nfvSalMes" style="height: 350px"></div>
            </div>
            <div class="card-footer"><hr>
                <div class="stats">
                    <i class="material-icons">access_time</i>
                    <span class="DatLog"></span>
                </div>
            </div>
        </div>
    </div>
       <div class="col-md-6">
        <div class="card ">
            <div class="card-header card-header-info card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">attach_money</i>
                </div>
                <h4 class="card-title">Faturamento</h4>
                <div class="ct-chart" id="dailySalesChart"></div>
            </div>
            <div class="card-body">
                <div id="container" style="height: 350px"></div>
            </div>
            <div class="card-footer"><hr>
                <div class="stats">
                    <i class="material-icons">access_time</i>
                    <span class="DatLog"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-success card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">attach_money</i>
                </div>
                <h4 class="card-title">Monitoramento Conta Interna</h4>
                <div class="ct-chart" id="dailySalesChart"></div>
            </div>
            <div class="card-body">
                <div id="e600mesSalMes" style="height:350px;"></div>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">access_time</i>
                    <span class="DatLog"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-info card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">attach_money</i>
                </div>
                <h4 class="card-title">BAM | <span class="e650salTit"></span></h4>
                <div class="ct-chart" id="dailySalesChart"></div>
            </div>
            <div class="card-body">
                <div id="e650salSalMes" style="height: 350px"></div>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">access_time</i>
                    <span class="e650salLog"></span>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="carouselDashboard" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            
            <div class="row">
                <div class="col-md-6">
                    <div class="card border-primary mb-3"></div>
                    <div class="card border-primary mb-3"></div>
                    <div class="card ">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">business</i>
                            </div>
                            <h4 class="card-title">Faturamento</h4>
                            <div class="ct-chart" id="dailySalesChart"></div>
                        </div>
                        <div class="card-body">
                            <div id="" style="height: 350px"></div>
                        </div>
                        <div class="card-footer"><hr>
                            <div class="stats">
                                <i class="material-icons">access_time</i>
                                <span class="DatLog"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    
        <div class="carousel-item">
            <div class="row">
                 <div class="col-md-12">
                    <div class="card border-primary mb-3"></div>
                    <div class="card border-primary mb-3"></div>
                    <div class="card ">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">business</i>
                            </div>
                            <h4 class="card-title">Faturamento</h4>
                            <div class="ct-chart" id="dailySalesChart"></div>
                        </div>
                        <div class="card-body">
                            <div id="donutChart" style="height: 350px"></div>
                        </div>
                        <div class="card-footer"><hr>
                            <div class="stats">
                                <i class="material-icons">access_time</i>
                                <span class="DatLog"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a class="carousel-control-prev" href="#carouselDashboard" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Anterior</span>
    </a>
    <a class="carousel-control-next" href="#carouselDashboard" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Próximo</span>
    </a>
</div>


@endsection
@section('js')
<script type="text/javascript">
//
//
//Gráfico Monitoramento Curva A
//
//
var barras = echarts.init(document.getElementById('container'), 'macarons');
//var dom = document.getElementById("container");
//var myChart = echarts.init(dom);
//Em implantacao
var xAxisData = [];
var data1 = [];
var data2 = [];

for (var i = 0; i < 50; i++) {
    xAxisData.push(i);
    data1.push((Math.sin(i / 5) * (i / 9 -10) + i / 6) * 5);
    data2.push((Math.cos(i / 5) * (i / 56 -10) + i / 6) * 5);
}

barrasOptions = {
    title: {
        text: 'Faturamento'
    },
    legend: {
        data: ['bar', 'bar2'],
        align: 'left'
    },
    toolbox: {
        show : true,
        feature : {
            magicType : {show: true, 
                type: ['line', 'bar'],
                title : ''}
        }
    },
    tooltip: {
        transitionDuration: 0.4,
    },
    xAxis: {
        data: xAxisData,
        silent: true,
        splitLine: {
            show: false
        }
    },
    yAxis: {
    },
    series: [{
        name: 'bar',
        type: 'bar',
        data: data1,
        animationDelay: function (idx) {
            return idx * 10;
        }
    }, {
        name: 'bar2',
        type: 'line',
        data: data2,
        animationDelay: function (idx) {
            return idx * 10 + 100;
        }
    }],
    animationEasing: 'elasticOut',
    animationDelayUpdate: function (idx) {
        return idx * 5;
    }
};

barras.setOption(barrasOptions, true);
//
//
//Fim do Gráfico
//
//
</script>




<script type="text/javascript">
//
//
//Gráfico Financeiro Saldo Mês
//
//
var e600mesSalMes = echarts.init(document.getElementById('e600mesSalMes'), 'macarons');

e600mesSalMesData = {
    title: {
        text: '',
        subtext: '',
        //sublink: ''
    },
    legend: {
        show: false,
         orient : 'horizontal',
         x : 'right',
         data : ['Último Saldo']
    },
    toolbox: {
        show : true,
        feature : {
            magicType : {show: true, 
                type: ['line', 'bar'],
                title : ''},
        }
    },
    tooltip : {
        trigger: 'axis',
        transitionDuration: 0.4,
        formatter: function(a){
            return formatarTootip(a);
        },
        axisPointer : {            
            type : 'shadow'        // type：'line' | 'shadow'
        }
    },
    grid: {
        top: 100,
        bottom: 0
    },
    xAxis: {
        type : 'value',
        show : true,
        position: 'bottom',
        splitLine: {show: true},
        //splitLine: {lineStyle:{type:'dashed'}},
        axisLabel : {
            formatter: function(b){ 
                var v=numeral(b).format('0.0a');
                return v;
            }  
        }
    },
    yAxis: {
        type : 'category',
        axisLine: {show: true},
        axisLabel: {show: false},
        axisTick: {show: false},
        splitLine: {show: false},
        data : ['...']
    },

    series : [
        {
            name:'Último Saldo',
            type:'bar',
            itemStyle: {
                normal: {
                    color: function(params) {
                        var colorList = [
                            '#C1232B','#B5C334','#FCCE10','#F0805A','#26C0C0',
                            '#FE8463','#9BCA63','#FAD860','#F3A43B','#60C0DD',
                            '#D7504B','#C6E579','#F4E001','#E87C25','#27727B'
                        ];
                        return colorList[params.dataIndex]
                    },
                  
                    label: {
                        show: true,
                        position: 'right',
                        formatter: function(b){
                            var n =b.name;                        
                            var v=numeral(b.value).format('0.0a');
                            return n+'\n'+v;
                        }   
                    }
                }
            },

            data:[0]
        }
    ]
};
//
//
//Carregar os dados do Gráfico
//
//
function e600mesSalMesNumCco(){

    $.ajax({

        url:"{{ route('senior.e600mesSalMesNumCco') }}"
        ,success: function(e600mesSalMesNumCco){
            e600mesSalMesData.title = {subtext:e600mesSalMesNumCco.SubTxt};
            
            $('.DatLog').html(e600mesSalMesNumCco.DatLog);

            $.each( e600mesSalMesNumCco, function(k, v){
                e600mesSalMesData.legend.data[k] = v.NumCco;
                e600mesSalMesData.yAxis.data[k] = v.NumCco;
                e600mesSalMesData.series[0].data[k] = {value : parseFloat(v.SalMes)};
            });

            e600mesSalMes.setOption(e600mesSalMesData, true);
        }
    });
}
</script>


<script type="text/javascript">
//
//
//Gráfico de Barras Faturamento Anual
//
//
var e650salSalMes = echarts.init(document.getElementById('e650salSalMes'), 'macarons');

e650salSalMesData = {
    
    title : {
        text: '',
        subtext: ''
    },
    tooltip: {
        trigger:'axis',
        formatter: function(a){
            return formatarTootip(a);
        },
    },
    legend: {
        data: []
    },
    toolbox: {
        show : true,
        feature : {
            magicType : {show: true, 
                type: ['line', 'bar'],
                title : ''}
        }
    },
    calculable : true,
    xAxis : [
        {
            type : 'category',
            boundaryGap : true,
            data: [,,,,,]
        }
    ],
    yAxis : [
        {
            type : 'value',
            axisLabel : {
            formatter: function(b){ 
                var v=numeral(b).format('0.0a');
                return v;
            }  
        }
        }
    ],
    series : [ ],

    animationEasing: 'elasticOut',
    animationDelayUpdate: function (idx) {
        return idx * 5;
    }
};
//
//
//Carregar os dados do Gráfico
//
//
function e650salSalMesCtaRed(){

    $.ajax({
        url:"{{ route('senior.e650salSalMesCtaRed') }}"
        ,success: function(e650salSalMesCtaRed){

            e650salSalMesData.title = {text:'', subtext: e650salSalMesCtaRed.SubTxt };

            $('.e650salLog').html(e650salSalMesCtaRed.e650salLog);
            $('.e650salTit').html(e650salSalMesCtaRed.AbrCta);

            $.each(e650salSalMesCtaRed.legend, function(k, v){
                e650salSalMesData.legend.data[k] = v;
                e650salSalMesData.series[k]=[];
                e650salSalMesData.series[k] = { type:'line', name:v };
            });

            $.each(e650salSalMesCtaRed.xAxis, function(k, v){
                e650salSalMesData.xAxis[0].data[k]= v[0];
            });

            $.each(e650salSalMesCtaRed.series, function(k, v){

                e650salSalMesData.series[k].data = v;
            });

            e650salSalMes.setOption(e650salSalMesData, true);
        }
    });
}
</script>

<script type="text/javascript">
//
//
//Carousel
//
//Tempo para mudança de página
$('.carousel').carousel({

  interval: 8400

});
//
//
//Função iniciada au carregar nova página do carousel
//
//
$('#carouselDashboard').on('slid.bs.carousel', function () {
    var donutChart = echarts.init(document.getElementById('donutChart'), 'infographic');

        optionsDonutChart = {
        tooltip : {
            trigger: 'item',
            formatter: "{b} <br/> {d}%"
        },
        legend: {
            orient : 'vertical',
            x : 'right',
            data:['Processando ...']
        },
        calculable : true,
        series : [
            {
                name:'Contas a Pagar',
                type:'pie',
                clockWise:false,
                radius : ['40%', '50%'],
                itemStyle : {
                    normal : {
                        label : {
                            show : true
                        },
                        labelLine : {
                            show : true,
                            formatter: "{a} <br/>{b} : {c} ({d}%)"
                        }
                    },
                    emphasis : {
                        label : {
                            show : true,
                            position : 'center',
                            textStyle : {
                                fontSize : '12',
                                fontWeight : 'bold'
                            }
                        }
                    }
                },
                data:[
                    {value:100, name:'Processando...'}
                ]
            }
        ]
    };

    var refredonutChart = function(){
        $.ajax({
            
            url:"{{ route('senior.e501mcpVlrAbeCodTpt') }}"
            ,success: function(e501mcpVlrAbeCodTpt){
                $.each( e501mcpVlrAbeCodTpt, function(k, v){
                    optionsDonutChart.series[0].data[k] = {value : v.VlrAbe, name : v.DesTpt};
                    optionsDonutChart.legend.data[k] = v.DesTpt;
                });

                donutChart.setOption(optionsDonutChart, true);
            }
        });
    }

    refredonutChart();

});

</script>


<script type="text/javascript">
//
//
//Curva A de Faturamento de Clientes
//
//
var e140nfvSalMes = echarts.init(document.getElementById('e140nfvSalMes'), 'macarons');

var e140nfvSalMesData = {
    title: {
    text: '',
    subtext: '',
    //sublink: ''
    },
    tooltip: {
        trigger: 'item',
        formatter : function(d) {
            n = d.name+'<br/>';
            v = numeral(parseFloat(d.value)).format('$0,0.00');
            p = ' ('+d.percent+'%)';
            return n+v+p;
        }
    },
    legend: {
        show:false,
        orient : 'vertical',
        x : 'left',
        data:[]
    },
    calculable : true,
    series : [
        {
            name:'Top 3',
            type:'pie',
            selectedMode: 'single',
            radius : [0, 90],
            x: '50%',
            width: '80%',
            funnelAlign: 'left',
            //max: 1548,
            itemStyle : {
                normal : {
                    label : {
                        position : 'inner'
                    },
                    labelLine : {
                        show : false
                    }
                }
            },
            data:[]
        },
        
        {
            name:'Top 7',
            label: {
                normal: {
                    show:true,
                    //position: 'inner'
                }
            },
            type:'pie',
            radius : [100, 140],
            x: '60%',
            width: '35%',
            funnelAlign: 'left',
            data:[]
        }
    ]
};
//
//
//e140nfvSalMes.setOption(e140nfvSalMesData, true);
//
//
function e140nfvSalMesCodCli(){
    
    $.ajax({
        
        url:"{{ route('senior.e140nfvSalMesCodCli') }}"
        ,success: function(e140nfvSalMesCodCli){

            e140nfvSalMesData.title = { subtext: e140nfvSalMesCodCli.SubTxt };
            
            $.each( e140nfvSalMesCodCli.series, function(k, v){
                
                if(k<=4){

                    y = {name : v.ApeCli, value : v.VlrLiq};  
                    data0 = e140nfvSalMesData.series[0].data[k] = y;

                } else{
                    
                    e140nfvSalMesData.series[1].data[k] = [];
                    y = {name : v.ApeCli, value : v.VlrLiq};
                    e140nfvSalMesData.legend.data[k] = v.ApeCli;
                    e140nfvSalMesData.series[1].data[k] = y;
                }
            });

            e140nfvSalMes.setOption(e140nfvSalMesData, true);
        }
    });
}

</script>


<script type="text/javascript">
//
//
//Atualizar os Gráficos
//
//
setInterval(function (){

    e600mesSalMesNumCco();
    e650salSalMesCtaRed();
    e140nfvSalMesCodCli();

}, 10000);


$(document).ready( function (){
    
    e600mesSalMes.showLoading();
    e600mesSalMesNumCco();
    e600mesSalMes.hideLoading();
    
    e650salSalMes.showLoading();
    e650salSalMesCtaRed();
    e650salSalMes.hideLoading();

    e140nfvSalMes.showLoading();
    e140nfvSalMesCodCli();
    e140nfvSalMes.hideLoading();

});
//
//
//Redimensionar os Gráficos
//
//
window.onresize = function(){
    e600mesSalMes.resize();
    e650salSalMes.resize();
    e140nfvSalMes.resize();
};
</script>

@stop