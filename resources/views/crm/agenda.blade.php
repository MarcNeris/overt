@extends('adminlte::page')

@section('title', 'overt touch | CRM')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/fullcalendar/dist/css/fullcalendar.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/fullcalendar/dist/css/fullcalendar.print.min.css') }}" media="print">
@stop

@section('content')

<section class="content">
      <div class="row">
        <div class="col-md-3">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h4 class="box-title">Draggable Events</h4>
            </div>
            <div class="box-body">
              <!-- the events -->
              <div id="external-events">
                <div class="external-event bg-green">Lunch</div>
                <div class="external-event bg-yellow">Go home</div>
                <div class="external-event bg-aqua">Do homework</div>
                <div class="external-event bg-light-blue">Work on UI design</div>
                <div class="external-event bg-red">Sleep tight</div>
                <div class="checkbox">
                  <label for="drop-remove">
                    <input type="checkbox" id="drop-remove">
                    remove after drop
                  </label>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Create Event</h3>
            </div>
            <div class="box-body">
              <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
                <ul class="fc-color-picker" id="color-chooser">
                  <li><a class="text-aqua" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-muted" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
                </ul>
              </div>
              <!-- /btn-group -->
              <div class="input-group">
                <input id="new-event" type="text" class="form-control" placeholder="Event Title">

                <div class="input-group-btn">
                  <button id="add-new-event" type="button" class="btn btn-primary btn-flat">Add</button>
                </div>
                <!-- /btn-group -->
              </div>
              <!-- /input-group -->
            </div>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
        	@include('layouts.alert')
          <div class="box box-primary">
            <div class="box-body no-padding">
              <!-- THE CALENDAR -->
              <div id="calendar"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

 
 <!-- Modal -->
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
        <form name="novoEvento" role="form" method="POST" action="{{ route('new_crm000evt') }}">
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


@stop


@section('js')

<script src="{{ asset('assets/fullcalendar/dist/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/fullcalendar/dist/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/fullcalendar/dist/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/fullcalendar/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/fullcalendar/dist/js/fullcalendar.min.js') }}"></script>
<script src="{{ asset('assets/fullcalendar/dist/js/locale-all.js') }}"></script>
<script>
 $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function init_events(ele) {
      ele.each(function () {
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        $(this).data('eventObject', eventObject)

        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    init_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()
    

    $('#calendar').fullCalendar({
		header    : {
		left  : 'title',
		center: '',
		right : 'month,agendaWeek,agendaDay,prev,today,next'
		},
		locale: 'pt-br',
    selectable: true,
    eventStartEditable: true,
    revert: true,
    selectHelper: true,
    editable  : true,
    droppable : true,
    eventLimit: true,
    dragRevertDuration: 500,
    longPressDelay : 500,
    eventDurationEditable : true,


		events    : '{{ route('get_crm000evt') }}',

  
    eventClick: function(event) {
      $('#criar_evento #id').val(event.id);
      $('#criar_evento #nomeEvento').val(event.title);
      $("#criar_evento #dataInicio").val((event.start).format('DD/MM/YYYY HH:mm:ss'));
      $("#criar_evento #dataFim").val((event.end).format('DD/MM/YYYY HH:mm:ss'));
      document.novoEvento.action = "{{ route('upd_crm000evt') }}";
      $('#criar_evento').modal();
    },

    eventDrop: function(event, delta, revertFunc) {

      event_data = {
      _token: '{{csrf_token()}}',
      id: event.id,
      nomeEvento: event.title,
      dataInicio: event.start.format('DD/MM/YYYY HH:mm:ss'),
      dataFim: event.end.format('DD/MM/YYYY HH:mm:ss')  
      };
      $.ajax({
        url: "{{ route('upd_crm000evt') }}",
        data: event_data,
        type: 'POST',
        dataType: 'JSON'
      });
    },

    select: function(start, end) {
      $('#criar_evento #nomeEvento').val('');
      $("#criar_evento #dataInicio").val(moment(start).format('DD/MM/YYYY HH:mm:ss'));
      $("#criar_evento #dataFim").val(moment(end).format('DD/MM/YYYY HH:mm:ss'));
      $("#criar_evento").modal();
    },

    eventResize: function(event, delta, revertFunc) {

      event_data = {
      _token: '{{csrf_token()}}',
      id: event.id,
      nomeEvento: event.title,
      dataInicio: event.start.format('DD/MM/YYYY HH:mm:ss'),
      dataFim: event.end.format('DD/MM/YYYY HH:mm:ss')  
      };
      $.ajax({
        url: "{{ route('upd_crm000evt') }}",
        data: event_data,
        type: 'POST',
        dataType: 'JSON'
      });
    },


  	



  	drop: function (date, allDay) { 

        var originalEventObject = $(this).data('eventObject')

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject)

        // assign it the date that was reported
        copiedEventObject.start           = date
        copiedEventObject.allDay          = allDay
        copiedEventObject.backgroundColor = $(this).css('background-color')
        copiedEventObject.borderColor     = $(this).css('border-color')

        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

        if ($('#drop-remove').is(':checked')) {
          
          $(this).remove()
        }

      }
    })

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      //Save color
      currColor = $(this).css('color')
      //Add color effect to button
      $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      //Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      //Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.html(val)
      $('#external-events').prepend(event)

      //Add draggable funtionality
      init_events(event)

      //Remove event from text input
      $('#new-event').val('')
    })
  })



function DataHora(evento, objeto){
	var keypress=(window.event)?event.keyCode:evento.which;
	campo = eval (objeto);
	if (campo.value == '00/00/0000 00:00:00')
	{
		campo.value=""
	}
 
	caracteres = '0123456789';
	separacao1 = '/';
	separacao2 = ' ';
	separacao3 = ':';
	conjunto1 = 2;
	conjunto2 = 5;
	conjunto3 = 10;
	conjunto4 = 13;
	conjunto5 = 16;
	if ((caracteres.search(String.fromCharCode (keypress))!=-1) && campo.value.length < (19))
	{
		if (campo.value.length == conjunto1 )
		campo.value = campo.value + separacao1;
		else if (campo.value.length == conjunto2)
		campo.value = campo.value + separacao1;
		else if (campo.value.length == conjunto3)
		campo.value = campo.value + separacao2;
		else if (campo.value.length == conjunto4)
		campo.value = campo.value + separacao3;
		else if (campo.value.length == conjunto5)
		campo.value = campo.value + separacao3;
	}
	else
		event.returnValue = false;
}

</script>
@endsection