@extends('layouts.overtsidebar')

@section('css')

<script src="{{ asset('assets/crm/js/echarts.min.js') }}"></script>

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
            <div id="bamprd000s" style="height:400px;"></div>
          </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card card-nav-tabs">
          <h4 class="card-header card-header-rose">@if(session()->has('NomFta'))
                {{ $bamprd000['NomBam'] or 'Não Cadastrado' }}
            @endif

          </h4>
          <div class="card-body">
            <div id="gauge" style="height:400px;"></div>
          </div>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-12">
        <div class="card card-nav-tabs">
          <h4 class="card-header card-header-rose">@if(session()->has('NomFta'))
                {{ session()->get('NomFta') }} | {{ $bamprd000['CodBam'] or 'Não Cadastrado' }} - {{ $bamprd000['NomBam'] or 'Não Cadastrado' }}
            @endif

          </h4>
          <div class="card-body">
            <div id="bamprd000Barra" style="height:400px;"></div>
          </div>
        </div>
    </div>

</div>

@endsection



@section('js')
<script type="text/javascript">
//
//
// Tabela bamprd000s Real Time Faturamento
//
//
var bamprd000s = echarts.init(document.getElementById('bamprd000s'), 'macarons');


var bamprd000sData = {
    title : {
        text: "{{ $bamprd000['TitBam'] or 'Não Cadastrado' }}",
        subtext: "{{ $bamprd000['NomBam'] or 'Não Cadastrado' }}"
    },
     tooltip: {
        trigger: 'axis',
        formatter: function(a){
            return formatarTootip(a);
        },
        axisPointer: {
            type: 'cross',
            label: {
                backgroundColor: '#283b56'
            }
        }
    },
    legend: {
        data:["{{ $bamprd000['TitLin'] or 'Não Cadastrado' }}", "{{ $bamprd000['TitBar'] or 'Não Cadastrado' }}"]
    },
    dataZoom : {
        show : false,
        start : 0,
        end : 100
    },
    xAxis : [
        {
            type : 'category',
            boundaryGap : true,
            data : (function (){
                var res = [];
                var len = 15;
                while (len--) {
                    res.push(len + 1);
                }
                return res;
            })()
        },
        {
            type : 'category',
            boundaryGap : true,
            data : (function (){
                var res = [];
                var len = 15;
                while (len--) {
                    res.push(len + 1);
                }
                return res;
            })()
        }
    ],
    yAxis : [
        {
            type : 'value',
            scale: false,
            show: false,
            name : 'Meta/Hora',
            //boundaryGap: [1, 1]
        },
        {
            type : 'value',
            scale: true,
            name : "{{ $bamprd000['TitBam'] or 'Não Cadastrado' }}",
            //boundaryGap: [0.1, 0.1],
            axisLabel : {
                formatter: function(b){ 
                    var v=numeral(b).format('0.0a');
                    return v;
                }  
            }
        }
    ],
    series : [
        {
            name:"{{ $bamprd000['TitBar'] or 'Não Cadastrado' }}",
            type:'bar',
            xAxisIndex: 1,
            yAxisIndex: 1,
            data:(function (){
                var res = [];
                var len = 15;
                while (len--) {
                   res.push(0);
                }
                return res;
            })()
        },
        {
            name: "{{ $bamprd000['TitLin'] or 'Não Cadastrado' }}",
            type:'line',
            data:(function (){
                var res = [];
                var len = 0;
                while (len < 15) {
                    res.push(0);
                    len++;
                }
                return res;
            })()
        }
    ]
};


function get_bamprd000(){
    var DatMov;
    var VlrLin;
    var VlrBar;
    $.ajax({
        type: "GET",
        url: "{{url('bam/get_bamprd000')}}"+"{{ $bamprd000['CodBam'] or '' }}",
        dataType : 'json',
        success: function(bamprd000){
            DatMov = bamprd000[0].DatMov; //(new Date()).toLocaleTimeString().replace(/^\D*/,'');
            VlrLin = parseFloat(bamprd000[0].VlrLin);
            VlrBar = parseFloat(bamprd000[0].VlrBar);
            VlrGau = parseFloat(VlrBar/VlrLin*100);
            VlrGau = numeral(VlrGau).format('0,0');

            gaugeData.series[0].data[0].value = (VlrGau);
            gauge.setOption(gaugeData, true);

            var data0 = bamprd000sData.series[0].data;
            var data1 = bamprd000sData.series[1].data;
            data0.shift();
            data0.push(VlrBar);
            data1.shift();
            data1.push((VlrLin).toFixed(1) - 0);


            bamprd000sData.xAxis[0].data.shift();
            bamprd000sData.xAxis[0].data.push(DatMov);
            bamprd000s.setOption(bamprd000sData);
        },
        error: function(error){
            showNotification( 'Endereço não Localizado :(<br>"'+error.status+':'+error.statusText+'"', 'danger');
        }
    });
};
</script>



<script type="text/javascript">
//
//
//Grafico de barras Produção 12 Horas
//
//
var bamprd000Barra = echarts.init(document.getElementById('bamprd000Barra'), 'macarons');

