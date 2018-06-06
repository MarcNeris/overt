//********************************************************************//
//
//VERIFICA SE ESTAMOS ON LINE
//
//********************************************************************//
function estamosOnline(){
  if(navigator.onLine===false){
  return showNotification( 'Por favor, verifique a conexão com a internet...', 'danger');
  }
}
//********************************************************************//
//
// FORMATA O TOOLTIP DO ECHARTS POR EIXO PARA R%
//
//********************************************************************//
function formatarTooltip(a){
    
    var n='';
    
    $.each( a, function(k, d){
        v = numeral(d.value).format('$0,0.00');
        n += d.marker+''+d.name+'<b> '+d.seriesName+'</b><br>'+v+'<br>';
    });

    return n;
}
function formatarTooltipNumero(a){
    
    var n='';
    
    $.each( a, function(k, d){
        v = numeral(d.value).format('0.00a');
        n += d.marker+''+d.name+'<b> '+d.seriesName+'</b><br>'+v+'<br>';
    });

    return n;
}
//********************************************************************//
//
//VALIDA E FORMATA O CNPJ
//
//********************************************************************//
$(function(){
    $('.cpf_cnpj').blur(function(){
        var cpf_cnpj = $(this).val();
        if ( valida_cpf_cnpj( cpf_cnpj ) ) {

        } else {

          document.getElementById("RegFed").focus();
          
        }
    });

    $('.cpf_cnpj').blur(function(){
        var cpf_cnpj = $(this).val();
        if ( formata_cpf_cnpj( cpf_cnpj ) ) {
            $(this).val( formata_cpf_cnpj( cpf_cnpj ) );

        } else {
            if (cpf_cnpj==''){
                showNotification( 'Informe o CNPJ/CPF...', 'danger');
            } else {
                
                showNotification( 'CNPJ/CPF inválido...', 'danger');
            }
        }
    });
    
});

$(function(){
  
});


function verifica_cpf_cnpj ( valor ) {

    valor = valor.toString();
    valor = valor.replace(/[^0-9]/g, '');
    if ( valor.length === 11 ) {
        return 'CPF';
    } 
    else if ( valor.length === 14 ) {
        return 'CNPJ';
    }
    else {
        return false;
    }    
}

function calc_digitos_posicoes( digitos, posicoes = 10, soma_digitos = 0 ) {

    digitos = digitos.toString();
    for ( var i = 0; i < digitos.length; i++  ) {
        soma_digitos = soma_digitos + ( digitos[i] * posicoes );
        posicoes--;
        if ( posicoes < 2 ) {
            posicoes = 9;
        }
    }

    soma_digitos = soma_digitos % 11;

    if ( soma_digitos < 2 ) {
        soma_digitos = 0;
    } else {
        soma_digitos = 11 - soma_digitos;
    }
    var cpf = digitos + soma_digitos;
    return cpf;
}

function valida_cpf( valor ) {
    valor = valor.toString();
    valor = valor.replace(/[^0-9]/g, '');
    var digitos = valor.substr(0, 9);
    var novo_cpf = calc_digitos_posicoes( digitos );
    var novo_cpf = calc_digitos_posicoes( novo_cpf, 11 );
    if ( novo_cpf === valor ) {
        return true;
    } else {
        return false;
    } 
}

function valida_cnpj ( valor ) {
  valor = valor.toString();
  valor = valor.replace(/[^0-9]/g, '');
  var cnpj_original = valor;
  var primeiros_numeros_cnpj = valor.substr( 0, 12 );
  var primeiro_calculo = calc_digitos_posicoes( primeiros_numeros_cnpj, 5 );
  var segundo_calculo = calc_digitos_posicoes( primeiro_calculo, 6 );
  var cnpj = segundo_calculo;
  if ( cnpj === cnpj_original ) {
      return true;
  }
  return false;
}

function valida_cpf_cnpj ( valor ) {

    var valida = verifica_cpf_cnpj( valor );
    valor = valor.toString();
    valor = valor.replace(/[^0-9]/g, '');
    if ( valida === 'CPF' ) {
        return valida_cpf( valor );
    } 
    else if ( valida === 'CNPJ' ) {
        return valida_cnpj( valor );
    } 
    else {
        return false;
    } 
}

