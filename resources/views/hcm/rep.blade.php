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
        <h4 class="card-title">Monitoramento de Registro de Ponto</h4>
      </div>
      <div class="card-body">
        <div class="toolbar">
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
              <table id="operacoes" class="table table-striped table-bordered  table-hover" cellspacing="1" width="100%">
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

    $('#operacoes').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      toolbar: ".toolbar",
      aaSorting: [[0, "asc"]],
      ajax: "{{route('hcm.get_hcmcol000')}}",
      columns: [
        {data: 'NomFun', title: 'Colaborador'},
        {data: 'NumCpf', title: 'CPF'},
        {data: 'NumCgc', title: 'CNPJ'},
        {data: 'NumCad', title: 'Matícula'},
        {data: 'NumCra', title: 'Crachá'},
        {data: 'EmlUsu', title: 'email'},
        {data: 'NumCtp', title: 'CTPS'},
        {data: null, title: 'Nascimento',
          className: "center",
          orderable: false,
          searchable: false,
          fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
            $(nTd).html(moment(oData.DatNas).format('DD/MM/YYYY'));
            //'<a href="{{url("reg/usuarioPerfil/")}}/'+oData.id+'" class="badge badge-info">'+Data+'</a>');
          }
        },
        {data: null, title: 'Admissão',
          className: "center",
          orderable: false,
          searchable: false,
          fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
            $(nTd).html(moment(oData.DatAdm).format('DD/MM/YYYY'));
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

