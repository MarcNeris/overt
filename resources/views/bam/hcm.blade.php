@extends('layouts.overtsidebar')
@section('css')
<script src="{{ asset('assets/crm/js/echarts.min.js') }}"></script>
@stop
@section('content')

<div class="row">
    <div class="col-lg-8 col-md-6 col-sm-6">
        <div class="card card-chart">
            <div class="card-header card-header-icon card-header-danger">
                <div class="card-icon">
                    <i class="material-icons">group</i>
                </div>
                <h4 class="card-title"><span id="TitBamr046verTotEve"></span></h4>
            </div>
            <div class="card-body">
                <div id="r046verTotEve" class="charts" style="height:350px;"></div>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">access_time</i>
                    <span id="DatLogr046verTotEve"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-chart">
            <div class="card-header card-header-icon card-header-danger">
                <div class="card-icon">
                    <i class="material-icons">group</i>
                </div>
                <h4 class="card-title"><span id="TitBamr034funQtdCol"></span></h4>
            </div>
            <div class="card-body">
                <div id="r034funQtdCol" class="charts" style="height:350px;"></div>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">access_time</i>
                    <span id="DatLogr034funQtdCol"></span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6">
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
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-chart">
            <div class="card-header card-header-icon card-header-danger">
                <div class="card-icon">
                    <i class="material-icons">group</i>
                </div>
                <h4 class="card-title"><span id="TitBamr034funPosTra"></span></h4>
            </div>
            <div class="card-body">
                <div id="r034funPosTra" class="charts" style="height:220px;"></div>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">access_time</i>
                    <span id="DatLogr034funPosTra"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-chart">
            <div class="card-header card-header-icon card-header-danger">
                <div class="card-icon">
                    <i class="material-icons">group</i>
                </div>
                <h4 class="card-title"><span id="TitBamr034funNomCcu"></span></h4>
            </div>
            <div class="card-body">
                <div id="r034funNomCcu" class="charts" style="height:220px;"></div>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">access_time</i>
                    <span id="DatLogr034funNomCcu"></span>
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
//CUSTO TOTAL DA FOLHA POR EVENTO r046verTotEveDesEve
//
//********************************************************************//
var r046verTotEve = echarts.init(document.getElementById('r046verTotEve'), 'infographic');

r046verTotEveData = {
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
                    v = numeral(parseFloat(d.value)).format('$0,0.00');
                    p = ' ('+d.percent+'%)';
                    return n+v+p;
                }
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


var r046verTotEveDesEve = function(){
    $.ajax({

        url:"{{ route('bam.r046verTotEveDesEve') }}"
        ,success: function(r046verTotEveDesEve){

            console.log(r046verTotEveDesEve);
           
            $('#TitBamr046verTotEve').html(r046verTotEveDesEve.TitBam);
            $('#DatLogr046verTotEve').html(r046verTotEveDesEve.DatLog);
        
            r046verTotEveData.title = {subtext:r046verTotEveDesEve.SubTxt, sublink: '#'};

            $.each( r046verTotEveDesEve.series, function(k, v){
                r046verTotEveData.series[0].data[k] = {value : v.TotEve, name : v.DesEve};
                r046verTotEveData.legend.data[k] = v.DesEve;
            });

            r046verTotEve.setOption(r046verTotEveData, true);
        }
    });
}    
</script>
<script type="text/javascript">
//********************************************************************//
//
//COLABORADORES POR SEXO r034funQtdColTipSex
//
//********************************************************************//
var r034funQtdCol = echarts.init(document.getElementById('r034funQtdCol'), 'infographic');

r034funQtdColData = {
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

var r034funQtdColTipSex = function(){
    $.ajax({

        url:"{{ route('bam.r034funQtdColTipSex') }}"
        ,success: function(r034funQtdColTipSex){
           
            $('#TitBamr034funQtdCol').html(r034funQtdColTipSex.TitBam);
            $('#DatLogr034funQtdCol').html(r034funQtdColTipSex.DatLog);
        
            r034funQtdColData.title = {subtext:r034funQtdColTipSex.SubTxt, sublink: '#'};

            $.each( r034funQtdColTipSex.series, function(k, v){
                r034funQtdColData.series[0].data[k] = {value : v.QtdCol, name : v.TipSex};
                r034funQtdColData.legend.data[k] = v.TipSex;
            });

            r034funQtdCol.setOption(r034funQtdColData, true);
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
//COLABORADORES POR LOCAL r034funPosTraQtdFun
//
//********************************************************************//
var r034funPosTra = echarts.init(document.getElementById('r034funPosTra'), 'infographic');

r034funPosTraData = {
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

var r034funPosTraQtdfun = function(){
    $.ajax({

        url:"{{route('bam.r034funPosTraQtdFun')}}"
        ,success: function(r034funPosTraQtdfun){
           
            $('#TitBamr034funPosTra').html(r034funPosTraQtdfun.TitBam);
            $('#DatLogr034funPosTra').html(r034funPosTraQtdfun.DatLog);
        
            r034funPosTraData.title = {subtext:r034funPosTraQtdfun.SubTxt, sublink: '#'};

            $.each( r034funPosTraQtdfun.series, function(k, v){
                r034funPosTraData.series[0].data[k] = {value : v.QtdFun, name : v.DesRed};
                r034funPosTraData.legend.data[k] = v.DesRed;
            });

            r034funPosTra.setOption(r034funPosTraData, true);
        }
    });
}
</script>
<script type="text/javascript">
//********************************************************************//
//
//COLABORADORES POR LOCAL r034funNomCcuQtdFun
//
//********************************************************************//
var r034funNomCcu = echarts.init(document.getElementById('r034funNomCcu'), 'infographic');

r034funNomCcuData = {
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

var r034funNomCcuQtdFun = function(){
    $.ajax({

        url:"{{route('bam.r034funNomCcuQtdFun')}}"
        ,success: function(r034funNomCcuQtdFun){
           
            $('#TitBamr034funNomCcu').html(r034funNomCcuQtdFun.TitBam);
            $('#DatLogr034funNomCcu').html(r034funNomCcuQtdFun.DatLog);
        
            r034funNomCcuData.title = {subtext:r034funNomCcuQtdFun.SubTxt, sublink: '#'};

            $.each( r034funNomCcuQtdFun.series, function(k, v){
                r034funNomCcuData.series[0].data[k] = {value : v.QtdFun, name : v.NomCcu};
                r034funNomCcuData.legend.data[k] = v.NomCcu;
            });

            r034funNomCcu.setOption(r034funNomCcuData, true);
        }
    });
}
</script>

<script type="text/javascript">
//********************************************************************//
//
//Atualizar os Gráficos
//
//********************************************************************//
setInterval(function (){
    r034funQtdColTipSex();
    r034funNumLocQtdfun();  
    r034funPosTraQtdfun();  
    r034funNomCcuQtdFun();
}, 10000);
//********************************************************************//
//
//Iniciar os Gráficos
//
//********************************************************************//
$(document).ready( function (){
    r046verTotEveDesEve();
    r034funQtdColTipSex();
    r034funNumLocQtdfun();  
    r034funPosTraQtdfun();  
    r034funNomCcuQtdFun();
});

</script>
@stop