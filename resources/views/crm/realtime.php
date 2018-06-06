var myChartx = echarts.init(document.getElementById('barradinamica'), 'macarons');
 
option = {
    title : {
        text: 'Monitoramento Ativo',
        subtext: 'Tempo Real'
    },
    tooltip : {
        trigger: 'axis'
    },
    legend: {
        data:['Entradas', 'Saídas']
    },
    toolbox: {
        show : false,
        feature : {
            mark : {show: true},
            dataView : {show: true, readOnly: false},
            magicType : {show: true, type: ['bar', 'bar']},
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
                var len = 20;
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
                var len = 20;
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
            scale: true,
            name : '价格',
            boundaryGap: [0.2, 0.2]
        },
        {
            type : 'value',
            scale: true,
            name : '预购量',
            boundaryGap: [0.2, 0.2]
        }
    ],
    yAxis : [
        {
            type : 'value',
            scale: true,
            name : '',
            boundaryGap: [0.2, 0.2]
        },
        {
            type : 'value',
            scale: false,
            name : '',
            boundaryGap: [0.2, 0.2]
        }
    ],
    series : [
        {
            name:'Saídas',
            type:'bar',
            xAxisIndex: 1,
            yAxisIndex: 1,
            data:(function (){
                var res = [];
                var len = 20;
                while (len--) {
                    res.push(Math.round(0));
                }
                return res;
            })()
        },
        {
            name:'Entradas',
            type:'line',
            data:(function (){
                var res = [];
                var len = 20;
                while (len--) {
                    res.push( 0);
                }
                return res;
            })()
        }
    ]
};

//myChart.setOption(option);


var lastData = 11;
var axisData;

var timeTicket;

clearInterval(timeTicket);

timeTicket = setInterval(function (){
    lastData += Math.random() * ((Math.round(Math.random() * 10) % 2) == 0 ? 1 : -1);
    lastData = lastData.toFixed(1) - 0;
    axisData = (new Date()).toLocaleTimeString().replace(/^\D*/,'');


    $.ajax({
            
        url:"{{ url('/nfi/barradinamica') }}"
        ,success: function(barradinamica){
            
            console.debug(barradinamica);

            var EmiDia=barradinamica.EmiDia;
            var DstDia=barradinamica.DstDia;
            var dia=barradinamica.dia;

            option.title={
        text: 'Monitoramento sxxx',
        subtext: 'Tempo Real'
    }

            myChart.addData([
                [
                    0,        
                    //Math.round(Math.random() * 1000),
                    EmiDia,
                    true,     
                    false     
                ],
                [
                    1,        
                    //lastData,
                    DstDia, 
                    false,    
                    false,    
                    axisData  
                ]
            ]);

        }

    });
    
}, 2100);
                    


if (option && typeof option === "object") {
    myChart.setOption(option, true);   
}