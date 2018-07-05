
@extends('layouts.overtsidebar')

@section('title', 'Leads e Contas | CRM')
@section('css')

@stop

@section('content')
<div class="row">
  <div class="col-lg-8 col-md-12">
    <div class="card">
      <div class="card-header card-header-text card-header-rose">
        <div class="card-text">
          <h4 class="card-title">Gestão de Empresas</h4>
          <p class="card-category">Administração das Empresas</p>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12 pull-left">
            <a href="{{route('reg.empresa')}}" class="btn btn-rose btn-sm" role="button">Nova Empresa</a>
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
 
  $(document).ready(function (){

    $('#empresas').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      toolbar: ".toolbar",
      aaSorting: [[0, "asc"]],
      ajax: "{{ route('reg.get_regemp000')}}",
      columns: [
        {data: 'NomPsa', title: 'Razão Social'},
        {data: 'RegFed', title: 'Registro Federal'},
        {data: 'NomPrp', title: 'Administrador'},
        {data: null, title: 'Status',
          className: "center",
          orderable: false,
          searchable: false,
          fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
            if (oData.SitEmp==1){
              $(nTd).html('<div class="togglebutton"><label><input onclick="ativarEmpresa('+oData.idRegEmp+')"type="checkbox" checked=""></label></div>');
            } else {
              $(nTd).html('<div class="togglebutton"><label><input onclick="ativarEmpresa('+oData.idRegEmp+')"type="checkbox"></label></div>');
            }
          }
        },
        {data: null, title: 'Configurações',
          className: "center",
          orderable: false,
          searchable: false,
          fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {

            $(nTd).html('<a href="{{url("reg/empresa-configuracoes")}}/'+oData.idRegEmp+'" class="badge badge-info">Configurações</a>');
          }
        }
      ],
    });
  });

function ativarEmpresa(id) {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url: "{{url('reg/atv_regemp000/')}}/"+id,
    type: 'GET',
    success: function(data) {
        var table = $('#empresas').DataTable({
          retrieve: true,
        });
        table.ajax.reload( null, false );
      $('#UsuEmp').html(data);
      console.log(data);
      showNotification( data+' ativa!', 'success');
    }
  });
}

function configuracoesEmpresa(id){
  alert(id);
}



</script>
@endsection