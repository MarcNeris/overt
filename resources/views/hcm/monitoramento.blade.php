@extends('layouts.overtsidebar')

@section('css')

<script src="{{ asset('assets/crm/js/echarts.min.js') }}"></script>
<script src="https://www.gstatic.com/firebasejs/5.0.4/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.0.4/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.0.4/firebase-database.js"></script>
<script src="{{asset('assets/hcm/js/firebase.js')}}"></script>
<style type="text/css">
     #tablePonto{
           min-height: 400px;
        }
</style>
@stop

@section('content')
<div class="row"> 
    <div class="col-md-12">
        <div class="card card-nav-tabs">
          <h4 class="card-header card-header-rose">Administração de Ponto
          </h4>
          <div class="card-body">
            <div class="content table-responsive table-full-width">
                <div class="content" id="tablePonto">
                     <div class="col-md-2">
                        <div class="form-group bmd-form-group is-filled">
                        <label class="bmd-label-floating"></label>
                        <input id="dataMarcacao" type="text" id="DatIni" name="dataMarcacao" class="form-control datepicker" placeholder="Data da Marcação">
                      </div>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <th>Orientação</th>
                            <th>Hora do Sistema</th>
                            <th>Data</th>
                            <th>Hora</th>
                            <th>Matrícula</th>
                            <th>Crachá</th>
                            <th>CPF</th>
                            <th>PIS</th>
                        </thead>
                        <tbody id="ponto">
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">

var dataMarcacao =  document.getElementById('dataMarcacao');

dataMarcacao.value = moment(new Date()).format('DD/MM/YYYY');

dataMarcacao.addEventListener('blur', function(){
    
    getMarcacao();
});

getMarcacao = function(){
        var refEmployee = DB('employees', window.location.href.split("/")[window.location.href.split("/").length -2]+'/'+window.location.href.split("/")[window.location.href.split("/").length -1]+'/');

    refEmployee.on('value', function(colaborador){

        colaborador = colaborador.val();
        
        var YYYYMMDD =  document.getElementById('dataMarcacao');

        YYYYMMDD = moment(YYYYMMDD.value).format('YYYY-DD-MM');

        refRepStatus = DB('users',colaborador.UsuUid+'/'+colaborador.NumCgc+'/'+YYYYMMDD);

        refRepStatus.on('value', function(REP){

            REP = REP.val();

             $("#ponto").empty();

            var REPStatus = '<tr><td> <span class="badge badge-${color}">${ES}</span> </td><td>${FBtimestamp}</td><td>${dataST}</td><td>${horaST}</td><td>${NumCad}</td><td>${NumCra}</td><td>${CPF}</td><td>${PIS}</td></tr>';

            $.each( REP, function(dia, ponto){


            switch(ponto.ES){
            
            case '0':
                ponto.color='default';
                ponto.ES='Marcação';
                break;
            case  'E':
                ponto.color='success';
                ponto.ES='Entrada';
                break;
            case  'P':
                ponto.color='info';
                ponto.ES='Parada';
                break;
            case  'R':
                ponto.color='warning';
                ponto.ES='Retorno';
                break;
            case  'S':
                ponto.color='success';
                ponto.ES='Saída';
                break;
            case  'X':
                ponto.color='danger';
                ponto.ES='Excluído';
                break;
            default:
                ponto.color='default';
        }
                
                ponto.FBtimestamp = moment(ponto.timestampFB).format("HH:mm:ss");
               
                $.tmpl( REPStatus, ponto ).appendTo( "#ponto" );
                               
            })
        })
    })
}

getMarcacao();

</script>
@stop