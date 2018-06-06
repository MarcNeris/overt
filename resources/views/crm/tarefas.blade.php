@extends('layouts.overtsidebar')
@section('title', 'overt touch | CRM')
@section('css')

<link href="{{ asset('assets/drag/style.css') }}" rel="stylesheet">
@stop
@section('content')

<div class="row">
    <div class="col-lg-12 col-md-12">
    <div class="card">
      <div class="card-header card-header-text card-header-warning">
        <div class="card-text">
          <h4 class="card-title">Gestão de Tarefas</h4>
          <p class="card-category">Status das Tarefas</p>
        </div>
      </div>
      <div class="card-body">
  		<div id="redips-drag">
			<div class="col-md-3 pull-right">
				<table id="table1">
					<tbody>
						<tr>
							<td class="redips-drag trash alert alert-danger" title="Trash">Suspects</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-md-10 table-responsive">
				<table id="table2" class="table">
					<tbody>
						<tr>
							<td class="redips-mark alert alert-danger">Tarefas</td>
							<td class="redips-mark alert alert-danger">Suspect</td>
							<td class="redips-mark alert alert-danger">Prospect</td>
							<td class="redips-mark alert alert-danger">Proposta</td>
							<td class="redips-mark alert alert-danger">Negociação</td>
							<td class="redips-mark alert alert-danger">Fechamento</td>
						</tr>
						<tr>
							<td class="redips-drag"></td>
							<td class="redips-drag"></td>
							<td class="redips-drag"></td>
							<td class="redips-drag"></td>
							<td class="redips-drag"></td>
							<td class="redips-drag"></td>
						</tr>
						<tr>
							<td class="redips-drag"></td>
							<td class="redips-drag"></td>
							<td class="redips-drag"></td>
							<td class="redips-drag"></td>
							<td class="redips-drag"></td>
							<td class="redips-drag"></td>
						</tr>
						<tr>
							<td class="redips-drag"></td>
							<td class="redips-drag"></td>
							<td class="redips-drag"></td>
							<td class="redips-drag"></td>
							<td class="redips-drag"></td>
							<td class="redips-drag"></td>
						</tr>
						<tr>
							<td class="redips-drag"></td>
							<td class="redips-drag"></td>
							<td class="redips-drag"></td>
							<td class="redips-drag"></td>
							<td class="redips-drag"></td>
							<td class="redips-drag"></td>
						</tr>
						<tr>
							<td class="redips-drag"></td>
							<td class="redips-drag"></td>
							<td class="redips-drag"></td>
							<td class="redips-drag"></td>
							<td class="redips-drag"></td>
							<td class="redips-drag"></td>
						</tr>
						<tr>
							<td class="redips-drag"></td>
							<td class="redips-drag"></td>
							<td class="redips-drag"></td>
							<td class="redips-drag"></td>
							<td class="redips-drag"></td>
							<td class="redips-drag"></td>
						</tr>					
					</tbody>
				</table>
			</div>
		</div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClJ_NH1QS3SlZd0oqNb827V9yyUErsWtQ"><script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClJ_NH1QS3SlZd0oqNb827V9yyUErsWtQ&callback=initMap"
  type="text/javascript"></script>




<div class="modal" id="criar_evento" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">overt | Novo Evento ou Compromisso</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form name="novoEvento" role="form" method="POST" action="{{ route('crm.new_crmevt000') }}">
          <div class="box-body">
          {!! csrf_field() !!}
          <input id="id" type="hidden" name="id">
          <div class="form-group">
          <input id="nomeEvento" type="text" class="form-control input-lg" name="nomeEvento" value="{{ old('nomeEvento') }}" placeholder="Nome do Evento">
          <span class="text-red">
          <strong>{{ $errors->first('nomeEvento') }}</strong>
          </span>
          </div>
          <div class="form-group">
          <input id="dataInicio" type="text" onkeypress="DataHora(event, this)" class="form-control input-lg" name="dataInicio" value="{{ old('dataInicio') }}">
          <span class="text-red">
          <strong>{{ $errors->first('dataInicio') }}</strong>
          </span>
          </div>
          <div class="form-group">
          <input id="dataFim" type="text" onkeypress="DataHora(event, this)" class="form-control input-lg" name="dataFim" value="{{ old('dataFim') }}">
          <span class="text-red">
          <strong>{{ $errors->first('dataFim') }}</strong>
          </span>
          </div>
          <div class="box-footer">
          </div>
          <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Sair</button>
          <button type="submit" class="btn btn-primary btn-lg pull-right" data-dismiss="">Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>





@endsection
@section('js')



<script type="text/javascript">

"use strict";

var redips = {};

redips.init = function () {

	var	rd = REDIPS.drag;
	rd.init();
	//rd.hover.colorTd = 'red';
	//rd.hover.borderTd = '2px solid white';
	rd.clone.keyDiv = false;
	rd.dropMode = 'multiple';	
	//rd.style.borderDisabled = 'dashed';
	//rd.clone.keyDiv = false;			// enable cloning DIV elements with pressed SHIFT key
	redips.divNodeList = document.getElementById('table2').getElementsByTagName('div');
	

	rd.event.dropped = function () {
		var	objOld = rd.objOld,					// original object
			targetCell = rd.td.target,			// target cell
			targetRow = targetCell.parentNode,	// target row
			i, objNew;							// local variables
		if (rd.td.target !== rd.td.source) { 
			
		}
	
		redips.save();
	};

	rd.event.moved = function(){
	}

	// after element is deleted from the timetable, print message
	rd.event.deleted = function () {
		redips.save();
	};
	
	// if any element is clicked, then make all subjects in timetable visible
	rd.event.dblClicked = function () {
		$('#criar_evento').modal();

		//redips.showAll();
		//window.alert('show');
	};



	redips.targetTable = document.getElementById('table2');

	
};


redips.loadData = function () {
	$.ajax({
	    type: "GET",
	    url: "{{ route('crm.get_crmtfa001') }}",
	    dataType : 'json',
	    success: function(crm001tfa){
		REDIPS.drag.loadContent('table2',crm001tfa);
	    }
	});
};


redips.showContent=function() {
	$.ajax({
	    type: "GET",
	    url: "{{ route('crm.get_crmtfa000') }}",
	    dataType : 'json',
	    success: function(crm000tfa){
	        var vtLeft = '';
			$.each( crm000tfa, function( key, value ) {
				vtLeft += '<tr id="tr_'+value.id+'"><td><div id="'+value.id+'" class="redips-drag c'+value.id+'">'+value.NomTfa+'</div></td></tr>';
			});
			$("#table1").append(vtLeft);
			redips.init();
	    }
	}); 
	redips.loadData();
};


// save elements and their positions
redips.save = function () {

	var tablePosition = REDIPS.drag.saveContent('table2','json');

    $.ajax({
        url: "{{ route('crm.upd_crmtfa001') }}",
        type: 'POST',
        data:{dataRows: tablePosition,
        _token: '{{csrf_token()}}'},
        dataType: 'json',
    });     
};



redips.printMessage = function (message) {
	document.getElementById('message').innerHTML = message;
};

redips.showAll = function () {
	var	i; // loop variable
	for (i = 0; i < redips.divNodeList.length; i++) {
		redips.divNodeList[i].style.visibility = 'visible';
	}
};

if (window.addEventListener) {
	window.addEventListener('load', redips.showContent, true);
}
else if (window.attachEvent) {
	window.attachEvent('onload', redips.showContent);
}


</script>
<script src="{{ asset('assets/drag/redips-drag-min.js') }}"></script>
@endsection