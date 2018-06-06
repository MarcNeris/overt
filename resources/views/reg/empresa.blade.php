@extends('layouts.overtsidebar')

@section('title', 'CRM | Plano de Vôo')

@section('css')
@stop

@section('content')

<div class="row">
  <div class="col-md-12 mr-auto ml-auto">
    <div class="wizard-container"><!--      Wizard container        -->
      <div class="card wizard-card card-wizard" data-color="green" id="wizardProfile">
        <form name="frmEmpresa" method="POST" action="{{ route('reg.new_regemp000') }}">
          {!! csrf_field() !!}
          <div class="wizard-header">
          	<h3 class="wizard-title">
          	   Criar uma nova Empresa
          	</h3>
          </div>

					<div class="wizard-navigation">
						<ul class="nav nav-pills">
              <li class="nav-item">
              	<a class="nav-link" href="#conta" data-toggle="tab" role="tab">
              	Empresa</a>
              </li>
             

              <li class="nav-item">
              	<a class="nav-link" href="#address" data-toggle="tab" role="tab">
              	Endereço</a>
              </li>
              <li class="nav-item">
              	<a class="nav-link" href="#contatos" data-toggle="tab" role="tab">
              	Contatos</a>
              </li>
            </ul>
    	    </div>

          <div class="tab-content">
            <div class="tab-pane" id="conta">
              <div class="row">
                <div class="col-md-2">
                  <div class="form-group bmd-form-group is-filled">
                    <label for="RegFed" class="bmd-label-floating">CNPJ/CPF Empresa</label>
                    <input type="text" class="cpf_cnpj form-control valid" id="RegFed" name="RegFed" required="" aria-required="true" aria-invalid="false">
                  </div>
                </div>

                <div class="col-md-1">
                  <div class="form-group bmd-form-group">
                    <div onclick="buscaCnpj()" type="null" class="btn btn-green btn-round btn-just-icon">
                      <i class="material-icons">search</i>
                      <div class="ripple-container"></div>
                    </div>
                  </div>
                </div>

                <div class="col-md-5">
                  <div class="form-group bmd-form-group is-filled">
                   <label for="NomPsa" class="bmd-label-floating">Nome Empresarial</label>
                   <input type="text" class="form-control valid" id="NomPsa" name="NomPsa" required=""  aria-required="true" aria-invalid="false">
                 </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group bmd-form-group is-filled">
                   <label for="NomFta" class="bmd-label-floating">Nome Fantasia</label>
                   <input type="text" class="form-control valid" id="NomFta" name="NomFta" required=""  aria-required="true" aria-invalid="false">
                 </div>
                </div>
                
              </div>
              <div class="row">

                <div class="col-md-2">
                  <div class="form-group bmd-form-group is-filled">
                    <label for="CodCne" class="bmd-label-floating">CNAE</label>
                    <input type="text" class="form-control valid" id="CodCne" name="CodCne" required="" aria-required="true" readonly="readonly" aria-invalid="false">
                  </div>
                </div>

                <div class="col-md-8">
                  <div class="form-group bmd-form-group is-filled">
                    <label for="DscCne" class="bmd-label-floating">Atividade principal</label>
                    <input type="text" class="form-control valid" id="DscCne" name="DscCne" required="" aria-required="true" aria-invalid="false" value="{{ old('DscCne') }}">
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group bmd-form-group is-filled">
                    <label for="DatReg" class="bmd-label-floating">Data de Registro</label>
                    <input type="text" class="form-control valid" id="DatReg" name="DatReg" required="" aria-required="true" aria-invalid="false">
                  </div>
                </div>
                                    
              </div>
              <div class="row">

                <div class="col-md-2">
                  <div class="form-group bmd-form-group is-filled">
                    <label for="CapEmp" class="bmd-label-floating">Capital Social</label>
                    <input type="text" class="form-control valid" id="CapEmp" name="CapEmp" required="" aria-required="true" aria-invalid="false">
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group bmd-form-group is-filled">
                    <label for="NatJur" class="bmd-label-floating">Natureza Juridica</label>
                    <input type="text" class="form-control valid" id="NatJur" name="NatJur" required="" aria-required="true" aria-invalid="false">
                  </div>
                </div>
              </div>        
            </div><!-- Fim do Painel Unidades -->

            <div class="tab-pane" id="address">

              <div class="row">

                <div class="col-md-2">
                  <div class="form-group bmd-form-group is-filled">
                    <label for="CepEnd" class="bmd-label-floating">CEP</label>
                    <input type="text" class="CepEnd form-control valid" id="CepEnd" name="CepEnd" required="" aria-required="true" aria-invalid="false">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group bmd-form-group is-filled">
                    <label for="NomEnd" class="bmd-label-floating">Endereço</label>
                    <input type="text" class="form-control valid" id="NomEnd" name="NomEnd" required="" aria-required="true" aria-invalid="false">
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group bmd-form-group is-filled">
                    <label for="NumEnd" class="bmd-label-floating">Número</label>
                    <input type="text" class="form-control valid" id="NumEnd" name="NumEnd" required="" aria-required="true" aria-invalid="false">
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group bmd-form-group is-filled">
                    <label for="NumTel" class="bmd-label-floating">Telefone</label>
                    <input type="text" class="NumTel form-control valid" id="NumTel" name="NumTel" required="" aria-required="true" aria-invalid="false">
                  </div>
                </div>

              </div>

              <div class="row">

                <div class="col-md-4">
                  <div class="form-group bmd-form-group is-filled">
                    <label for="CplEnd" class="bmd-label-floating">Complemento</label>
                    <input type="text" class="form-control valid" id="CplEnd" name="CplEnd"  aria-required="true" aria-invalid="false">
                  </div>
                </div>


                <div class="col-md-3">
                  <div class="form-group bmd-form-group is-filled">
                    <label for="BroEnd" class="bmd-label-floating">Bairro</label>
                    <input type="text" class="form-control valid" id="BroEnd" name="BroEnd" required="" aria-required="true" aria-invalid="false">
                  </div>
                </div>

            <!--   </div>

              <div class="row"> -->

                <div class="col-md-2">
                  <div class="form-group bmd-form-group is-filled">
                    <label for="CodMun" class="bmd-label-floating">Código IBGE</label>
                    <input type="text" class="form-control valid" id="CodMun" name="CodMun" required="" aria-required="true" readonly="readonly" aria-invalid="false">
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group bmd-form-group is-filled">
                    <label for="NomMun" class="bmd-label-floating">Município</label>
                    <input type="text" class="form-control valid" id="NomMun" name="NomMun" required="" aria-required="true" aria-invalid="false">
                  </div>
                </div>

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



function buscaCnpj() {

  estamosOnline();

  var RegFed = document.getElementById('RegFed').value;

  RegFed = RegFed.replace(/[^\d]+/g,'');

  $.ajax({
      type: "GET",
      url: "../services/getCnpj"+RegFed,
      dataType : 'json',
      success: function(data){

        $("#contato").html('');
        $("#NomPsa").val(data.nome);
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