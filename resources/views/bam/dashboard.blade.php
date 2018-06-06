@extends('layouts.overtsidebar')
@section('css')
<script src="{{ asset('assets/crm/js/echarts.min.js') }}"></script>
@stop
@section('content')

<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6">
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
    <div class="col-lg-3 col-md-6 col-sm-6">
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
    
    <div class="col-lg-3 col-md-6 col-sm-6">
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

    <div class="col-lg-3 col-md-6 col-sm-6">
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
//Iniciar e Atualizar os Gráficos
//
//********************************************************************//
var charts = $(document).ready( function (){
        dashboardPainelData();
        r034funNumLocQtdfun();  
        r034funPosTraQtdfun();  
        r034funNomCcuQtdFun();
})

setInterval(function (){
    dashboardPainelData();
    r034funNumLocQtdfun();
    r034funPosTraQtdfun();
    r034funNomCcuQtdFun(); 
}, 60000);
</script>

@stop