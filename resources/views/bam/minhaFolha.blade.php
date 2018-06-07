@extends('layouts.overtsidebar')
@section('title', 'Leads e Contas | CRM')
@section('css')

@stop

@section('content')
<div class="row">
  <div class="col-md-10">
    <div class="card card-chart">
      <div class="card-header card-header-icon card-header-danger">
          <div class="card-icon">
              <i class="material-icons">group</i>
          </div>
          <div class="card-header" id="TitCal">
            <h4 class="card-title">Folha de Pagamento - <small class="description"></small></h4>
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
                      Evento
                    </th>
                    <th>
                      Referência
                    </th>
                    <th>
                      Demonstrativo
                    </th>
                    <th>
                      Desconto
                    </th>
                    <th>
                      Proventos
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
  
  var TitCal = '<h4 class="card-title">Folha de Pagamento - <strong>Competência ${MesAno}</strong> <small class="description">O valor líquido de <strong class="text-success">${VlrLiq}</strong> foi depositado em : ${DatPag} </small></h4>';
  var CodEve = '<tr><td>${CodEve}</td><td class="text-right">${RefEve}</td><td class="text-right">${VlrOut}</td><td class="text-right text-danger">${VlrDsc}</td><td class="text-right text-success">${VlrPro}</td></tr>';
  var TotEve = '<th>Totais</th><th></th><th class="text-right">${TotOut}</th><th class="text-right text-danger">${TotDsc}</th><th class="text-right text-success">${TotPro}</th>';


  $.template( "TabEve", CodEve);

  $.ajax({
    type: "GET",
    url: "{{url('bam/r046verCodColDesEve')}}"+'/'+CodCal,
    dataType : 'json',
    success: function(r046verCodColDesEve){
      
      $('#TabEve').empty();
      $('#TotEve').empty();
      $('#TitCal').empty();

      var TotCal = r046verCodColDesEve.TotCal;
      console.log(TotCal);

      $.tmpl( TitCal, TotCal ).appendTo( '#TitCal' );

      $.tmpl( TotEve, TotCal ).appendTo( '#TotEve' );
        
      $.each( r046verCodColDesEve.series, function(k, TabEve){

        $.tmpl( CodEve, TabEve ).appendTo( '#TabEve' );

      });
    }
  })
}






$(document).ready(function (){

  var CodCal = '<li class="nav-item"><a class="nav-link show" onclick="CodCmp(${CodCal})" data-toggle="tab" href="#link${CodCal}" role="tablist">${DatCmp}</a></li>';

  $.template( "CodCal", CodCal);
  $.template( "CodCmp", CodCmp);

  $.ajax({
    type: "GET",
    url: "{{url('bam/get_r044cal')}}",
    dataType : 'json',
    success: function(get_r044cal){

       CodCmp();
      
      $( "#CodCal" ).empty();
      $( "#CodCmp" ).empty();

      $.tmpl( "CodCal", get_r044cal ).appendTo( "#CodCal" );
    }
  })
})
  
</script>




<script src="{{ asset('assets/crm/js/dataTables.js') }}"></script>

<script>
  function ativar(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "{{url('reg//')}}/"+id,
        type: 'GET',
        success: function(data) {
          var table = $('#minhaFolha').DataTable({
            retrieve: true,
          });
          table.ajax.reload( null, false );
        }
    });
  }

  $(document).ready(function (){

    var table = $('#minhaFolha').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      toolbar: ".toolbar",
      aaSorting: [[0, "desc"]],
      ajax: "{{route('bam.get_r044cal')}}",
      columns: [
        {data: 'DatPag', render: function ( data, type, row ) {
          return moment(data).format('YYYY-MM');}, 
          title:'Pagamento'
        },
        {data: 'IniCmp', render: function ( data, type, row ) {
          return moment(data).format('MM-YYYY');}, 
          title:'Competência'
        },
        //{data: 'DatPag', title: 'Pagamento'},
        //{data: 'IniCmp', title: 'Competência'},
        //{data: 'FimCmp', title: 'Cliente'},
        // {data: null, title: 'Ação',
        //   className: "center",
        //   orderable: false,
        //   searchable: false,
        //   fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
        //     $(nTd).html('<a href="{{url("bam/operacoes/monitoramento")}}/'+oData.CodCli+'" class="badge badge-info">Histórico</a>');
        //   }
        // },
      ],
    });


    $('#minhaFolha tbody').on('click', 'tr', function () {
      
      var tr = $(this).closest('tr');
      var row = table.row( tr );

      if ( row.child.isShown() ) {

          row.child.hide();
          tr.removeClass('shown');

      } else {
          
        $.ajax({

          method:'GET' 
          ,url:""
          ,success:function(data){
            row.child( format(data) ).show();
          }
             
        });

        tr.addClass('shown');
      }
    });
  });


