@extends('layouts.overtsidebar')
@section('css')
<script src="{{ asset('assets/crm/js/echarts.min.js') }}"></script>
<script src="https://www.gstatic.com/firebasejs/5.0.4/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.0.4/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.0.4/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.0.4/firebase-firestore.js"></script>
<script src="{{asset('assets/hcm/js/firebase.js')}}"></script>
@stop

@section('content')
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="card">
      <div class="card-header card-header-rose card-header-icon">
        <div class="card-icon">
          <i class="material-icons">equalizer</i>
        </div>
        <h4 class="card-title">Monitoramento de Registro de Ponto</h4>
      </div>
      <div class="card-body">
        <div class="toolbar">
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
              <table id="colaboradores" class="table table-striped table-bordered  table-hover" cellspacing="1" width="100%">
                <thead class="text-primary">
                  <tr>
                  </tr>
                </thead>
              </table>
            </div>
          </div>        
        </div>
      </div>
    </div>
  </div>
</div>
@stop

@section('js')
<script src="{{ asset('assets/crm/js/dataTables.js') }}"></script>

<script type="text/javascript">

var refEmployers = DB('employers','{{$RegFed}}');
refEmployers.on('value', function(contracts) {
  contracts = contracts.val();
  var colaboradores = [];
   x=0;
   $.each(contracts, function(cpf, ponto){
    ponto.DatAdm = moment(ponto.DatAdm).format("DD/MM/YYYY");
    ponto.DatNas = moment(ponto.DatNas).format("DD/MM/YYYY");
    
    colaboradores[x] = ponto;
    x++;
   })
      LoadCurrentReport(colaboradores);
})

function LoadCurrentReport(oResults) {
 
    var aDemoItems  = oResults;

    $("#colaboradores").empty();

    var table = $("#colaboradores").DataTable ({
        data : aDemoItems,
        "columns" : [
            { data : "NomFun", title: 'Nome'},
            { data : "NumCpf", title: 'CPF'},
            { data : "NumPis", title: 'PIS'},
            { data : "NumCra", title: 'Crachá'},
            { data : "DatAdm", title: 'Admissão'},
            { data : "DatNas", title: 'Nascimento'},
            { data : "NumCtp", title: 'CTPS'},
            { data : "NumCgc", title: 'Empresa'},
            { data :     null, title: 'Marcação',
              className: "center",
              orderable: false,
              searchable: false,
              fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
              if(oData.EmlUsu=='Sync'){
                var disabled='disabled';
                var btnLabel='Sem HCM REP';
              } else{
                disabled='';
                btnLabel='Marcação';
              }
              $(nTd).html('<a href="{{url("hcm/monitoramento")}}/'+oData.NumCpf+'"disabled><button class="btn btn-primary btn-sm" '+disabled+'>'+btnLabel+'</button></a>');
            }
          },
        ]
    });

    $('#colaboradores tbody').on('click', 'tr', function () {
      var tr = $(this).closest('tr');
      var row = table.row( tr );

      window.location.assign('monitoramento/'+row.data().NumCpf+'/'+row.data().NumCgc);
    })
}

</script>
@stop

