@extends('layouts.overtsidebar')
@section('title', 'CRM | Plano de Vôo')
@section('css')

@stop

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
    <div class="card">
      <div class="card-header card-header-text card-header-warning">
        <div class="card-text">
          <h4 class="card-title">Plano de Vôo</h4>
          <p class="card-category">Status da Agenda</p>
        </div>
      </div>
      <div class="card-body table-responsive">
        <div id="calendar"></div>
      </div>
    </div>
  </div>
</div>
    
<div class="modal" id="criar_evento" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Plano de Vôo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <form name="novoEvento" role="form" method="POST" action="{{ route('crm.new_crmevt000') }}">
             <div class="form-group  label-floating">
                {!! csrf_field() !!}
                <input id="id" type="hidden" name="id">
                <label class="bmd-label-floating"></label>
              <input required="" id="NomEvt" type="text" class="form-control input-lg" name="NomEvt" value="" placeholder="Nome do Evento">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8">
            <div class="form-group bmd-form-group is-filled">
            <label class="bmd-label-floating"></label>
            <input required="" type="text" id="DatIni" name="DatIni" class="form-control datepicker" placeholder="Início do Evento">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group bmd-form-group is-filled">
            <label class="bmd-label-floating"></label>
              <input required="" type="text" id="HraIni" name="HraIni" class="form-control timepicker" placeholder="Hora">
            </div>
          </div>
        </div>
        <div class="row">
        <div class="col-md-8">
          <div class="form-group bmd-form-group is-filled">
            <label class="bmd-label-floating"></label>
            <input required="" type="text" id="DatFim" name="DatFim" class="form-control datepicker" placeholder="Fim do Evento">
          </div>
        </div>
          <div class="col-md-4">
            <div class="form-group bmd-form-group is-filled">
              <label class="bmd-label-floating"></label>
              <input required="" type="text" id="HraFim" name="HraFim" class="form-control timepicker" placeholder="Hora">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <button type="button" class="btn btn-lg" data-dismiss="modal">Sair</button>
            <button type="button" class="btn btn-danger btn-lg" data-dismiss="">Excluir</button>
            <button id="Enviar" type="submit" class="btn btn-primary btn-lg pull-right" data-dismiss="">Salvar</button>
          </div>
        </div>
      </div>
</form><!-- form datepicker-->
      
    </div>
  </div>
</div>



@stop

@section('js')

<script src="{{ asset('assets/fullcalendar/dist/js/moment.min.js') }}"></script>
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
        center: 'today',
        right : 'month,agendaWeek,agendaDay,prev,listMonth,next'
        },
        locale: 'pt-br',
    weekNumbers: true,
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
    theme: true,    
    themeSystem:'bootstrap4',
    defaultView: 'agendaWeek',
    //which:100,
    //height:400,
    events    : "{{ route('crm.get_crmevt000') }}",

    select: function(start, end) {

      $('#criar_evento #NomEvt').val('');
      $("#criar_evento #DatIni").val(moment(start).format('DD/MM/YYYY'));
      $("#criar_evento #HraIni").val(moment(start).format('HH:mm'));
      $("#criar_evento #DatFim").val(moment(end).format('DD/MM/YYYY'));
      $("#criar_evento #HraFim").val(moment(end).format('HH:mm'));
      $("#criar_evento").modal();
    },
 

    eventClick: function(event) {
      console.log(event.title);
      $('#criar_evento #id').val(event.id);
      $('#criar_evento #NomEvt').val(event.title);
      $("#criar_evento #DatIni").val((event.start).format('DD/MM/YYYY'));
      $("#criar_evento #HraIni").val((event.start).format('HH:mm'));
      $("#criar_evento #DatFim").val((event.end).format('DD/MM/YYYY'));
      $("#criar_evento #HraFim").val((event.end).format('HH:mm'));
      document.novoEvento.action = "{{ route('crm.upd_crmevt000') }}";
      $('#criar_evento').modal();
    },


    eventDrop: function(event, delta, revertFunc) {

      event_data = {
      _token: '{{csrf_token()}}',
      id: event.id,
      NomEvt: event.title,
      DatIni: event.start.format('DD/MM/YYYY HH:mm'),
      DatFim: event.end.format('DD/MM/YYYY HH:mm')  
      };
      $.ajax({
        url: "{{ route('crm.upd_crmevt000') }}",
        data: event_data,
        type: 'POST',
        dataType: 'JSON'
      });
    },



    eventResize: function(event, delta, revertFunc) {

      event_data = {
      _token: '{{csrf_token()}}',
      id: event.id,
      NomEvt: event.title,
      DatIni: event.start.format('DD/MM/YYYY HH:mm'),
      DatFim: event.end.format('DD/MM/YYYY HH:mm')  
      };
      $.ajax({
        url: "{{ route('crm.upd_crmevt000') }}",
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

</script>
@stop