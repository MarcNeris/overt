@extends('layouts.overtsidebar')
@section('title', 'Leads e Contas | CRM')
@section('css')

@stop

@section('content')
<div class="row">
  <div class="col-lg-8 col-md-12">
    <div class="card">
      <div class="card-header card-header-text card-header-rose">
        <div class="card-text">
          <h4 class="card-title">Administração de Contas<small></small></h4>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12 pull-left">
            <div class="col-md-12">
              <div class="table-responsive">
                <table id="empresas" class="table table-striped table-bordered  table-hover" cellspacing="1" width="100%">
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

  <div class="col-md-4">
    <div class="row">

    <div class="col-md-12">
      <div class="card card-chart" data-count="5">
          <div class="card-header card-header-rose" data-header-animation="true">
            <div class="ct-chart" id="websiteViewsChart"><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-bar" style="width: 100%; height: 100%;"><g class="ct-grids"><line y1="120" y2="120" x1="40" x2="493" class="ct-grid ct-vertical"></line><line y1="96" y2="96" x1="40" x2="493" class="ct-grid ct-vertical"></line><line y1="72" y2="72" x1="40" x2="493" class="ct-grid ct-vertical"></line><line y1="48" y2="48" x1="40" x2="493" class="ct-grid ct-vertical"></line><line y1="24" y2="24" x1="40" x2="493" class="ct-grid ct-vertical"></line><line y1="0" y2="0" x1="40" x2="493" class="ct-grid ct-vertical"></line></g><g><g class="ct-series ct-series-a"><line x1="58.875" x2="58.875" y1="120" y2="54.959999999999994" class="ct-bar" ct:value="542" opacity="1"></line><line x1="96.625" x2="96.625" y1="120" y2="66.84" class="ct-bar" ct:value="443" opacity="1"></line><line x1="134.375" x2="134.375" y1="120" y2="81.6" class="ct-bar" ct:value="320" opacity="1"></line><line x1="172.125" x2="172.125" y1="120" y2="26.400000000000006" class="ct-bar" ct:value="780" opacity="1"></line><line x1="209.875" x2="209.875" y1="120" y2="53.64" class="ct-bar" ct:value="553" opacity="1"></line><line x1="247.625" x2="247.625" y1="120" y2="65.64" class="ct-bar" ct:value="453" opacity="1"></line><line x1="285.375" x2="285.375" y1="120" y2="80.88" class="ct-bar" ct:value="326" opacity="1"></line><line x1="323.125" x2="323.125" y1="120" y2="67.92" class="ct-bar" ct:value="434" opacity="1"></line><line x1="360.875" x2="360.875" y1="120" y2="51.84" class="ct-bar" ct:value="568" opacity="1"></line><line x1="398.625" x2="398.625" y1="120" y2="46.8" class="ct-bar" ct:value="610" opacity="1"></line><line x1="436.375" x2="436.375" y1="120" y2="29.28" class="ct-bar" ct:value="756" opacity="1"></line><line x1="474.125" x2="474.125" y1="120" y2="12.599999999999994" class="ct-bar" ct:value="895" opacity="1"></line></g></g><g class="ct-labels"><foreignObject style="overflow: visible;" x="40" y="125" width="37.75" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 38px; height: 20px;">J</span></foreignObject><foreignObject style="overflow: visible;" x="77.75" y="125" width="37.75" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 38px; height: 20px;">F</span></foreignObject><foreignObject style="overflow: visible;" x="115.5" y="125" width="37.75" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 38px; height: 20px;">M</span></foreignObject><foreignObject style="overflow: visible;" x="153.25" y="125" width="37.75" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 38px; height: 20px;">A</span></foreignObject><foreignObject style="overflow: visible;" x="191" y="125" width="37.75" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 38px; height: 20px;">M</span></foreignObject><foreignObject style="overflow: visible;" x="228.75" y="125" width="37.75" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 38px; height: 20px;">J</span></foreignObject><foreignObject style="overflow: visible;" x="266.5" y="125" width="37.75" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 38px; height: 20px;">J</span></foreignObject><foreignObject style="overflow: visible;" x="304.25" y="125" width="37.75" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 38px; height: 20px;">A</span></foreignObject><foreignObject style="overflow: visible;" x="342" y="125" width="37.75" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 38px; height: 20px;">S</span></foreignObject><foreignObject style="overflow: visible;" x="379.75" y="125" width="37.75" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 38px; height: 20px;">O</span></foreignObject><foreignObject style="overflow: visible;" x="417.5" y="125" width="37.75" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 38px; height: 20px;">N</span></foreignObject><foreignObject style="overflow: visible;" x="455.25" y="125" width="37.75" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 38px; height: 20px;">D</span></foreignObject><foreignObject style="overflow: visible;" y="96" x="0" height="24" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 24px; width: 30px;">0</span></foreignObject><foreignObject style="overflow: visible;" y="72" x="0" height="24" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 24px; width: 30px;">200</span></foreignObject><foreignObject style="overflow: visible;" y="48" x="0" height="24" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 24px; width: 30px;">400</span></foreignObject><foreignObject style="overflow: visible;" y="24" x="0" height="24" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 24px; width: 30px;">600</span></foreignObject><foreignObject style="overflow: visible;" y="0" x="0" height="24" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 24px; width: 30px;">800</span></foreignObject><foreignObject style="overflow: visible;" y="-30" x="0" height="30" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 30px; width: 30px;">1000</span></foreignObject></g></svg></div>
          </div>
          <div class="card-body">
              <div class="card-actions">
                  <button type="button" class="btn btn-danger btn-link fix-broken-card">
                      <i class="material-icons">build</i> Fix Header!
                  </button>
                  <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="" data-original-title="Atualizar">
                      <i class="material-icons">refresh</i>
                  </button>
                  <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="" data-original-title="Alterar a Data">
                      <i class="material-icons">edit</i>
                  </button>
              </div>
              <h4 class="card-title">Campanha de Vendas</h4>
              <p class="card-category">última performance da Campanha</p>
          </div>
          <div class="card-footer">
              <div class="stats">
                  <i class="material-icons">access_time</i> campanha enviada há 2 dias!
              </div>
          </div>
      </div>
    </div>







    
      <div class="col-lg-12 col-md-6 col-sm-6">
        <div class="card card-stats">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">equalizer</i>
                </div>
                <p class="card-category">Contas</p>
                <h3 class="card-title">75.521</h3>
              </div>
              <div class="card-footer">
                  <div class="stats">
                      <i class="material-icons">local_offer</i> Gestão de Contas
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
        url: "{{url('reg/ajx_regemp000/')}}/"+id+"/ativar",
        type: 'GET',
        success: function() {
            var table = $('#empresas').DataTable( {
             retrieve: true,
            } );
            table.ajax.reload( null, false );

        }
    });
  }

  $(document).ready(function (){
    $('#empresas').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      toolbar: ".toolbar",
      aaSorting: [[0, "asc"]],
      ajax: "{{ route('crm.get_crmcta000')}}",
      columns: [
        //{data: 'id', title: 'ID'},
        {data: 'RegFed', title: 'Registro Federal'},
        {data: 'NomPsa', title: 'Razão Social'},
        {data: 'SitCta', title: 'Status'},
        {data: null, title: 'Ações',
          className: "center",
          orderable: false,
          searchable: false,
          fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
            $(nTd).html("<div id='actions'>\n\
              <a onclick='ativar(" + oData.id + ")' href='#'><i class='material-icons'>done</i></a>\n\
              <a onclick='inativar(" + oData.id + ")' href='#'><i class='material-icons'>visibility</i></a>\n\
              <a href='{{url('nfi/t001ent/')}}/" + oData.RegFed + "/ativar'><i class='fa fa-wrench fa-fw'></i></a></div><a href='#' class='badge badge-danger'>Nova Conta</a>"
            )
          }
        }
      ],
    });
  });
</script>
@endsection