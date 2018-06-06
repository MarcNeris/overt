@extends('layouts.overtsidebar')
@section('css')
<script src="{{ asset('assets/crm/js/echarts.min.js') }}"></script>
@stop
@section('content')
<div class="row">
    <div class="col-md-2">
        <div class="card card-chart">
            <div class="card-header card-header-icon card-header-rose">
                <div class="card-icon">
                    <i class="material-icons">equalizer</i>
                </div>
                <h4 class="card-title"><span>ORP ABE</span></h4>
                <hr class="card-title">
            </div>
            <div class="card-footer">
                <div class="stats"><hr>
                    <i class="material-icons">access_time</i><span></span>
                </div>
                <h4><span class="text-right text-danger" bam="QtdOrp">...</span></h4>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card card-chart">
            <div class="card-header card-header-icon card-header-rose">
                <div class="card-icon">
                    <i class="material-icons">equalizer</i>
                </div>
                <h4 class="card-title"><span>EOQ</span></h4>
                <hr class="card-title">
            </div>
            <div class="card-footer">
                <div class="stats"><hr>
                    <i class="material-icons">access_time</i><span></span>
                </div>
                <h4><span class="text-right text-danger" bam="QtdEoq">...</span></h4>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card card-chart">
            <div class="card-header card-header-icon card-header-rose">
                <div class="card-icon">
                    <i class="material-icons">equalizer</i>
                </div>
                <h4 class="card-title"><span>PED ABE</span></h4>
                <hr class="card-title">
            </div>
            <div class="card-footer">
                <div class="stats"><hr>
                    <i class="material-icons">access_time</i><span></span>
                </div>
                <h4><span class="text-right text-danger" bam="QtdPed">...</span></h4>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card card-chart">
            <div class="card-header card-header-icon card-header-rose">
                <div class="card-icon">
                    <i class="material-icons">equalizer</i>
                </div>
                <h4 class="card-title"><span>OCP ABE</span></h4>
                <hr class="card-title">
            </div>
            <div class="card-footer">
                <div class="stats"><hr>
                    <i class="material-icons">access_time</i><span></span>
                </div>
                <h4><span class="text-right text-danger" bam="QtdOcp">...</span></h4>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card card-chart">
            <div class="card-header card-header-icon card-header-rose">
                <div class="card-icon">
                    <i class="material-icons">equalizer</i>
                </div>
                <h4 class="card-title"><span>OPE ATV</span></h4>
                <hr class="card-title">
            </div>
            <div class="card-footer">
                <div class="stats"><hr>
                    <i class="material-icons">access_time</i><span></span>
                </div>
                <h4><span class="text-right text-danger" bam="QtdOpe">...</span></h4>
            </div>
        </div>
    </div>
     <div class="col-md-2">
        <div class="card card-chart">
            <div class="card-header card-header-icon card-header-rose">
                <div class="card-icon">
                    <i class="material-icons">equalizer</i>
                </div>
                <h4 class="card-title"><span>PRO ATV</span></h4>
                <hr class="card-title">
            </div>
            <div class="card-footer">
                <div class="stats"><hr>
                    <i class="material-icons">access_time</i><span></span>
                </div>
                <h4><span class="text-right text-danger" bam="QtdPro">...</span></h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-6 col-sm-6">
        <div class="card card-chart">
            <div class="card-header card-header-icon card-header-rose">
                <div class="card-icon">
                    <i class="material-icons">equalizer</i>
                </div>
                <h4 class="card-title"><span id="TitBame900eoqNumOrp"></span></h4>
            </div>
            <div class="card-body">
                <div id="e900eoqNumOrp" class="charts" style="height:350px;"></div>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">access_time</i>
                    <span id="DatLoge900eoqNumOrp"></span>
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
//PAINEL DASHBOARD bam/operacoes
//
//********************************************************************//
var get_DshOpe = function(){
    $.ajax({
        url:"{{url('bam/get_DshOpe')}}"
        ,success: function(get_DshOpe){
            $('span[bam]').each(function(){
                if ($(this).attr('bam') == 'QtdOrp'){
                    $(this).html(numeral(get_DshOpe.QtdOrp).format('0.00a'));
                }
                if ($(this).attr('bam') == 'QtdEoq'){
                    $(this).html(numeral(get_DshOpe.QtdEoq).format('0.00a'));
                }
                if ($(this).attr('bam') == 'QtdPed'){
                    $(this).html(numeral(get_DshOpe.QtdPed).format('0.00a'));
                }
                if ($(this).attr('bam') == 'QtdOcp'){
                    $(this).html(numeral(get_DshOpe.QtdOcp).format('0.00a'));
                }
                if ($(this).attr('bam') == 'QtdOpe'){
                    $(this).html(numeral(get_DshOpe.QtdOpe).format('0.00a'));
                }
                if ($(this).attr('bam') == 'QtdPro'){
                    $(this).html(numeral(get_DshOpe.QtdPro).format('0.00a'));
                }
            })
        }
    });
}    
</script>

