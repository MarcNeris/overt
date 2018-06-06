@extends('layouts.overtsidebar')
@section('css')
<script src="{{ asset('assets/crm/js/echarts-all.js') }}"></script>

@stop
@section('content')
<div class="card card-nav-tabs">
  <h4 class="card-header card-header-rose">BAM - Business Activity Monitoring</h4>
  <div class="card-body">
    <h4 class="card-title">Faturamento</h4>
    <div id="faturamentobarraX" style="height:300px;"></div>
    	
    	<div id="faturamentobarra" style="height:300px;"></div>
  </div>
</div>
<div class="row"> 
	<div class="col-md-6">
	  <div class="card card-chart" data-count="4">
	      <div class="card-header card-header-info" data-header-animation="true">
	        <div id="bam" style="height:300px"></div>

	      </div>
	      <div class="card-body">
	          <div class="card-actions">
	              <button type="button" class="btn btn-danger btn-link fix-broken-card">
	                  <i class="material-icons">build</i> Fix Header!
	              </button>
	              <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="" data-original-title="Atualizar">
	                  <i class="material-icons">refresh</i>
	              </button>
	              <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="" data-original-title="Alterar">
	                  <i class="material-icons">edit</i>
	              </button>
	          </div>
	          <h4 class="card-title">Faturamento x Saídas</h4>
	          <p class="card-category">Performance da Campanha</p>
	      </div>
	      <div class="card-footer">
	          <div class="stats">
	              <i class="material-icons">access_time</i> A Campanha iniciou há uma semana
	          </div>
	      </div>
	  </div>
	</div>
</div>












<div class="col-xs-12">
                
			</div>
			
			<div class="col-xs-9">
				<div id="gauge" style="height:300px;"></div>
			</div>
			
			<div class="col-xs-6">
				
			</div>
			
			<div class="col-xs-12">
				<div id="barradinamica" style="height:350px;"></div>
			</div>

			<div class="col-xs-12">
				<div id="line" style="height:350px;"></div>
			</div>
			
			<div class="col-xs-6">
				<div id="piefunnel_1" style="height:350px;"></div>
			</div>



@endsection
@section('js')

<script type="text/javascript">


window.onresize = function(){
    faturamentobarra.resize();
    bam.resize();       
    gauge.resize();       
    line.resize();       
    piefunnel.resize();      
    //barradinamica.resize();
    myChart.resize();  
};


var bam = echarts.init(document.getElementById('bam'), 'macarons');

