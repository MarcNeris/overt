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
          <h4 class="card-title">{{$User->name}} | {{$usersrole->NomRol}}</h4>
          <p class="card-category">Gestão de Usuários</p>
        </div>
      </div>
      <div class="card-body">
         <div class="row">                
          <div class="col-md-8">
            <div class="form-group bmd-form-group is-filled">
              <label for="DscRol" class="bmd-label-floating">Perfil do Usuário</label>
              <input type="hidden" class="form-control valid" id="CodRol" name="CodRol">
              <input type="text" value="{{$usersrole->DscRol}}" class="form-control valid" id="DscRol" name="DscRol" required="" aria-required="true" aria-invalid="false">
            </div>
          </div>
        </div>
        <div class="row">
          <div id="usersrole" class="col-md-8"></div>
        </div>
    </div>
  </div>
</div>
@stop

@section('js')

<script src="{{ asset('assets/crm/js/dataTables.js') }}"></script>
<script type="text/javascript">

var get_usersroles = function(idRole){
  var usersroles = '<span class="badge badge-primary">${NomTsk}</span>';

  $.template( "movieTemplate", usersroles);

  
    $.ajax({
      type: "GET",
      url: "{{url('reg/get_usersrole')}}/"+idRole,
      dataType : 'json',
      success: function(usersrole){
        
        $( "#usersrole" ).empty();
          $.tmpl( "movieTemplate", usersrole ).appendTo( "#usersrole" );
        $.each( usersrole, function(k, NomTsk){

          $.tmpl( "movieTemplate", NomTsk ).appendTo( "#usersrole" );

        });
      }
    })
}

  $(document).ready(function (){
    get_usersroles('{{$usersrole->id}}');
  });

</script>



<script type="text/javascript">
  $('#DscRol').autocomplete({
     
    minChars: 1,
    serviceUrl: "{{ URL('reg/usersrole') }}",

    onSelect: function (suggestion) {
      $("#CodRol").val(suggestion.data);
      get_usersroles(suggestion.data);

      upd_users0001(suggestion.data);
    },
    onInvalidateSelection: function() {
      $("#DscRol").focus();
      showNotification( 'Por favor, selecione o Perfil do Usuário...', 'info');
    }
  });



</script>



<script>



  function upd_users0001(idRegRol) {
    id = '{{$idUsers0001}}';
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $.ajax({
        url: "{{url('reg/upd_users0001/')}}/"+id+"/"+idRegRol,
        type: 'GET',
        success: function(data) {
          showNotification( 'Perfil Atualizado!', 'info');
        }
    });
  }

</script>
@endsection