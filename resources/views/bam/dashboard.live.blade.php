@extends('layouts.overtsidebar')
@section('css')
<script src="{{ asset('assets/crm/js/echarts.min.js') }}"></script>
@stop
@section('content')
<div class="row">
    <div class="col-md-3 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">line_style</i>
                </div>
                <h4 class="card-title">Controladoria</h4>
                <h3 class="card-title">
                    <span bam='QtdLct' >...</span>
                </h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <span bam='DatLot'>...</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">attach_money</i>
                </div>
                <h4 class="card-title">Tesouraria</h4>
                <h3 class="card-title">
                    <span bam='QtdCnc' >...</span>
                </h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <span bam='DatCnc' >...</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">equalizer</i>
                </div>
                <h4 class="card-title">Produção</h4>
                <h3 class="card-title">
                    <span bam='QtdRea' >...</span>
                </h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <span bam='DatRea' >...</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">credit_card</i>
                </div>
                <h4 class="card-title">Vendas</h4>
                <h3 class="card-title">
                    <span bam='QtdNfv' >...</span>
                </h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <span bam='DatNfv' >...</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-sm-6">
        <div class="card card-chart">
            <div class="card-header card-header-icon card-header-danger">
                <div class="card-icon">
                    <i class="material-icons">group</i>
                </div>
                <h4 class="card-title"><span id="TitBamr034funNumLoc"></span></h4>
            </div>
            <div class="card-body">
                <div id="r034funNumLoc" class="charts" style="height:220px;"></div>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">access_time</i>
                    <span id="DatLogr034funNumLoc"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="card card-chart">
            <div class="card-header card-header-icon card-header-danger">
                <div class="card-icon">
                    <i class="material-icons">group</i>
                </div>
                <h4 class="card-title"><span id="TitBamr034funNumLoc"></span></h4>
            </div>
            <div class="card-body">
                <div id="r034funNumLoc" class="charts" style="height:250px;"></div>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">access_time</i>
                    <span id="DatLogr034funNumLoc"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div id="carouselDashboard" class="carousel slide col-md-12 col-sm-6" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="row">
              
                </div>
            </div>
            <div class="carousel-item">
                <div class="row">
                     <div class="col-md-12 col-sm-6">
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
</div>


@endsection
@section('js')

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
            
            url:"{{ route('bam.e501mcpVlrAbeCodTpt') }}"
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
//********************************************************************//
//
//PAINEL DASHBOARD bam/dasboard
//
//********************************************************************//
function dashboardPainelData(){

    $.ajax({
            
        url:"{{ route('bam.e600mcc') }}"
        ,success: function(e600mcc){
            $('span[bam]').each(function(){
                if ($(this).attr('bam') == 'QtdCnc'){
                    $(this).html(numeral(e600mcc.QtdCnc).format('0.00a'));
                    
                    
                } else if ($(this).attr('bam') == 'DatCnc'){

                    var now  = moment().subtract(2,'day');
                    var last = moment(e600mcc.DatCnc);
                    var DatCnc = moment(e600mcc.DatCnc).format('DD/MM/YYYY');

                    if(now>=last){
                        $(this).html('<i class="material-icons text-danger">warning</i><a class="text-danger">'+DatCnc+'</a');
                    } else{
                        $(this).html('<i class="material-icons text-success">done_all</i><a class="text-success">'+DatCnc+'</a');
                    }
                    
                                
                } else if ($(this).attr('bam') == 'QtdLct'){
                    $(this).html(numeral(e600mcc.QtdLct).format('0.00a'));
                
                
                } else if ($(this).attr('bam') == 'DatLot'){
                    
                    var now  = moment().subtract(2,'day');
                    var last = moment(e600mcc.DatLot);

                    var DatLot = moment(e600mcc.DatLot).format('DD/MM/YYYY');

                    if(now>=last){
                        $(this).html('<i class="material-icons text-danger">warning</i><a class="text-danger">'+DatLot+'</a');
                    } else{
                        $(this).html('<i class="material-icons text-success">done_all</i><a class="text-success">'+DatLot+'</a');
                    }

                } else if ($(this).attr('bam') == 'QtdRea'){
                    $(this).html(numeral(e600mcc.QtdRea).format('0.00a'));
                    
                } else if ($(this).attr('bam') == 'DatRea'){
                    
                    var now  = moment().subtract(2,'day');
                    var last = moment(e600mcc.DatRea);

                    var DatRea = moment(e600mcc.DatRea).format('DD/MM/YYYY');

                    if(now>=last){
                        $(this).html('<i class="material-icons text-danger">warning</i><a class="text-danger">'+DatRea+'</a');
                    } else{
                        $(this).html('<i class="material-icons text-success">done_all</i><a class="text-success">'+DatRea+'</a');
                    } 
                    
                } else if ($(this).attr('bam') == 'QtdNfv'){
                    $(this).html(numeral(e600mcc.QtdNfv).format('0.00a'));
                
                } else if ($(this).attr('bam') == 'DatNfv'){
                    
                    var now  = moment().subtract(2,'day');
                    var last = moment(e600mcc.DatNfv);

                    var DatNfv = moment(e600mcc.DatNfv).format('DD/MM/YYYY');

                    if(now>=last){
                        $(this).html('<i class="material-icons text-danger">warning</i><a class="text-danger">'+DatNfv+'</a');
                    } else{
                        $(this).html('<i class="material-icons text-success">done_all</i><a class="text-success">'+DatNfv+'</a');
                    }  
                } 
            });
        }
    });    
} 

