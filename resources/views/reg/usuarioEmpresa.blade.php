@extends('layouts.overtsidebar')
@section('title', 'Leads e Contas | CRM')
@section('css')

@stop

@section('content')
<div class="row">
  <div class="col-lg-8 col-md-12">
    <div class="card">
      <div class="card-header card-header-text card-header-info">
        <div class="card-text">
          <h4 class="card-title">Acesso à Empresas</h4>
          <p class="card-category">Relação de Empresas</p>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12 pull-left">
            <div class="col-md-12">
              <div class="table-responsive">
                <table id="empresas" class="table table-striped table-bordered  table-hover" cellspacing="1" width="100%">
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
        url: "{{url('reg/ajx_regemp000/')}}/"+id+"/ativar",
        type: 'GET',
        success: function(data) {

            var table = $('#empresas').DataTable({
              retrieve: true,
            });
            table.ajax.reload( null, false );
            $('#UsuEmp').html(data);
            showNotification( data+' ativa!', 'success');

        }
    });
  }

  $(document).ready(function (){

    $('#empresas').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      toolbar: ".toolbar",
      aaSorting: [[0, "asc"]],
      ajax: "{{ route('reg.get_usuarioEmpresa')}}",
      columns: [
        //{data: 'id', title: 'ID'},
        {data: 'NomFta', title: 'Empresa'},
        {data: 'RegFed', title: 'Registro Federal'},
        {data: 'NomRol', title: 'Seu Perfil'},
        {data: 'NomUsu', title: 'Administrador'},
        //{data: 'EmlUsu', title: 'Email'},
        //{data: 'SitEmp', title: 'Status'},
        {data: null, title: 'Ações',
          className: "center",
          orderable: false,
          searchable: false,
          fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
            $(nTd).html("<div id='actions'>\n\
              <a onclick='ativar(" + oData.id + ")' href='#'><btn class='fa fa-check fa-fw'></btn></a>\n\
              <a onclick='inativar(" + oData.id + ")' href='#'><i class='fa fa-times fa-fw'></i></a>\n\
              <a href='{{url('nfi/t001ent/')}}/" + oData.RegFed + "/ativar'><i class='fa fa-wrench fa-fw'></i></a></div>")
          }
        }
      ],
    });
  });

</script>
@endsection