<script type="text/javascript">
//********************************************************************//
//
//PAINEL DASHBOARD bam/operacoes/acompanhamento op
//
//********************************************************************//
var e900eoqNumOrp = echarts.init(document.getElementById('e900eoqNumOrp'), 'macarons');


var e900eoqNumOrpData = {
    title : {
        text: '',
        subtext: ''
    },
    tooltip: {
        trigger: 'axis',
        formatter: function(a){
            return formatarTooltipNumero(a);
        },
        axisPointer: {
            type: 'cross',
            label: {
                backgroundColor: '#283b56'
            }
        }
    },
    legend: {
        data:[]
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
        },
        {
            type : 'value',
            scale: true,
            name : '',
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
            name:'',
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
            name: '',
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

function e900eoqCodProQtdOrp(){
    var DatMov;
    var VlrLin;
    var VlrBar;
    $.ajax({
        type: "GET",
        url: "{{url('bam/e900eoqCodProQtdOrp')}}"+"/{{ $NumOrp }}",
        dataType : 'json',
        success: function(e900eoqCodProQtdOrp){

            $('#TitBame900eoqNumOrp').html(e900eoqCodProQtdOrp.TitBam);
            $('#DatLoge900eoqNumOrp').html(e900eoqCodProQtdOrp.DatLog);
            
            e900eoqNumOrpData.title = {subtext:e900eoqCodProQtdOrp.SubTxt, sublink: '#'};


            DatMov = moment(e900eoqCodProQtdOrp.series.DatRea).format('DD/MM');
            VlrLin = parseFloat(e900eoqCodProQtdOrp.series.QtdPrv);
            VlrBar = parseFloat(e900eoqCodProQtdOrp.series.QtdRe1);

            CodPro = e900eoqCodProQtdOrp.series.CodPro;
            NomPrv = e900eoqCodProQtdOrp.series.NomPrv

            var data0 = e900eoqNumOrpData.series[0].data;
            var data1 = e900eoqNumOrpData.series[1].data;
            data0.shift();
            data0.push(VlrBar);
            data1.shift();
            data1.push((VlrLin).toFixed(1) - 0);

            e900eoqNumOrpData.series[1].name = NomPrv;
            e900eoqNumOrpData.legend.data[1] = NomPrv;
            e900eoqNumOrpData.series[0].name = CodPro;
            e900eoqNumOrpData.legend.data[0] = CodPro;

            e900eoqNumOrpData.xAxis[0].data.shift();
            e900eoqNumOrpData.xAxis[0].data.push(DatMov);

            e900eoqNumOrp.setOption(e900eoqNumOrpData);
        },
        error: function(error){
            showNotification( 'Endereço não Localizado :(<br>"'+error.status+':'+error.statusText+'"', 'danger');
        }
    });
};
</script>




<script type="text/javascript">

//********************************************************************//
//
//Iniciar e Atualizar os Gráficos
//
//********************************************************************//
var charts = $(document).ready( function (){
    get_DshOpe();
    e900eoqCodProQtdOrp();
})

setInterval(function (){
    get_DshOpe();
    e900eoqCodProQtdOrp();
}, 2400);
</script>

@stop