function format(data) {

  var e08cli =  '<div class="row">'+
                  '<div class="col-md-6">'+
                    '<div class="card">'+
                      '<div class="card-header">'+
                        '<h4 class="card-title">Histórico do Cliente</h4>'+
                      '</div>'+
                      '<div class="card-body">'+
                        '<div id="accordion" role="tablist">'+
                          '<div class="card-collapse">'+
                            '<div class="card-header" role="tab" id="head1'+data.CodCli+'">'+
                              '<h5 class="mb-0">'+
                                '<a data-toggle="collapse" href="#CodCli'+data.CodCli+'" aria-expanded="false" aria-controls="CodCli'+data.CodCli+'" class="collapsed">'+
                                  'Financeiro'+
                                  '<i class="material-icons">keyboard_arrow_down</i>'+
                                '</a>'+
                              '</h5>'+
                            '</div>'+
                            '<div id="CodCli'+data.CodCli+'" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" style="">'+
                              '<div class="card-body">'+

                                '<h5>Categoria do Cliente: <b><span class="text-success">'+data.CatCli+'</span></b> | Crédito Aprovado :<b>'+data.LimApr+'</b></h5>'+
                                '<h5>Limite de Crédito: <b><span class="text-success">'+numeral(parseFloat(data.vlrlim)).format('$0,0.00')+'</span></b></h5>'+
                                '<h5>Títulos em Atraso: <b><span class="text-danger">'+numeral(parseFloat(data.VlrMac)).format('$0,0.00')+'</span></b></h5>'+
                                '<h5>Saldo de Crédito: <b><span class="text-danger">'+numeral(parseFloat(data.SalCre)).format('$0,0.00')+'</span></b></h5>'+
                                '<h5>Atraso médio em dias: <b><span class="text-danger">'+data.MedAtr+'</span></b></h5>'+
                                '<h5>Maior atraso em dias: <b><span class="text-danger">'+data.MaiAtr+'</span></b></h5>'+
                                '<h5>Prazo médio para recebimento: <b><span class="text-danger">'+data.PrzMrt+'</span></b></h5>'+
                                '<h5>Data do Último Pagamento: <b><span class="text-success">'+moment(data.DatUpg).format('DD/MM/YYYY')+'</span></b></h5>'+
                                '<h5>Valor do Último Pagamento: <b><span class="text-success">'+numeral(parseFloat(data.VlrUpg)).format('$0,0.00')+'</span></b></h5>'+
                              '</div>'+
                            '</div>'+
                            '<div class="card-header" role="tab" id="head2'+data.CodCli+'">'+
                              '<h5 class="mb-0">'+
                                '<a data-toggle="collapse" href="#CodCli2'+data.CodCli+'" aria-expanded="false" aria-controls="CodCli2'+data.CodCli+'" class="collapsed">'+
                                  'Comercial'+
                                  '<i class="material-icons">keyboard_arrow_down</i>'+
                                '</a>'+
                              '</h5>'+
                            '</div>'+
                            '<div id="CodCli2'+data.CodCli+'" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" style="">'+
                              '<div class="card-body">'+
                                '<h5>Data do Último Faturamento: <b><span class="text-success">'+moment(data.DatUfa).format('DD/MM/YYYY')+'</span></b></h5>'+
                                '<h5>Valor do Último Faturamento: <b><span class="text-success">'+numeral(parseFloat(data.VlrUfa)).format('$0,0.00')+'</span></b></h5>'+
                                '<h5>Data do Último Pedido: <b><span class="text-success">'+moment(data.DatUpe).format('DD/MM/YYYY')+'</span></b></h5>'+
                                '<h5>Valor do Último Pedido: <b><span class="text-success">'+numeral(parseFloat(data.VlrUpe)).format('$0,0.00')+'</span></b></h5>'+
                              '</div>'+
                            '</div>'+
                          '</div>'+
                        '</div>'+
                      '</div>'+
                    '</div>'+
                  '</div>'+
                '</div>';
    
    //var fRenderNumber = $.fn.dataTable.render.number;

 
      
     var html='<table class="table table-striped table-bordered  table-hover" cellspacing="1" width="100%">'+
          '<thead class="text-success">'+
            '<tr>'+
              '<th class"text-left">Evento</th>'+
              '<th class"text-left">Nome</th>'+
              '<th style="text-align:right;">Unidade</th>'+
              '<th style="text-align:right;">Quantidade</th>'+
              '<th style="text-align:right;">Valor Unitário</th>'+
              '<th style="text-align:right;">Valor Líquido</th>'+
            '</tr>'+
          '</thead>'+
          '<tbody>';

     // $.each(d, function (x,y){
        html+='<tr>'+
                   '<td style="text-align:right;">'+'vaiavel'+'</td>'+
                   '<td style="width: 40%" >'+'vaiavel'+'</td>'+
                   '<td style="text-align:right;">'+'vaiavel'+'</td>'+
                   '<td style="text-align:right;">'+'vaiavel'+'</td>'+
                   '<td style="text-align:right;">'+ 'vaiavel' +'</td>'+
                   '<td style="text-align:right;">'+ 'vaiavel' +'</td>'+
                '</tr>';
      //});

      html +='</tbody>'+    
      '</table>';
    
    return e08cli;
    
}


</script>
@stop

