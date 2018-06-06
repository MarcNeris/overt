@extends('layouts.overtsidebar')

@section('content')

<div class="row">
  <div class="col-md-12 mr-auto ml-auto">
    <div class="wizard-container"><!--      Wizard container        -->
      <div class="card wizard-card card-wizard" data-color="rose" id="wizardProfile">
        <form name="frmEmpresa" method="POST" action="{{ route('crm.new_crmcta000') }}">
          {!! csrf_field() !!}
          <div class="wizard-header">
          	<h3 class="wizard-title">
          	   Criar uma nova conta
          	</h3>
          </div>

					<div class="wizard-navigation">
						<ul class="nav nav-pills">
              <li class="nav-item">
              	<a class="nav-link" href="#conta" data-toggle="tab" role="tab">
              	Conta</a>
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
                    <label for="RegFed" class="bmd-label-floating">CNPJ/CPF Conta</label>
                    <input type="text" class="cpf_cnpj form-control valid" id="RegFed" name="RegFed" required="" aria-required="true" aria-invalid="false">
                  </div>
                </div>

                <div class="col-md-1">
                  <div class="form-group bmd-form-group">
                    <div onclick="buscaCnpj()" type="null" class="btn btn-rose btn-round btn-just-icon">
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
                    <input type="text" class="form-control CodCne" id="CodCne" name="CodCne" required="" aria-required="true" readonly="readonly" aria-invalid="false">
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
                    <input type="text" class="form-control DatReg" id="DatReg" name="DatReg" required="" aria-required="true" aria-invalid="false">
                  </div>
                </div>
                                    
              </div>
              <div class="row">

                <div class="col-md-2">
                  <div class="form-group bmd-form-group is-filled">
                    <label for="CapEmp" class="bmd-label-floating">Capital Social</label>
                    <input type="text" class="form-control CapEmp" id="CapEmp" name="CapEmp" required="" aria-required="true" aria-invalid="false">
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
                    <input type="text" class="form-control CepEnd" id="CepEnd" name="CepEnd" required="" aria-required="true" aria-invalid="false" autofocus>
                  </div>
                </div>

                <div class="col-md-8">
                  <div class="form-group bmd-form-group is-filled">
                    <label for="NomEnd" class="bmd-label-floating">Endereço</label>
                    <input type="text" class="form-control valid" id="NomEnd" name="NomEnd" required="" aria-required="true" aria-invalid="false">
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group bmd-form-group is-filled">
                    <label for="NumEnd" class="bmd-label-floating">Número</label>
                    <input type="text" class="form-control NumEnd" id="NumEnd" name="NumEnd" required="" aria-required="true" aria-invalid="false">
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

    
                <div class="col-md-2">
                  <div class="form-group bmd-form-group is-filled">
                    <label for="CodMun" class="bmd-label-floating">Código IBGE</label>
                    <input type="text" class="form-control CodMun" id="CodMun" readonly="" name="CodMun" required="" aria-required="true" aria-invalid="false">
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group bmd-form-group is-filled">
                    <label for="NomMun" class="bmd-label-floating">Município</label>
                    <input type="text" class="form-control NomMun" id="NomMun" name="NomMun" required="" aria-required="true" aria-invalid="false">
                  </div>
                </div>
              </div>

              <div class="row">
                

                 <div class="col-md-4">
                  <div class="form-group bmd-form-group is-filled">
                    <label for="EmlCta" class="bmd-label-floating">Email</label>
                    <input type="email" class="form-control EmlCta" id="EmlCta" name="EmlCta" aria-required="true" aria-invalid="false">
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group bmd-form-group is-filled">
                    <label for="NumTel" class="bmd-label-floating">Telefone Empresarial</label>
                    <input type="text" class="form-control NumTel" id="NumTel" name="NumTel" required="" aria-required="true" aria-invalid="false">
                  </div>
                </div>

              </div>
            </div><!-- Fim do Painel Endereco -->
            <div class="tab-pane" id="contatos">
              
              <div class="row">
                
                <div class="col-md-1">
                  <div class="form-group bmd-form-group">
                    <div onclick="maisContato()" type="null" class="btn btn-rose btn-round btn-just-icon">
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

  $(document).change(function(){
    var SPMaskBehavior = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
    spOptions = {
      onKeyPress: function(val, e, field, options) {
          field.mask(SPMaskBehavior.apply({}, arguments), options);
        }
    };
    $('.NumTel').mask(SPMaskBehavior, spOptions);
    $('.NumEnd').mask('000.000.000',{reverse: true});
    $('.CepEnd').mask('00.000-000',{reverse: true});
    $('.DatReg').mask('00/00/0000', {selectOnFocus: true});
    $('.CodMun').mask('99999999', {selectOnFocus: true});
  });

  $('.CepEnd').blur(function(){
    var CepEnd = $(this).val();
    CepEnd = CepEnd.replace(/[^\d]+/g,'');
    $.ajax({
      type: "GET",
      url: "../services/getCep"+CepEnd, //CepEnd,
      dataType : 'json',
      beforeSend: function(){
        showNotification( 'Localizando o Endereço...', 'info');
      },
      success: function(data){
        console.log(data);

        if("erro" in data){
          return showNotification( 'CEP Inválido :(', 'danger');
        };
        $("#CepEnd").val(data.cep);
        $("#NomEnd").val(data.logradouro).prop('readonly', true);
        $("#BroEnd").val(data.bairro).prop('readonly', true);
        $("#NomMun").val(data.localidade+' - '+data.uf).prop('readonly', true);
        $("#CodMun").val(data.ibge);
        showNotification( 'Endereço Localizado pelo CEP!', 'success');
      },
      error: function(error){
        showNotification( 'Endereço não Localizado :(<br>"'+error.status+':'+error.statusText+'"', 'danger');
      }
    });
  })


  $('#DscCne').autocomplete({
     
    minChars: 1,
    serviceUrl: "{{ URL('reg/regcne000') }}",

    onSelect: function (suggestion) {
      $("#CodCne").val(suggestion.data);
    },
    onInvalidateSelection: function() {
      document.getElementById("DscCne").focus();
      showNotification( 'Por favor, selecione a Atividade...', 'info');
    }
  });


  $('.NomMun').autocomplete({
     
    minChars: 1,
    serviceUrl: "{{ URL('reg/regmun000') }}",

    onSelect: function (suggestion) {
      $("#CodMun").val(suggestion.data);
      $("#NomMun").val(suggestion.value);
    },
    onInvalidateSelection: function() {
       $("#NomEnd").focus();
      //document.getElementById("CodMun").focus();
      showNotification( 'Por favor, selecione o Município...', 'info');
    }
  });