bamchart = {
     title: {
        x: 'left',
        text: 'Entradas',
        subtext: '7 dias'
        //link: '#'
    },
    tooltip : {
        trigger: 'axis'
    },
    toolbox: {
        show : false,
        y: 'bottom',
        feature : {
            mark : {show: true},
            dataView : {show: true, readOnly: false},
            magicType : {show: true, type: ['line', 'bar', 'stack', 'tiled']},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    calculable : true,
    legend: {
        data:['','','','百度','谷歌','必应','其他']
    },
    xAxis : [
        {
            type : 'category',
            splitLine : {show : false},
            data : ['','','','','','']
        }
    ],
    yAxis : [
        {
            type : 'value',
            position: 'right'
        }
    ],
    series : [
         
        {
            name:'Meta',
            type:'line',
            data:[862, 1018, 964, 1026, 1679, 1600]
        },

        {
            name:'Fornecedor',
            type:'pie',
            tooltip : {
                trigger: 'item',
                formatter: '{a} <br/>{b} : {c} ({d}%)'
            },
            center: [160,130],
            radius : [0, 50],
            itemStyle :　{
                normal : {
                    labelLine : {
                        length : 20
                    }
                }
            },
            data:[
                {value:1048, name:'百度'},
                {value:251, name:'谷歌'},
                {value:147, name:'必应'},
                {value:102, name:'其他'}
            ]
        }
    ]
};
                    
                    
      
bam.setOption(bamchart, true);

var refreshbBam = function(){
		$.ajax({
			
			url:"{{ url('/nfi/databam') }}"
		   	,success: function(dataBam){
		   		$.each(dataBam.legend, function(a, b){
		   			bamchart.legend.data[a] = b;

                });

				$.each(dataBam.dias, function(k, v){
					bamchart.xAxis[0].data[k] = v;
				});

                $.each(dataBam.dados, function(k, v){
                    bamchart.series[k]={
                        name:v.name,
                        type:v.type,
                        tooltip : {trigger: 'item'},
                        stack:v.stack,
                        data:v.data
                    }
                    //console.debug(v);
                });
                    
					
       
		    	bam.setOption(bamchart, true);
		    }
		});
	}

//setInterval(refreshbBam, 10000);
$(document).ready(refreshbBam);


///Real Time Faturamento

var faturamentobarraX = echarts.init(document.getElementById('faturamentobarraX'), 'macarons');
var RealTime = {
    title : {
        text: 'Produção',
        subtext: 'Produção Real Time'
    },
    tooltip : {
        trigger: 'axis'
    },
    legend: {
        data:['Meta', 'Produção']
    },
    toolbox: {
        show : false,
        feature : {
            mark : {show: true},
            dataView : {show: true, readOnly: false},
            magicType : {show: true, type: ['line', 'bar']},
            restore : {show: true},
            saveAsImage : {show: true}
        }
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
                var now = new Date();
                var res = [];
                var len = 10;
                while (len--) {
                    res.unshift(now.toLocaleTimeString().replace(/^\D*/,''));
                    now = new Date(now - 2000);
                }
                return res;
            })()
        },
        {
            type : 'category',
            boundaryGap : true,
            data : (function (){
                var res = [];
                var len = 10;
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
            name : 'Hora',
            boundaryGap: [0.2, 0.2]
        },
        {
            type : 'value',
            scale: false,
            name : 'Minuto',
            boundaryGap: [0.2, 0.2]
        }
    ],
    series : [
        {
            name:'Produção',
            type:'bar',
            xAxisIndex: 1,
            yAxisIndex: 1,
            data:(function (){
                var res = [];
                var len = 10;
                while (len--) {
                    res.push(Math.round(Math.random() * 1000));
                }
                return res;
            })()
        },
        {
            name:'Meta',
            type:'line',
            data:(function (){
                var res = [];
                var len = 10;
                while (len--) {
                    res.push((Math.random()*10 + 5).toFixed(1) - 0);
                }
                return res;
            })()
        }
    ]
};



var lastData = 11;

var axisData;

//clearInterval(timeTicket);
timeTicket = setInterval(function (){
    lastData += Math.random() * ((Math.round(Math.random() * 10) % 2) == 0 ? 1 : -1);
    lastData = lastData.toFixed(1) - 0;
    axisData = (new Date()).toLocaleTimeString().replace(/^\D*/,'');
    
    // 动态数据接口 addData
    faturamentobarraX.addData([
        [
            0,        // 系列索引
            Math.round(Math.random() * 1000), // 新增数据
            true,     // 新增数据是否从队列头部插入
            false     // 是否增加队列长度，false则自定删除原有数据，队头插入删队尾，队尾插入删队头
        ],
        [
            1,        // 系列索引
            lastData, // 新增数据
            false,    // 新增数据是否从队列头部插入
            false,    // 是否增加队列长度，false则自定删除原有数据，队头插入删队尾，队尾插入删队头
            axisData  // 坐标轴标签
        ]
    ]);
}, 2100);

faturamentobarraX.setOption(RealTime, true);
































//Grafico de barras Faturamento últimos 12 meses
var faturamentobarra = echarts.init(document.getElementById('faturamentobarra'), 'macarons');
barrachart = {
    title: {
        x: 'left',
        text: 'Faturamento Mensal',
        subtext: 'Faturamento dos Últimos 12 Meses'
        //link: '#'
    },
    tooltip: {
        trigger: false
    },
    toolbox: {
        show: false,
        feature: {
            dataView: {show: false, readOnly: false},
            restore: {show: true},
            saveAsImage: {show: true}
        }
    },
    calculable: true,
    grid: {
        borderWidth: 0,
        y: 80,
        y2: 60
    },
    xAxis: [
        {
            type: 'category',
            show: false,
            data: ['', '', '', '', '', '', '', '', '', '', '', '']
            
        }
    ],
    yAxis: [
        {
            type: 'value',
            show: false
        }
    ],
    series: [
        {
            name: 'Faturamento',
            type: 'bar',
            itemStyle: {
                normal: {
                    color: function(params) {
                        // build a color map as your need.
                        var colorList = [
                          '#C1232B','#B5C334','#FCCE10','#E87C25','#27727B',
                           '#FE8463','#9BCA63','#FAD860','#F3A43B','#60C0DD',
                           '#D7504B','#C6E579','#F4E001','#F0805A','#26C0C0'
                        ];
                        return colorList[params.dataIndex]
                    },
                  
                    label: {
                        show: true,
                        position: 'top',
                        formatter: '{b}\n R${c}'
                    }
                }
            },
            data: [,,,,,,,,,,,],
            markPoint: {
                tooltip: {
                    trigger: false,
                    backgroundColor: 'rgba(0,0,0,0)',
                    formatter: function(params){
                       /* return '<img src="' 
                                + params.data.symbol.replace('image://', '')
                                + '"/>';*/
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


faturamentobarra.setOption(barrachart, true);



var Refreshbarra = function(){
		$.ajax({
			
			url:"{{ url('/nfi/databarrachart') }}"
		   	,success: function(barradata){
		   		
		        barrachart.series.data = [];
		        barrachart.xAxis.data = [];

		        $.each( barradata, function(k, v){
		            barrachart.series[0].data[k] = v.VlrSai;
		            barrachart.xAxis[0].data[k] = v.MesEmi;
		            
		    	});
		                
		    	faturamentobarra.setOption(barrachart, true);
		    }
		});
	}

//etInterval(Refreshbarra, 10000);
$(document).ready(Refreshbarra);





















//Gráfico de Ponteiros
var gauge = echarts.init(document.getElementById('gauge'), 'macarons');

var gaugechart = {
     title : {
            text: 'Meta',
            subtext: 'Retabilidade'
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

gauge.setOption(gaugechart, true);













//Gráfico de Linhas
var line = echarts.init(document.getElementById('line'), 'macarons');
linechart = {
       title : {
        text: 'Entradas x Saidas',
        subtext: '12 meses'
    },
    tooltip : {
        trigger: 'axis'
    },
    legend: {
        data:['Produto2','Produto3','Produto4','Produto5','Produto6']
    },
    toolbox: {
        show : false,
        feature : {
            mark : {show: true},
            dataView : {show: true, readOnly: false},
            magicType : {show: true, type: ['line', 'bar']},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    calculable : true,
    xAxis : [
        {
            type : 'category',
            boundaryGap : false,
            data : ['Segunda','Terça','Quarta','Quinta','Sexta','Sabado','Domingo']
        }
    ],
    yAxis : [
        {
            type : 'value',
            axisLabel : {
                formatter: '{value} °C'
            }
        }
    ],
    series : [
       
        {
            name:'Produto2',
            type:'line',
            data:[20, 11, 15, 13, 555, 13, 2232],
            
           
        },
        {
            name:'Produto3',
            type:'line',
            data:[1, -222, 100, 5, 3, 2, 0],
           
           
        },
        {
            name:'Produto4',
            type:'line',
            data:[1, -33, 100, 5, 3, 2, 0],
           
           
        },
        {
            name:'Produto5',
            type:'line',
            data:[1, -33, 100, 5, 3, 2, 0],
           
           
        },
        {
            name:'Produto6',
            type:'line',
            data:[20000, -33, 100, 5, 3, 2, 0],
           
           
        }
     
    ]
};
line.setOption(linechart, true);















        
        
        
        
   
    var piefunnel = echarts.init(document.getElementById('piefunnel_1'), 'macarons');
    piefunnel_1 = {
    tooltip : {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },
    legend: {
        orient : 'vertical',
        x : 'left',
        data:[]
    },
    toolbox: {
        show : false,
        feature : {
            mark : {show: true},
            dataView : {show: true, readOnly: false},
            magicType : {
                show: true, 
                type: ['pie', 'funnel'],
                option: {
                    funnel: {
                        x: '25%',
                        width: '50%',
                        funnelAlign: 'center',
                        max: 1548
                    }
                }
            },
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    calculable : true,
    series : [
        {
            name:'Modelo de Documentos',
            type:'pie',
            radius : ['60%', '70%'],
            itemStyle : {
                normal : {
                    label : {
                        show : false
                    },
                    labelLine : {
                        show : false
                    }
                },
                emphasis : {
                    label : {
                        show : true,
                        position : 'center',
                        textStyle : {
                            fontSize : '20',
                            fontWeight : 'bold'
                        }
                    }
                }
            },
            data:[
                {value:1, name:'a'}            ]
        }
    ]
};
piefunnel.setOption(piefunnel_1, true);









	var RefreshChart = function(){
		$.ajax({
			
			url:"{{ url('/nfi/datadashboard') }}"
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
		        gaugechart.series[0].data[0].value = (NumEnt);
		        gauge.setOption(gaugechart, true);

		        piefunnel_1.series[0].data = [];
		        piefunnel_1.legend.data = [];

		        $.each( chartData, function(k, v){
		            piefunnel_1.series[0].data[k] = {value : v.Files, name : v.VerXml};
		            piefunnel_1.legend.data[k] = v.VerXml;
		    	});
		                
		    	piefunnel.setOption(piefunnel_1, true);
		    }
		});
	}

//setInterval(RefreshChart, 10000);


$(document).ready(RefreshChart);





 


    
</script>

@stop