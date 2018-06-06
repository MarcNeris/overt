@extends('layouts.overtsidebar')
@section('title', 'Leads e Contas | CRM')
@section('css')

@stop

@section('content')
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="card">
      <div class="card-header card-header-rose card-header-icon">
        <div class="card-icon">
          <i class="material-icons">equalizer</i>
        </div>
        <h4 class="card-title">Monitoramento de Ordens de Produção</h4>
      </div>
      <div class="card-body">
        <div class="toolbar">
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
              <table id="usuarios" class="table table-striped table-bordered  table-hover" cellspacing="1" width="100%">
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

<script>
  function ativar(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "{{url('reg/atv_users0001/')}}/"+id,
        type: 'GET',
        success: function(data) {
          var table = $('#usuarios').DataTable({
            retrieve: true,
          });
          table.ajax.reload( null, false );
        }
    });
  }

  $(document).ready(function (){

    $('#usuarios').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      toolbar: ".toolbar",
      aaSorting: [[0, "asc"]],
      ajax: "{{route('bam.get_e900cop')}}",
      columns: [
        {data: 'NumOrp', title: 'OP'},
        {data: 'CodPro', title: 'Código'},
        {data: 'DesPro', title: 'Produto'},
        {data: 'QtdPrv', title: 'Previsão'},
        {data: null, title: 'Data Inicial',
          className: "center",
          orderable: false,
          searchable: false,
          fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
            $(nTd).html(moment(oData.DtpIni).format('DD/MM/YYYY'));
            //'<a href="{{url("reg/usuarioPerfil/")}}/'+oData.id+'" class="badge badge-info">'+Data+'</a>');
          }
        },
        {data: null, title: 'Data Final',
          className: "center",
          orderable: false,
          searchable: false,
          fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
            $(nTd).html(moment(oData.DtpFim).format('DD/MM/YYYY'));
          }
        },

        {data: null, title: 'Ordem de Produção',
          className: "center",
          orderable: false,
          searchable: false,
          fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
            $(nTd).html('<a href="{{url("bam/operacoes/monitoramento")}}/'+oData.NumOrp+'" class="badge badge-info">Monitorar</a>');
          }
        },
      ],
    });
  });
</script>
@stop