bamprd000BarraData = {
    title: {
        x: 'left',
        text: "{{ $bamprd000['TitBam'] or 'Não Cadastrado' }}",
        subtext: "{{ $bamprd000['NomBam'] or 'Não Cadastrado' }}",
        link: '#'
    },
    tooltip: {
        trigger:'axis',
        formatter: function(a){
            return formatarTootip(a);
        },
    },
    toolbox: {
        show: false,
        feature: {
            dataView: {show: false, readOnly: false},
            restore: {show: true},
            saveAsImage: {show: true}
        }
    },
    calculable: false,
    grid: {
        borderWidth: 0,
        y: 80,
        y2: 60
    },
    xAxis: [
        {
            type: 'category',
            show: false,
            data: ['']
            
        }
    ],
    yAxis: [
        {
            type: 'value',
            show: true,
            scale: true,
            //boundaryGap: [0.2, 0.2],
            axisLabel : {
                formatter: function(b){ 
                    var v=numeral(b).format('0.0a');
                    return v;
                }  
            }
        }
    ],
    series: [
        {
            name: "{{ $bamprd000['NomBam'] or 'Não Cadastrado'}}",
            type: 'bar',
            itemStyle: {
                normal: {
                    color: function(params) {
                        var colorList = [
                          '#C1232B','#B5C334','#FCCE10','#E87C25','#27727B',
                           '#FE8463','#9BCA63','#FAD860','#F3A43B','#60C0DD',
                           '#D7504B','#C6E579','#F4E001','#F0805A','#26C0C0'
                        ];
                        return colorList[params.dataIndex]
                    },
                  
                    label: {
                        show: true,
                        position: 'bottom',
                        formatter: function(b){
                            var n =b.name;                        
                            var v=numeral(b.value).format('0.0a');
                            //var v=numeral(parseFloat(b.value)).format('$0,0.00');

                            return n+'\n'+v;
                        }
                    }
                }
            },
            data: [,,,,,,,,,,,],
            markPoint: {
                tooltip: {
                    trigger: false,
                    backgroundColor: 'rgba(0,0,0,0)',
                    formatter: function(params){
                        return '<img src="' 
                                + params.data.symbol.replace('image://', '')
                                + '"/>';
                    }
                },
                data: [
                    {xAxis:0, x: 350, name:'', symbolSize:0, symbol: ''},
                    {xAxis:1, y: 350, name:'', symbolSize:0, symbol: ''},
                    {xAxis:2, y: 350, name:'', symbolSize:0, symbol: ''},
                    {xAxis:3, y: 350, name:'', symbolSize:0, symbol: ''},
                    {xAxis:4, y: 350, name:'', symbolSize:0, symbol: ''},
                    {xAxis:5, y: 350, name:'', symbolSize:0, symbol: ''},
                    {xAxis:6, y: 350, name:'', symbolSize:0, symbol: ''},
                    {xAxis:7, y: 350, name:'', symbolSize:0, symbol: ''},
                    {xAxis:8, y: 350, name:'', symbolSize:0, symbol: ''},
                    {xAxis:9, y: 350, name:'', symbolSize:0, symbol: ''},
                    {xAxis:10, y: 350, name:'', symbolSize:0, symbol: ''},
                    {xAxis:11, y: 350, name:'', symbolSize:0, symbol: ''},
                ]
            }
        }
    ]
};


function get_barra(){
    $.ajax({
        url: "{{url('bam/get_barra')}}"+"{{ $bamprd000['CodBam'] or '' }}",
        dataType : 'json',
        success: function(get_barra){
            
            bamprd000BarraData.series.data = [];
            bamprd000BarraData.xAxis.data = [];

            $.each( get_barra, function(k, v){
                bamprd000BarraData.series[0].data[k] = parseFloat(v.VlrBar);
                bamprd000BarraData.xAxis[0].data[k] = v.HraMov;
            });
                    
            bamprd000Barra.setOption(bamprd000BarraData, true);
        }
    });
}

</script>


<script type="text/javascript">
//
//
//Gráfico de Ponteiros
//
//
var gauge = echarts.init(document.getElementById('gauge'), 'macarons');

var gaugeData = {
    title : {
        text: 'Meta',
            subtext: 'Rentabilidade'
        },
        tooltip : {
            formatter: "{a} {b} : {c}%"
        },
        toolbox: {
            show : false,
            y: 'bottom',
            feature : {
                restore : {show: true},
                saveAsImage : {show: true}
            }
        },
        series : [
            {
                name:'Meta',
                type:'gauge',
                detail : {formatter:'{value}%'},
                data:[{value: 0, name: ''}]
            }
        ]
    };
</script>


<script type="text/javascript">
function RefreshChart(){
	$.ajax({
		
		url:""
	   	,success: function(chartData){
	   		
	        chart1 = (chartData[0].Files);
	        verxml1 = (chartData[0].VerXml);
	        
	        NumArq = (chartData['NumArq']);
	        NumSai = (chartData['NumSai']);
	        NumEnt = (chartData['NumEnt']);
	        NumEmp = (chartData['NumEmp']);
	        
	        $('div[nfi^=Num]').each(function(){
	            if ($(this).attr('nfi') == 'NumArq'){
	                $(this).html(NumArq);
	                
	                
	            } else if ($(this).attr('nfi') == 'NumSai'){
	                $(this).html(NumSai);
	                
	            	            
	            } else if ($(this).attr('nfi') == 'NumEnt'){
	                $(this).html(NumEnt);
	            
	            
	            } else if ($(this).attr('nfi') == 'NumEmp'){
	                $(this).html(NumEmp);
	            }
	            
	        });
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

    get_bamprd000();
    get_barra();

}, 2100);

$(document).ready( function (){
    
    get_bamprd000();
    get_barra();

});
//
//
//Redimensionar os Gráficos
//
//
window.onresize = function(){

    gauge.resize();
    bamprd000s.resize();
    bamprd000Barra.resize();

};
</script>
@stop