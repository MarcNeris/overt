@extends('layouts.overtsidebar')
@section('css')
<script src="{{ asset('assets/crm/js/echarts.min.js') }}"></script>
@stop
@section('content')
<div class="row">
    <div class="col-md-2">
        <div class="card card-chart">
            <div class="card-header card-header-icon card-header-info">
                <div class="card-icon">
                    <i class="material-icons">attach_money</i>
                </div>
                <h4 class="card-title"><span id="">CPA</span></h4>
            </div>
            <div class="card-body">
                <span id=""></span>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">access_time</i>
                    <span id=""></span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="card card-chart">
            <div class="card-header card-header-icon card-header-info">
                <div class="card-icon">
                    <i class="material-icons">attach_money</i>
                </div>
                <h4 class="card-title"><span id="">CRE</span></h4>
            </div>
            <div class="card-body">
                <div id="" class="" style=""></div>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">access_time</i>
                    <span id=""></span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="card card-chart">
            <div class="card-header card-header-icon card-header-info">
                <div class="card-icon">
                    <i class="material-icons">attach_money</i>
                </div>
                <h4 class="card-title"><span id="TitBame600mesSalMes"></span></h4>
            </div>
            <div class="card-body">
                <div id="e600mesSalMes" class="charts" style="height:350px;"></div>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">access_time</i>
                    <span id="DatLoge600mesSalMes"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="card card-chart">
            <div class="card-header card-header-icon card-header-info">
                <div class="card-icon">
                    <i class="material-icons">attach_money</i>
                </div>
                <h4 class="card-title"><span id="TitBame501mcpVlrAbe"></span></h4>
            </div>
            <div class="card-body">
                <div id="e501mcpVlrAbe" class="charts" style="height:350px;"></div>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">access_time</i>
                    <span id="DatLoge501mcpVlrAbe"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="card card-chart">
            <div class="card-header card-header-icon card-header-info">
                <div class="card-icon">
                    <i class="material-icons">attach_money</i>
                </div>
                <h4 class="card-title"><span id="TitBame301tcrVlrAbe"></span></h4>
            </div>
            <div class="card-body">
                <div id="e301tcrVlrAbe" class="charts" style="height:350px;"></div>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">access_time</i>
                    <span id="DatLoge301tcrVlrAbe"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="card card-chart">
            <div class="card-header card-header-icon card-header-info">
                <div class="card-icon">
                    <i class="material-icons">attach_money</i>
                </div>
                <h4 class="card-title"><span id="TitBame301tcrVlrTit"></span></h4>
            </div>
            <div class="card-body">
                <div id="e301tcrVlrTit" class="charts" style="height:350px;"></div>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">access_time</i>
                    <span id="DatLoge301tcrVlrTit"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="card card-chart">
            <div class="card-header card-header-icon card-header-info">
                <div class="card-icon">
                    <i class="material-icons">attach_money</i>
                </div>
                <h4 class="card-title"><span id="TitBame501tcpVlrAbe"></span></h4>
            </div>
            <div class="card-body">
                <div id="e501tcpVlrAbe" class="charts" style="height:350px;"></div>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">access_time</i>
                    <span id="DatLoge501tcpVlrAbe"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="card card-chart">
            <div class="card-header card-header-icon card-header-info">
                <div class="card-icon">
                    <i class="material-icons">attach_money</i>
                </div>
                <h4 class="card-title"><span id="TitBame501tcpVlrTit"></span></h4>
            </div>
            <div class="card-body">
                <div id="e501tcpVlrTit" class="charts" style="height:350px;"></div>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">access_time</i>
                    <span id="DatLoge501tcpVlrTit"></span>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
@section('js')
<script type="text/javascript">
//********************************************************************//
//
//MONITORAMENTO SALDO DA CONTA INTERNA
//
//********************************************************************//
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
            return formatarTooltip(a);
        },
        axisPointer : {            
            type : 'shadow'        // type：'line' | 'shadow'
        }
    },
    grid: {
        top: 100,
        bottom: 20
    },
    xAxis: {
        type : 'value',
        show : true,
        position: 'bottom',
        splitLine: {show: true},
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
                        formatter: function(b){
                            var n =b.name;                        
                            var v=numeral(b.value).format('0.0a');
                            //return n+'\n'+v;
                            return n;
                        },  
                    }
                }
            },

            data:[0]
        }
    ]
};


