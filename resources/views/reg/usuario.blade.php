@extends('layouts.overtsidebar')

@section('content')

<div class="row">
  <div class="col-md-8 mr-auto ml-auto">
    <div class="wizard-container"><!--      Wizard container        -->
      <div class="card wizard-card card-wizard" data-color="rose" id="wizardProfile">
        <form name="frmEmpresa" method="POST" action="{{ $action or route('reg.new_users0001') }}">
          {!! csrf_field() !!}
          <div class="wizard-header">
          	<h3 class="wizard-title">
          	   Criar um novo Usuário
          	</h3>
          </div>

					<div class="wizard-navigation">
						<ul class="nav nav-pills">

              <li class="nav-item">
              	<a class="nav-link" href="#user" data-toggle="tab" role="tab">
              	Usuário</a>
              </li>

              <li class="nav-item">
              	<a class="nav-link" href="#papeis" data-toggle="tab" role="tab">
              	Perfil</a>
              </li>

            </ul>
    	    </div>

          <div class="tab-content">
         
            <div class="tab-pane" id="user">

              <div class="row">

                 <div class="col-md-4">
                  <div class="form-group bmd-form-group is-filled">
                    <label for="NomFta" class="bmd-label-floating">Empresa Logada</label>
                    <input type="text" class="form-control valid" id="NomFta" name="NomFta" required="" aria-required="true" aria-invalid="false" readonly="" value="{{Session::get('NomFta')}}">
                  </div>
                </div>
              </div>
              <div class="row">

                <div class="col-md-4">
                  <div class="form-group bmd-form-group is-filled">
                    <label for="EmlUsu" class="bmd-label-floating">Email do Usuário</label>
                    <input type="email" class="EmlUsu form-control EmlCta" id="EmlUsu" name="EmlUsu" aria-required="true" aria-invalid="false">
                  </div>
                </div>


                <div class="col-md-5">
                  <div class="form-group bmd-form-group is-filled">
                   <label for="NomUsu" class="bmd-label-floating">Nome do Usuário</label>
                   <input type="text" class="form-control valid" id="NomUsu" name="NomUsu" required=""  aria-required="true" aria-invalid="false">
                 </div>
                </div>
                
              </div>
                   
            </div>
            <div class="tab-pane" id="papeis">
                <div class="row">
                  
                                  
                  <div class="col-md-12">
                    <div class="form-group bmd-form-group is-filled">
                      <label for="DscRol" class="bmd-label-floating">Perfil do Usuário</label>
                      <input type="hidden" class="form-control valid" id="CodRol" name="CodRol">
                      <input type="text" class="form-control valid" id="DscRol" name="DscRol" required="" aria-required="true" aria-invalid="false">
                    </div>
                  </div>

                </div>
 
                <div class="row">
                  <div id="usersrole" class="col-md-12"></div>
                </div>

            </div>
          </div>
          <div class="modal-footer">
            <div class="pull-left">
                <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Voltar' />
            </div>
            <div class="pull-right">
                <input type='button' class='btn btn-next btn-fill btn-success btn-wd' name='next' value='Avançar' />
                <input type='submit' class='btn btn-finish btn-fill btn-success btn-wd' name='finish' value='Salvar' />
            </div>

          </div>
        </form>
      </div>
    </div> 
  </div>
</div>

@stop
@section('js')


<script type="text/javascript">

//********************************************************************//
//Busca Usuário
//********************************************************************//
  $('.EmlUsu').blur(function(){
    var EmlUsu = $(this).val();

    $.ajax({
      type: "GET",
      url: "{{url('reg/get_usuario')}}"+EmlUsu,
      dataType : 'json',
      beforeSend: function(){
        
      },
      success: function(data){

        var idRole = data.idRegRol;

        get_usersroles(idRole);

        $("#NomUsu").val(data.NomUsu);
        $("#DscRol").val(data.NomRol);
  
      },
      error: function(error){
      }
    });
  })

//********************************************************************//
//Busca Papéis do Usuario
//********************************************************************//

  $('#DscRol').autocomplete({
     
    minChars: 1,
    serviceUrl: "{{ URL('reg/usersrole') }}",

    onSelect: function (suggestion) {
      $("#CodRol").val(suggestion.data);
      get_usersroles(suggestion.data);
    },
    onInvalidateSelection: function() {

      $("#DscRol").focus();
      //showNotification( 'Por favor, selecione o Perfil do Usuário...', 'info');
    }
  });

</script>

<script type="text/javascript">
//********************************************************************//
//Busca Tarefas do Usuario
//********************************************************************//
var get_usersroles = function(idRole){
  
  var usersroles = '<li class="badge badge-primary">${NomTsk}</li>';

    $.ajax({
      type: "GET",
      url: "{{url('reg/get_usersrole')}}/"+idRole,
      dataType : 'json',
      success: function(usersrole){
        $( "#usersrole" ).empty();
          $.tmpl( usersroles, usersrole.roles ).appendTo('#usersrole');
      }
    })
}
  
</script>

@endsection