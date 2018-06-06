@extends('layouts.overtsidebar')
@section('content')
@section('title', 'CRM | Plano de Vôo')

@section('css')
@stop

@section('content')

<div class="row">
  <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary card-header-icon">
          <div class="card-icon">
            <i class="material-icons">assignment</i>
          </div>
          <h4 class="card-title">Contatos</h4>
        </div>
          <div class="card-body">
              <div class="toolbar">
                  sss<!--        Here you can write extra buttons/actions for the toolbar              -->
              </div>
                  <div class="table-responsive">
                    <table id="contatos" class="table table-striped table-bordered  table-hover" cellspacing="1" width="100%">
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
 
@stop
@section('js')

<script src="{{ asset('assets/crm/js/dataTables.js') }}"></script>
<script>
  $(document).ready(function (){
    $('#contatos').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      toolbar: ".toolbar",
      aaSorting: [[0, "asc"]],
      ajax: "{{ route('reg.get_regcto000')}}",
      columns: [
          {data: 'NomCto', title: 'Contato'},
          {data: 'NomCrg', title: 'Cargo'},
          {data: 'TelCto', title: 'Telefone'},
          {data: 'EmlCto', title: 'Email'},
          {data: 'NomPsa', title: 'Organização'},
      ]
    });
  });
</script>

@endsection