function e600mesSalMesNumCco(){

    $.ajax({

        url:"{{ route('bam.e600mesSalMesNumCco') }}"
        ,success: function(e600mesSalMesNumCco){

            $('#TitBame600mesSalMes').html(e600mesSalMesNumCco.TitBam);
            $('#DatLoge600mesSalMes').html(e600mesSalMesNumCco.DatLog);
            
            e600mesSalMesData.title = {subtext:e600mesSalMesNumCco.SubTxt};
            
            $.each( e600mesSalMesNumCco.series, function(k, v){
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
//MONITORMANTO CONTAS A PAGAR POR TIPO DE TITULO
//
//
var e501mcpVlrAbe = echarts.init(document.getElementById('e501mcpVlrAbe'), 'infographic');

e501mcpVlrAbeData = {
    title: {
        subtext: '',
    },
    tooltip : {
        trigger: 'item',
        formatter : function(d) {
            n = d.name+'<br/>';
            v = numeral(parseFloat(d.value)).format('$0,0.00');
            p = ' ('+d.percent+'%)';
            return n+v+p;
        }
    },

    legend: {
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
            radius: ['50%', '70%'],
            avoidLabelOverlap: false,
            label: {
                normal: {
                    show: false,
                    position: 'center'
                },
                emphasis: {
                    show: true,
                    textStyle: {
                        fontSize: '30',
                        fontWeight: 'bold'
                    }
                }
            },
            labelLine: {
                normal: {
                    show: false
                }
            },
            data:[
                {value:100, name:'...'}
            ]
        }
    ]
};

var e501mcpVlrAbeCodTpt = function(){
    $.ajax({

        
        url:"{{ route('bam.e501mcpVlrAbeCodTpt') }}"
        ,success: function(e501mcpVlrAbeCodTpt){
            
            $('#TitBame501mcpVlrAbe').html(e501mcpVlrAbeCodTpt.TitBam);
            $('#DatLoge501mcpVlrAbe').html(e501mcpVlrAbeCodTpt.DatLog);
        
            e501mcpVlrAbeData.title = {subtext:e501mcpVlrAbeCodTpt.SubTxt, sublink: '#'};

            $.each( e501mcpVlrAbeCodTpt.series, function(k, v){
                e501mcpVlrAbeData.series[0].data[k] = {value : v.VlrAbe, name : v.DesTpt};
                e501mcpVlrAbeData.legend.data[k] = v.DesTpt;
            });

            e501mcpVlrAbe.setOption(e501mcpVlrAbeData, true);
        }
    });
}
</script>

<script type="text/javascript">
//
//
//Monitoramento CRE Títulos Vencidos Por Cliente
//
//
var e301tcrVlrAbe = echarts.init(document.getElementById('e301tcrVlrAbe'), 'infographic');

var e301tcrVlrAbeData = {
    title: {
        subtext: '',
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
function e301tcrVlrAbeCodCli(){
    
    $.ajax({
        
        url:"{{ route('bam.e301tcrVlrAbeCodCli') }}"
        ,success: function(e301tcrVlrAbeCodCli){

            $('#TitBame301tcrVlrAbe').html(e301tcrVlrAbeCodCli.TitBam);
            $('#DatLoge301tcrVlrAbe').html(e301tcrVlrAbeCodCli.DatLog);
            e301tcrVlrAbeData.title = { subtext: e301tcrVlrAbeCodCli.SubTxt };

            
            $.each( e301tcrVlrAbeCodCli.series, function(k, v){
                
                if(k<=4){

                    y = {name : v.ApeCli, value : v.VlrAbe};  
                    data0 = e301tcrVlrAbeData.series[0].data[k] = y;

                } else{
                    
                    e301tcrVlrAbeData.series[1].data[k] = [];
                    y = {name : v.ApeCli, value : v.VlrAbe};
                    //e301tcrVlrAbeData.legend.data[k] = v.ApeCli;
                    e301tcrVlrAbeData.series[1].data[k] = y;
                }
            });

            e301tcrVlrAbe.setOption(e301tcrVlrAbeData, true);
        }
    });
}

</script>

<script type="text/javascript">
//
//
//Monitoramento CRE Títulos A Vencer Por Cliente
//
//
var e301tcrVlrTit = echarts.init(document.getElementById('e301tcrVlrTit'), 'infographic');

var e301tcrVlrTitData = {
    title: {
        subtext: '',
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
function e301tcrVlrTitCodCli(){
    
    $.ajax({
        
        url:"{{ route('bam.e301tcrVlrTitCodCli') }}"
        ,success: function(e301tcrVlrTitCodCli){

            $('#TitBame301tcrVlrTit').html(e301tcrVlrTitCodCli.TitBam);
            $('#DatLoge301tcrVlrTit').html(e301tcrVlrTitCodCli.DatLog);
            e301tcrVlrTitData.title = { subtext: e301tcrVlrTitCodCli.SubTxt };

            
            $.each( e301tcrVlrTitCodCli.series, function(k, v){
                
                if(k<=4){

                    y = {name : v.ApeCli, value : v.VlrTit};  
                    data0 = e301tcrVlrTitData.series[0].data[k] = y;

                } else{
                    
                    e301tcrVlrTitData.series[1].data[k] = [];
                    y = {name : v.ApeCli, value : v.VlrTit};
                    //e301tcrVlrAbeData.legend.data[k] = v.ApeCli;
                    e301tcrVlrTitData.series[1].data[k] = y;
                }
            });

            e301tcrVlrTit.setOption(e301tcrVlrTitData, true);
        }
    });
}

</script>

<script type="text/javascript">
//
//
//Monitoramento CRE Títulos Vencidos Por Fornecedor
//
//
var e501tcpVlrAbe = echarts.init(document.getElementById('e501tcpVlrAbe'), 'infographic');

var e501tcpVlrAbeData = {
    title: {
        subtext: '',
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
function e501tcpVlrAbeCodFor(){
    
    $.ajax({
        
        url:"{{ route('bam.e501tcpVlrAbeCodFor') }}"
        ,success: function(e501tcpVlrAbeCodFor){
            $('#TitBame501tcpVlrAbe').html(e501tcpVlrAbeCodFor.TitBam);
            $('#DatLoge501tcpVlrAbe').html(e501tcpVlrAbeCodFor.DatLog);
            e501tcpVlrAbeData.title = { subtext: e501tcpVlrAbeCodFor.SubTxt };

            
            $.each( e501tcpVlrAbeCodFor.series, function(k, v){
                
                if(k<=4){

                    y = {name : v.ApeFor, value : v.VlrAbe};  
                    data0 = e501tcpVlrAbeData.series[0].data[k] = y;

                } else{
                    
                    e501tcpVlrAbeData.series[1].data[k] = [];
                    y = {name : v.ApeFor, value : v.VlrAbe};
                    //e501tcpVlrAbeData.legend.data[k] = v.ApeCli;
                    e501tcpVlrAbeData.series[1].data[k] = y;
                }
            });

            e501tcpVlrAbe.setOption(e501tcpVlrAbeData, true);
        }
    });
}

</script>


<script type="text/javascript">
//
//
//Monitoramento CRE Títulos a Vencer Por Fornecedor
//
//
var e501tcpVlrTit = echarts.init(document.getElementById('e501tcpVlrTit'), 'infographic');

var e501tcpVlrTitData = {
    title: {
        subtext: '',
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

function e501tcpVlrTitCodFor(){
    
    $.ajax({
        
        url:"{{ route('bam.e501tcpVlrTitCodFor') }}"
        ,success: function(e501tcpVlrTitCodFor){
            $('#TitBame501tcpVlrTit').html(e501tcpVlrTitCodFor.TitBam);
            $('#DatLoge501tcpVlrTit').html(e501tcpVlrTitCodFor.DatLog);
            e501tcpVlrTitData.title = { subtext: e501tcpVlrTitCodFor.SubTxt };

            
            $.each( e501tcpVlrTitCodFor.series, function(k, v){
                
                if(k<=4){

                    y = {name : v.ApeFor, value : v.VlrTit};  
                    data0 = e501tcpVlrTitData.series[0].data[k] = y;

                } else{
                    
                    e301tcrVlrTitData.series[1].data[k] = [];
                    y = {name : v.ApeFor, value : v.VlrTit};
                    e501tcpVlrTitData.series[1].data[k] = y;
                }
            });

            e501tcpVlrTit.setOption(e501tcpVlrTitData, true);
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
    e501mcpVlrAbeCodTpt();
    e301tcrVlrAbeCodCli();
    e301tcrVlrTitCodCli();
    e501tcpVlrTitCodFor();

}, 60000);


$(document).ready( function (){
    
    e600mesSalMes.showLoading();
    e600mesSalMesNumCco();
    e600mesSalMes.hideLoading();
    
    e501mcpVlrAbe.showLoading();
    e501mcpVlrAbeCodTpt();
    e501mcpVlrAbe.hideLoading();

    e301tcrVlrAbe.showLoading();
    e301tcrVlrAbeCodCli();
    e301tcrVlrAbe.hideLoading();

    e301tcrVlrTit.showLoading();
    e301tcrVlrTitCodCli();
    e301tcrVlrTit.hideLoading();

    e501tcpVlrTit.showLoading();
    e501tcpVlrTitCodFor();
    e501tcpVlrTit.hideLoading();

    e501tcpVlrAbe.showLoading();
    e501tcpVlrAbeCodFor();
    e501tcpVlrAbe.hideLoading();
});

</script>
@stop