</script>

<script type="text/javascript">
//********************************************************************//
//
//COLABORADORES POR LOCAL r034funNumLocQtdfun
//
//********************************************************************//
var r034funNumLoc = echarts.init(document.getElementById('r034funNumLoc'), 'infographic');

r034funNumLocData = {
    title: {
        subtext: '',
    },
    tooltip : {
        trigger: 'item',
        formatter : function(d) {
            n = d.name+'<br/>';
            v = numeral(parseFloat(d.value)).format('0');
            p = ' ('+d.percent+'%)';
            return n+v+p;
        }
    },

    legend: {
        type: 'scroll',
        right: 10,
        top: 20,
        bottom: 20,
        show:true,
        orient : 'vertical',
        x : 'right',
        data:['...']
    },
    calculable : true,
    series : [
        {
            name:'Monitoramento CPA',
            type:'pie',
            radius: ['70%', '90%'],
            avoidLabelOverlap: false,
            label: {
                normal: {
                    show: false,
                    position: 'center',
                    formatter : function(d) {
                    n = d.name+': ';
                    v = numeral(parseFloat(d.value)).format('0');
                    p = ' ('+d.percent+'%)';
                    return n+v+p;
                }
            },
                emphasis: {
                    show: true,
                    textStyle: {
                        fontSize: '20',
                        fontWeight: 'bold'
                    }
                }
            },
            labelLine: {
                normal: {
                    show: true
                }
            },
            data:[
                {value:100, name:'...'}
            ]
        }
    ]
};

var r034funNumLocQtdfun = function(){
    $.ajax({

        url:"{{ route('bam.r034funNumLocQtdfun') }}"
        ,success: function(r034funNumLocQtdfun){
           
            $('#TitBamr034funNumLoc').html(r034funNumLocQtdfun.TitBam);
            $('#DatLogr034funNumLoc').html(r034funNumLocQtdfun.DatLog);
        
            r034funNumLocData.title = {subtext:r034funNumLocQtdfun.SubTxt, sublink: '#'};

            $.each( r034funNumLocQtdfun.series, function(k, v){
                r034funNumLocData.series[0].data[k] = {value : v.QtdFun, name : v.NomLoc};
                r034funNumLocData.legend.data[k] = v.NomLoc;
            });

            r034funNumLoc.setOption(r034funNumLocData, true);
        }
    });
}
</script>
    

<script type="text/javascript">

//********************************************************************//
//
//Iniciar e Atualizar os Gráficos
//
//********************************************************************//
var charts = $(document).ready( function (){
        dashboardPainelData();
        r034funNumLocQtdfun();  
})

setInterval(function (){
    dashboardPainelData();
    r034funNumLocQtdfun();
}, 10000);
//********************************************************************//
//
//Redimensionar os Gráficos
//
//********************************************************************//
window.onresize = function() {
    setTimeout(function(){
        $(".charts").each(function(){
            var id = $(this).attr('_echarts_instance_');
            window.echarts.getInstanceById(id).resize();
        });
    },100);
};
</script>

@stop