@extends('layouts.overtsidebar')
@section('css')

@stop
@section('content')

<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">content_copy</i>
                </div>
                <p class="card-category">ERP | Gestão Empresarial</p>
                <h3 class="card-title">
                    <small>Gestão de Empresas e Filiais</small>
                </h3>
            </div>
            <div class="card-footer">
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

@endsection
@section('js')

<script src="{{ asset('assets/crm/js/dataTables.js') }}"></script>

<script>
  function ativar(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var url = "{{url('senior/ativar_erpemp000')}}/"+id;

    $.ajax({
      url: url
      ,type: 'GET'
      ,success: function(data) {

            var table = $('#empresas').DataTable({
              retrieve: true,
            });
            table.ajax.reload( null, false );
        }
    });
  }

  $(document).ready(function (){

    $('#empresas').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      toolbar: ".toolbar",
      aaSorting: [[0, "asc"], [1, "asc"], [2, "asc"]],
      ajax: "{{ route('senior.e070emp')}}",
      columns: [
        {data: 'CodEmp', title: 'Código da Empresa'},
        {data: 'SigEmp', title: 'Empresa'},
        {data: 'CodFil', title: 'Código da Filial'},
        {data: 'SigFil', title: 'Filial'},
        {data: 'RegFed', title: 'CNPJ'},
        {data: 'NomSis', title: 'Sistema'},
        {data: null, title: 'Status',
          className: "center",
          orderable: false,
          searchable: false,
          fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
            if (oData.SitEmp==1){
              $(nTd).html('<div class="togglebutton"><label><input onclick="ativar('+oData.id+')"type="checkbox" checked=""></label></div>');
            } else {
              $(nTd).html('<div class="togglebutton"><label><input onclick="ativar('+oData.id+')"type="checkbox"></label></div>');
            }
          }
        }
      ],
    });
  });
</script>

@stop