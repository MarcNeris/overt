@extends('layouts.overtsidebar')
@section('title', 'Leads e Contas | CRM')
@section('css')

@stop

@section('content')
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="card">
      <div class="card-header card-header-rose card-header-icon">
        <div class="card-icon">
          <i class="material-icons">equalizer</i>
        </div>
        <h4 class="card-title">Gestão de Clientes</h4>
      </div>
      <div class="card-body">
        <div class="toolbar">
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
              <table id="clientes" class="table table-striped table-bordered  table-hover" cellspacing="1" width="100%">
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
  </div>
</div>
@stop

@section('js')
<script src="{{ asset('assets/crm/js/dataTables.js') }}"></script>

<script>
  function ativar(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "{{url('reg/atv_users0001/')}}/"+id,
        type: 'GET',
        success: function(data) {
          var table = $('#clientes').DataTable({
            retrieve: true,
          });
          table.ajax.reload( null, false );
        }
    });
  }

  $(document).ready(function (){

    var table = $('#clientes').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      toolbar: ".toolbar",
      aaSorting: [[1, "asc"]],
      ajax: "{{route('senior.get_e085cli')}}",
      columns: [
        {data: null, title: 'Histórico',
          className: "center",
          orderable: false,
          searchable: false,
          fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
            $(nTd).html('<a href="#"'+'Histórico'+'" class="badge badge-info"><i class="material-icons">navigate_next</i></a>');
          }
        },
        //{data: 'CodCli', title: 'Código'},
        {data: 'NomCli', title: 'Cliente'},
        {data: 'ApeCli', title: 'Fantasia'},
        {data: 'CgcCpf', title: 'CNPJ/CPF'},
        {data: 'CidCob', title: 'Cidade'},
        {data: 'EstCob', title: 'UF'},
        {data: 'FonCli', title: 'Telefone'},
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


    $('#clientes tbody').on('click', 'tr', function () {
      
      var tr = $(this).closest('tr');
      var row = table.row( tr );

      if ( row.child.isShown() ) {

          row.child.hide();
          tr.removeClass('shown');

      } else {
          
        $.ajax({

          method:'GET' 
          ,url:"{{url('senior/get_e085hcl')}}"+"/"+row.data().CodCli
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

    //console.log(fRenderNumber);
      
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

