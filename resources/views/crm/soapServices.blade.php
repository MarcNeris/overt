@extends('layouts.crmsidebar')

@section('css')

@stop

@section('content')

<div class="row">
  <div class="col-md-12 mr-auto ml-auto">
    <div class="wizard-container"><!--      Wizard container        -->
      <div class="card wizard-card card-wizard" data-color="rose" id="wizardProfile">
        <form name="frmEmpresa" method="POST" action="{{ route('services.soapService') }}">
          {!! csrf_field() !!}
          <div class="wizard-header">
          	<h3 class="wizard-title">
          	   Administração de WebService
          	</h3>
          </div>

					<div class="wizard-navigation">
						<ul class="nav nav-pills">

              <li class="nav-item">
              	<a class="nav-link" href="#conta" data-toggle="tab" role="tab">
              	{{ session()->get('NomFta') }} | WebService</a>
              </li>
             

              <li class="nav-item">
              	<a class="nav-link" href="#address" data-toggle="tab" role="tab">
              	Endereços Web</a>
              </li>

              <li class="nav-item">
              	<a class="nav-link" href="#contatos" data-toggle="tab" role="tab">
              	Parâmetros</a>
              </li>

            </ul>
    	    </div>

          <div class="tab-content">
         
            <div class="tab-pane" id="conta">

              <div class="row">

                <div class="col-md-4">
                  <div class="form-group bmd-form-group is-filled">
                   <label for="NomSrv" class="bmd-label-floating">Nome do Serviço</label>
                   <input type="text" class="form-control valid" id="NomSrv" name="NomSrv" required=""  aria-required="true" aria-invalid="false">
                 </div>
                </div>
                
              </div>

              <div class="row">

                <div class="col-md-8">
                  <div class="form-group bmd-form-group is-filled">
                    <label for="DscSrv" class="bmd-label-floating">Descrição do Serviço</label>
                    <input type="text" class="form-control valid" id="DscSrv" name="DscSrv" required="" aria-required="true" aria-invalid="false" value="{{ old('DscCne') }}">
                  </div>
                </div>
              </div>
              <div class="row">
                   
                <div class="col-md-12">
                  <div class="form-group bmd-form-group is-filled">
                    <label for="EndSrv" class="bmd-label-floating">Endereço WSDL</label>
                    <input type="text" class="form-control valid" id="EndSrv" name="EndSrv" required="" aria-required="true" aria-invalid="false">
                  </div>
                </div>
              
              </div>

            </div><!-- Fim do Painel Unidades -->

            <div class="tab-pane" id="address">

              <div class="row">

  

                

          

             

              </div>
            </div><!-- Fim do Painel Endereco -->
            <div class="tab-pane" id="contatos">
              
              <div class="row">
                
                <div class="col-md-1">
                  <div class="form-group bmd-form-group">
                    <div onclick="maiscontato()" type="null" class="btn btn-rose btn-round btn-just-icon">
                      <i class="material-icons">add</i>
                      <div class="ripple-container"></div>
                    </div>
                  </div>
                </div>
                
              </div>
            <div id="contato"></div>

            </div><!-- Fim do Painel Contatos -->
          </div><!-- Fim da Tab Contents -->
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
    </div> <!-- wizard container -->
  </div>
</div><!-- end row -->

@stop
@section('js')

<script type="text/javascript">

  $('#DscCne').autocomplete({
     
    minChars: 1,
    serviceUrl: "{{ URL('reg/regcne000') }}",

    onSelect: function (suggestion) {
      $("#CodCne").val(suggestion.data);
    },
    onInvalidateSelection: function() {
      document.getElementById("DscCne").focus();
      showNotification( 'Por favor, selecione a Atividade...', 'danger');
    }
  });


  $('#NomMun').autocomplete({
     
    minChars: 1,
    serviceUrl: "{{ URL('reg/regmun000') }}",

    onSelect: function (suggestion) {
      $("#CodMun").val(suggestion.data);
    },
    onInvalidateSelection: function() {
      document.getElementById("NomMunEmp").focus();
      showNotification( 'Por favor, selecione o Município...', 'danger');
    }
  });

</script>



<script type="text/javascript">

$('#CapEmp').change(function(){
    var v = $(this).val();
    v=v.replace(/\D/g,'');
    v=v.replace(/(\d{1,2})$/, ',$1');  
    v=v.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');  
    v = v != ''?'R$ '+v:'';
    $(this).val(v);
})


function mascara(src, mask){
    var i = src.value.length;
    var saida = mask.substring(0,1);
    var texto = mask.substring(i)
    if (texto.substring(0,1) != saida){
        src.value += texto.substring(0,1);
    }
}