</script>



<script type="text/javascript">

$('.CapEmp').change(function(){
    var v = $(this).val();
    v=v.replace(/\D/g,'');
    v=v.replace(/(\d{1,2})$/, ',$1');  
    v=v.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');  
    v = v != ''?'R$ '+v:'';
    $(this).val(v);
})


function buscaCnpj() {

var RegFed = document.getElementById('RegFed').value;

RegFed = RegFed.replace(/[^\d]+/g,'');

$.ajax({
      type: "GET",
      url: "{{url('services/getCnpj')}}"+RegFed,
      dataType : 'json',
      cache:false,

      beforeSend: function(){
        showNotification( 'Localizando o CNPJ...', 'info');
      },

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
        $("#NomMun").val(data.municipio);//+' - '+data.uf);
        $("#NumTel").val(data.telefone);
        $("#EmlCta").val(data.email);
        var x = data.qsa;
        if(x.length === 0){
          x.unshift({nome: '', qual: ''});
        }

      
        $.each(data.qsa, function( index, value ) {
        

        var qsa='<div id="ID'+index+'" class="row">'+  
                  '<div class="col-md-3">'+
                    '<div class="form-group bmd-form-group is-filled">'+
                      '<label for="CNT'+index+'" class="bmd-label-floating">Contato #'+index+'</label>'+
                      '<input type="text" class="form-control valid" id="CNT'+index+'" name="CNT'+index+'" required="" value="'+value["nome"]+'" readonly="true" aria-required="true" aria-invalid="false">'+
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
                      '<input type="text" class="form-control NumTel" id="TEL'+index+'" name="TEL'+index+'"  value="" aria-required="true" aria-invalid="false">'+
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
        showNotification( 'CNPJ Localizando :)', 'success');
    },
    error: function (error) {
      showNotification( 'CNPJ não Localizado :(<br>"'+error.status+':'+error.statusText+'"', 'danger');
    }
  });
};


function maisContato() {

  var last = document.querySelector("#contato .row:last-child");
  last = apenasNumeros(last.id);

  var first = document.querySelector("#contato .row:first-child");
  first = apenasNumeros(first.id);

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
              '<input type="text" class="form-control NumTel" id="TEL'+index+'" name="TEL'+index+'"  value="" aria-required="true" aria-invalid="false">'+
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