function formata_cpf_cnpj( valor ) {
    var formatado = false;
    var valida = verifica_cpf_cnpj( valor );
    valor = valor.toString();
    valor = valor.replace(/[^0-9]/g, '');
    if ( valida === 'CPF' ) {
        if ( valida_cpf( valor ) ) {
            formatado  = valor.substr( 0, 3 ) + '.';
            formatado += valor.substr( 3, 3 ) + '.';
            formatado += valor.substr( 6, 3 ) + '-';
            formatado += valor.substr( 9, 2 ) + '';
            
        }
        
    }
    
    else if ( valida === 'CNPJ' ) {
        if ( valida_cnpj( valor ) ) {
            formatado  = valor.substr( 0,  2 ) + '.';
            formatado += valor.substr( 2,  3 ) + '.';
            formatado += valor.substr( 5,  3 ) + '/';
            formatado += valor.substr( 8,  4 ) + '-';
            formatado += valor.substr( 12, 14 ) + '';
            
        }
        
    } 
    return formatado;
}
//********************************************************************//
//
//MOSTRA NOTIFICACOES
//
//********************************************************************//
function showNotification( message, type){

    $.notify({
      icon: "add_alert",
      message: message

    },{
      type: type,
      timer: 1000,
      placement: {
          from: 'top',
          align: 'left'
      }
    });
}
//********************************************************************//
//
//ATIVA O SIDEBAR CONFORME A ROTA
//
//********************************************************************//
$(function() {
    var url = window.location;
    var element = $('ul.nav a').filter(function() {
        return this.href == url;
    }).parent().addClass('active');
    while (true) {
        if (element.is('li')) {
            element = element.parent().parent().addClass('active');
        } else {
            break;
        }
    }
});
//********************************************************************//
//
//FORMATA O DATEPICKER
//
//********************************************************************//
$('.datepicker').datetimepicker({
    format: 'DD/MM/YYYY',
    locale: 'pt-br',
    useCurrent: false,
    icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up:   "fa fa-chevron-up",
        down: "fa fa-chevron-down",
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        today: 'fa fa-screenshot',
        clear: 'fa fa-trash',
        close: 'fa fa-remove'
    }
});
//********************************************************************//
//
//FORMATA O TIMEPICKER
//
//********************************************************************//
$('.timepicker').datetimepicker({
  format: 'HH:mm',
  locale: 'pt-br',
  useCurrent: false,
  icons: {
      time: "fa fa-clock-o",
      date: "fa fa-calendar",
      up:   "fa fa-chevron-up",
      down: "fa fa-chevron-down",
      previous: 'fa fa-chevron-left',
      next: 'fa fa-chevron-right',
      today: 'fa fa-screenshot',
      clear: 'fa fa-trash',
      close: 'fa fa-remove'
  }
});
//********************************************************************//
//
//TORNA UM INPUT EXIGIDO
//
//********************************************************************//
$(function(){
    $('.exigido').blur(function(){
        var campo = $(this).val();
        //var name = $(this).id();
        if ( campo=='' ) {
            $(this).focus();
            showNotification( 'Precisamos dessa informação...', 'danger');
        } 
    });
});
//********************************************************************//
//
//FORMATA APENAS NUMEROS
//
//********************************************************************//
function apenasNumeros(string) 
{
  var numsStr = string.replace(/[^0-9]/g,'');
   return parseInt(numsStr);
};
//********************************************************************//
//
//FORMATA CAMPOS DE ENTRADA DO INPUT
//
//********************************************************************//
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
//********************************************************************//
//
//BUSCA ENDERECO A PARTIR DO CEP
//
//********************************************************************//
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
//********************************************************************//
//
//Redimensionar os Gráficos
//
//********************************************************************//

window.onresize = function() {
  setTimeout(function(){
  //for(var i=0;i<20;i++){
    $('.charts').each(function(){
      var id = $(this).attr('_echarts_instance_');
      window.echarts.getInstanceById(id).resize();
    });
  },1000);
  //}
};