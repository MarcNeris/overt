@extends('layouts.overtsidebar')
@section('title', 'Leads e Contas | CRM')
@section('css')

@stop

@section('content')
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="card">
      <div class="card-header card-header-info card-header-icon">
        <div class="card-icon">
          <i class="material-icons">supervisor_account</i>
        </div>
        <h4 class="card-title">Administração de Usuários</h4>
      </div>
      <div class="card-body">
        <div class="toolbar">
          <a href="{{ route('reg.usuario') }}" class="btn btn-rose btn-sm" role="button">Novo Usuário</a>
          <a href="{{ route('reg.usuario') }}" class="btn btn-rose btn-sm" role="button">Perfil de Usuários</a>
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
      ajax: "{{ route('reg.get_users0001')}}",
       columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        } ],

      columns: [

        {data: 'NomFta', title: 'Empresa'},
        {data: 'RegFed', title: 'Registro Federal'},
        {data: 'NomUsu', title: 'Nome'},
        {data: 'EmlUsu', title: 'Email'},
        //{data: 'NomRol', title: 'Perfil'},
        {data: null, title: 'Status',
          className: "center",
          orderable: false,
          searchable: false,
          fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
            if (oData.SitUsu==1){
              $(nTd).html('<div class="togglebutton"><label><input onclick="ativar('+oData.id+')"type="checkbox" checked=""></label></div>');
            } else {
              $(nTd).html('<div class="togglebutton"><label><input onclick="ativar('+oData.id+')"type="checkbox"></label></div>');
            }
          }
        },

        {data: null, title: 'Perfil',
          className: "center",
          orderable: false,
          searchable: false,
          fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
            $(nTd).html('<a href="{{url("reg/usuarioPerfil/")}}/'+oData.id+'" class="badge badge-info">'+oData.NomRol+'</a>');
          }
        },
      ],
    });
  });

</script>
@stop