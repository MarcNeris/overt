@extends('layouts.overtsidebar')
@section('title', 'Leads e Contas | CRM')
@section('css')

@stop

@section('content')
<div class="row">
  <div class="col-md-8">
    <div class="card card-chart">
      <div class="card-header card-header-icon card-header-danger">
          <div class="card-icon">
              <i class="material-icons">group</i>
          </div>
          <div class="card-header" id="TitCal">
            <h4 class="card-title">HCM - Folha de Pagamento<br><small class="description"></small>PayCheck</h4>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-2">
            <ul id="CodCal" class="nav nav-pills nav-pills-rose flex-column" role="tablist"></ul>
          </div>
          <div class="col-lg-10">
            <div class="table-responsive">
              <table class="table">
                <thead class="text-primary">
                  <tr>
                    <th>
                      Descrição
                    </th>
                    <th class="text-right">
                      Ref.
                    </th>
                    <th class="text-right">
                      Proventos
                    </th>
                    <th class="text-right">
                      Desconto
                    </th>
                  </tr>
                </thead>
                <tbody id="TabEve">
                </tbody>
                <tfoot id="TotEve">
                </tfoot>
              </table>
            </div>
          </div>
        </div> 
      </div>
      <div class="card-footer">
          <div class="stats">
              <i class="material-icons">access_time</i>
              <span id="#"></span>
          </div>
      </div>
  </div>
</div>

@stop

@section('js')
<script type="text/javascript">
//********************************************************************//
//
//HCM FOLHA CARREGA O CODIGO DE CALCULO
//
//********************************************************************//

function CodCmp(CodCal){
  
  var TitCal = '<h4 class="card-title">HCM - Folha de Pagamento | <strong> ${MesAno}</strong></h4>';
  
  var CodEve = '<tr><td>${CodEve}</td><td class="text-right">${RefEve}</td><td class="text-right text-success">${VlrPro}<span class="text-primary"><b>${VlrOut}</b></span></td><td class="text-right text-danger">${VlrDsc}</td></tr>';
  
  var TotEve = '<tr><th colspan="2" class="td-total">Totais</th><th class="td-total text-success">${TotPro}</th><th class="td-total text-danger">${TotDsc}</th></tr> <tr><th colspan="3" class="td-total">Valor Líquido da Folha</th><th class="td-total text-success"><strong> ${VlrLiq} </strong></th><tr> <tr><th class="text-right">Data de Pagamento</th><th class="text-right text-success"><strong> ${DatPag} </strong></th><th class="text-right">Competência</th><th class="text-right text-success"><strong> ${MesAno} </strong></th><tr>';

  $.ajax({

    type: "GET",
    url: "{{url('bam/r046verCodColDesEve')}}"+'/'+CodCal,
    dataType : 'json',
    success: function(r046verCodColDesEve){
      
      $('#TabEve').empty();
      $('#TotEve').empty();
      $('#TitCal').empty();
 

      var TotCal = r046verCodColDesEve.TotCal;

      $.tmpl( TitCal, TotCal ).appendTo( '#TitCal' );

      $.tmpl( TotEve, TotCal ).appendTo( '#TotEve' );
        
      $.each( r046verCodColDesEve.series, function(k, TabEve){

        $.tmpl( CodEve, TabEve ).appendTo( '#TabEve' );

      });
    }
  })
}

$(document).ready(function (){

  var CodCal = '<li class="nav-item"><a class="nav-link show ${SitMen}" id="id${CodCal}" onclick="CodCmp(${CodCal})" data-toggle="tab" href="#link${CodCal}" role="tablist">${DatCmp}</a></li>';

  $.template( "CodCal", CodCal);
  $.template( "CodCmp", CodCmp);

  $.ajax({
    type: "GET",
    url: "{{url('bam/get_r044cal')}}",
    dataType : 'json',
    success: function(get_r044cal){

      CodCmp(get_r044cal[0].CodCal);
      
      $( "#CodCal" ).empty();
      $( "#CodCmp" ).empty();

      get_r044cal[0].SitMen='active';

      $.tmpl( "CodCal", get_r044cal ).appendTo( "#CodCal" );
    }
  })
})  
</script>

@stop