function buscaCnpj() {

var RegFed = document.getElementById('RegFed').value;

RegFed = RegFed.replace(/[^\d]+/g,'');

$.ajax({
      type: "GET",
      url: "../services/getCnpj"+RegFed,
      dataType : 'json',
      success: function(data){

        $("#contato").html('');
        $("#NomEnt").val(data.nome);
        $("#NomFta").val(data.fantasia); 
        $("#DscCne").val(data.atividade_principal[0]['text']);
        $("#DatReg").val(data.abertura);
        $("#CapEmp").val(data.capital_social);
        $("#NatJur").val(data.natureza_juridica);
        $("#CepEnd").val(data.cep);
        $("#NomEnd").val(data.logradouro);
        $("#NumEnd").val(data.numero);
        $("#CplEnd").val(data.complemento);
        $("#BroEnd").val(data.bairro);
        $("#NomMun").val(data.municipio);
        $("#NumTel").val(data.telefone);

        var x = data.qsa;
        if(x.length === 0){
          x.unshift({nome: '', qual: ''});
        }

      
        $.each(data.qsa, function( index, value ) {
        

        var qsa='<div id="ID'+index+'" class="row">'+  
                  '<div class="col-md-3">'+
                    '<div class="form-group bmd-form-group is-filled">'+
                      '<label for="CNT'+index+'" class="bmd-label-floating">Contato #'+index+'</label>'+
                      '<input type="text" class="form-control valid" id="CNT'+index+'" name="CNT'+index+'" required="" value="'+value["nome"]+'" aria-required="true" aria-invalid="false">'+
                    '</div>'+
                  '</div>'+
                  
                  '<div class="col-md-2">'+
                    '<div class="form-group bmd-form-group is-filled">'+
                       '<label for="CRG'+index+'" class="bmd-label-floating">Cargo</label>'+
                       '<input type="text" class="form-control valid" id="CRG'+index+'" name="CRG'+index+'" required="" value="'+value["qual"]+'" aria-required="true" aria-invalid="false">'+
                    '</div>'+
                  '</div>'+

                  '<div class="col-md-2">'+
                    '<div class="form-group bmd-form-group is-filled">'+
                      '<label for="TEL'+index+'" class="bmd-label-floating">Telefone</label>'+
                      '<input type="text" class="form-control valid" id="TEL'+index+'" name="TEL'+index+'"  value="" aria-required="true" aria-invalid="false">'+
                    '</div>'+
                  '</div>'+

                  '<div class="col-md-3">'+
                    '<div class="form-group bmd-form-group is-filled">'+
                      '<label for="EML'+index+'" class="bmd-label-floating">Email</label>'+
                      '<input type="email" class="form-control valid" id="EML'+index+'" name="EML'+index+'"  value="" aria-required="true" aria-invalid="false">'+
                    '</div>'+
                  '</div>'+
                '</div>';
        
        $("#contato").append(qsa);
      });
    }
  });
};


function maiscontato() {

 var last = document.querySelector("#contato .row:last-child");
 last = apenasNumeros(last.id);



 var first = document.querySelector("#contato .row:first-child");
 first = apenasNumeros(first.id);

 console.log(last);
 console.log(first);


 if (last>first){
    var index = last;
 } else {
    var index = first;
 }

 index++;

  var qsa='<div id="ID'+index+'" class="row">'+  
                  '<div class="col-md-3">'+
                    '<div class="form-group bmd-form-group is-filled">'+
                      '<label for="CNT'+index+'" class="bmd-label-floating">Contato #'+index+'</label>'+
                      '<input type="text" class="form-control valid" id="CNT'+index+'" name="CNT'+index+'" required="" aria-required="true" aria-invalid="false">'+
                    '</div>'+
                  '</div>'+
                  
                  '<div class="col-md-2">'+
                    '<div class="form-group bmd-form-group is-filled">'+
                       '<label for="CRG'+index+'" class="bmd-label-floating">Cargo</label>'+
                       '<input type="text" class="form-control valid" id="CRG'+index+'" name="CRG'+index+'" required="" aria-required="true" aria-invalid="false">'+
                    '</div>'+
                  '</div>'+

                  '<div class="col-md-2">'+
                    '<div class="form-group bmd-form-group is-filled">'+
                      '<label for="TEL'+index+'" class="bmd-label-floating">Telefone</label>'+
                      '<input type="text" class="form-control valid" id="TEL'+index+'" name="TEL'+index+'"  value="" aria-required="true" aria-invalid="false">'+
                    '</div>'+
                  '</div>'+

                  '<div class="col-md-3">'+
                    '<div class="form-group bmd-form-group is-filled">'+
                      '<label for="EML'+index+'" class="bmd-label-floating">Email</label>'+
                      '<input type="email" class="form-control valid" id="EML'+index+'" name="EML'+index+'"  value="" aria-required="true" aria-invalid="false">'+
                    '</div>'+
                  '</div>'+
                  '<div class="col-md-2">'+
                    '<div class="form-group bmd-form-group is-filled">'+
                      '<a href="#" onclick="remover(ID'+index+')" class="badge badge-danger">Remover</a>'+
                    '</div>'+
                  '</div>'+

                '</div>';

  $("#contato").prepend(qsa);
};


function remover(id) {
  $('#'+id.id).remove();
}

</script>

@endsection