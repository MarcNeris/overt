 <input class="form-control" pattern="^\d{3}.\d{3}.\d{3}-\d{2}$" type="tel">



 $.getJSON('https://www.receitaws.com.br/v1/cnpj/03616712000128', function(data){
  if(data)console.log(data);
});


<script type="text/javascript">
function selecionar(uf)
{
	var combo = document.getElementById("combo");
	
	for (var i = 0; i < combo.options.length; i++)
	{
		if (combo.options[i].value == uf)
		{
			combo.options[i].selected = "true";
			break;
		}
	}
}
</script>

<script type="text/javascript">

var e650salSalMes = echarts.init(document.getElementById('e650salSalMes'), 'macarons');

var e650salSalMesData = {
    timeline:{
        data:[
            '2016','2017','2018'
        ],
        label : {
            formatter : function(s) {
                return s.slice(0, 4);
            }
        },
        autoPlay : true,
        playInterval : 4000
    },
    options:[
        {
            title : {
                'text':'2016',
                'subtext':'Faturamento Anual'
            },
            tooltip : {'trigger':'axis'},
            legend : {
                x:'right',
                'data':['Receitas','Despesas','Matéria Prima','Energia','Mão de Obra','DESPESAS'],
                'selected':{
 
                    'DESPESAS':true
                }
            },
            calculable : true,
            grid: {
                top: 80,
                bottom: 100,
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'shadow',
                        label: {
                            show: true,
                            formatter: function (params) {
                                return params.value.replace('\n', '');
                            }
                        }
                    }
                }
            },
            //grid : {'y':80,'y2':100},
            xAxis : [{
                'type':'category',
                'axisLabel':{'interval':0},
                'data':[
                    'Jan','Fev','Mar','Abr','Mai','Jun','jul','Ago','Set','Out','Nov','Dez',
                ]
            }],
            yAxis : [
                {
                    'type':'value',
                    'name':'Faturamento（Reais）',
                    'max':53500
                },
                {
                    'type':'value',
                    'name':'Despesas（Reais）'
                }
            ],
            series : [

                {
                    'name':'Receitas','yAxisIndex':1,'type':'bar',
                    'data': ''
                },

                {
                    'name':'Despesas','yAxisIndex':1,'type':'bar',
                    'data': ''
                },
                {
                    'name':'Matéria Prima','yAxisIndex':1,'type':'bar',
                    'data': ''
                },
                {
                    'name':'Energia','yAxisIndex':1,'type':'bar',
                    'data': ''
                },
                {
                    'name':'Mão de Obra','yAxisIndex':1,'type':'bar',
                    'data': ''
                },
                {
                    'name':'DESPESAS','yAxisIndex':1,'type':'bar',
                    'data': dataMap.dataTI['2016']
                }
            ]
        },

        {
            title : {'text':'2017'},
            series : [

                {'data': dataMap.dataTI['2017']}
            ]
        },
        {
            title : {'text':'2018'},
            series : [

                {'data': dataMap.dataTI['2018']}
            ]
        }
    ]
};

//console.log(e650salSalMesData);

e650salSalMes.setOption(e650salSalMesData, true);

function e650salSalMesCtaRed(){
    $.ajax({
        url:"{{ route('senior.e650salSalMesCtaRed') }}"
        ,success: function(e650salSalMesCtaRed){
            $.each(e650salSalMesCtaRed.legend, function(k, v){
                //e650salSalMesData.timeline.data[k]=v;
            });

            $.each(e650salSalMesCtaRed.contas, function(k, v){
                e650salSalMesData.options[0].legend.data[k]=v;
                e650salSalMesData.options[0].series[k]={name: v , type: "bar", yAxisIndex: 1};
            });

            console.log(e650salSalMesData);


            $.each(e650salSalMesCtaRed.data, function(k, data){

                //console.log(data);

                $.each(data, function(k, v){
                    //e650salSalMesData.options[k].series[k].data[k];

//console.log(e650salSalMesData.options[k].series[k].data={name: v.DesCta, yAxisIndex: 1, type: "bar", data:['1000','2000']});
                //console.log(e650salSalMesData.options[0].series[k].name);
                //console.log(v.DesCta);
                //e650salSalMesData.options[0].series[k] = 
                //{name: v.DesCta, yAxisIndex: 1, type: "bar", data:['1000','2000']};

                });
            });



            
            $.each(e650salSalMesCtaRed.timeline, function(k, v){

                e650salSalMesData.options[0].xAxis[0].data[k]=v;
                //e600mesSalMesData.legend.data[k] = v.NumCco;
                //e600mesSalMesData.yAxis.data[k] = v.NumCco;
                //e600mesSalMesData.series[0].data[k] = {value : v.SalMes};
            });

            e650salSalMes.setOption(e650salSalMesData, true);
        }
    });
}




</script>



