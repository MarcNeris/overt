@extends('layouts.overtsidebar')

@section('css')

<script src="{{ asset('assets/crm/js/echarts.min.js') }}"></script>
<script src="https://www.gstatic.com/firebasejs/5.0.4/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.0.4/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.0.4/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.0.4/firebase-storage.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.0.4/firebase-firestore.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBOM9nddVvB1lw17plPjToM4hLV8XdU0c"></script>
<script src="{{asset('assets/hcm/js/firebase.js')}}"></script>
<style type="text/css">
     #tablePonto{
           min-height: 400px;
        }
</style>
@stop

@section('content')
<div class="row"> 
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-text card-header-rose">
                <div class="card-text">
                    <h4 class="card-title">Monitoramento de Ponto</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">  
                        <div class="content table-responsive table-full-width">
                            <div class="content" id="tablePonto">
                                <div class="col-md-3">
                                    <div class="form-group bmd-form-group is-filled">
                                    <label class="bmd-label-floating"></label>
                                    <input id="dataMarcacao" type="text" id="DatIni" name="dataMarcacao" class="form-control datepicker" placeholder="Data da Marcação">
                                  </div>
                                </div>
                                <table class="table table-striped table-hover">
                                    <thead class="text-primary">
                                        <th>Orientação</th>
                                        <th>Hora do Satélite</th>
                                        <th>Hora Marcação</th>
                                        <th>CPF</th>
                                        <th>PIS</th>
                                    </thead>
                                    <tbody id="ponto">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="map" class="map" style="position: relative; overflow: hidden;">
                            <div style="height: 100%; width: 100%; position: absolute; top: 0px; left: 0px; background-color: rgb(229, 227, 223);"> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="acertoPontoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">HCM REP | Acerto de Ponto</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-testimonial">
                                    <div class="icon">
                                        <i class="material-icons">format_quote</i>
                                    </div>
                                    <div class="card-body">
                                        <h5 id="justificativaAcerto" class="card-description">
                                        
                                        </h5>
                                    </div>
                                    <div id="hasDoc" class="card-footer">
                                        <h4 class="card-title">Documentação</h4>
                                        <div class="card-avatar">
                                          <img width="50px" height="50px" id="justificativaImagem" class="img" src="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-md-12">
                                <div id="mapMarcacao" class="card card-testimonial" style="background-color: rgb(229, 227, 223); height: 200px; width: 100%;">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <ul class="timeline timeline-simple">
                            <li id="justificativa" class="timeline-inverted">
                                <div class="timeline-badge X">
                                    <i class="material-icons">edit</i>
                                </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <span id="dataHoraAcerto" class="badge X"></span>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Marcação proposta manualmente </p>
                                        <h6><i id="dataHoraAcertoAgo" class="ti-time"></i></h6>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-inverted">
                                <div class="timeline-badge success">
                                    <i class="material-icons">fingerprint</i>
                                </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <span id="dataHoraST" class="badge badge-success"></span>
                                    </div>
                                    <div class="timeline-body">
                                      <p>Hora capturada via Satélite</p>
                                      <h6><i id="dataHoraSTAgo" class="ti-time"></i><h6>
                                    </div>
                                </div>
                            </li>
                            <div class="col-md-12">
                                 <div class="row">
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-danger">Reprovar</button>
                                    </div>
                                    <div class="col-md-4">
                                        <span id="aprovaPonto"></span>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">

const mapOptions = {
    zoom: 10,
    scrollwheel: false,
    styles: [{"featureType":"water","stylers":[{"saturation":50},{"lightness":-11},{"hue":"#0088ff"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#b3b3b3"}]}, {"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#767676"},{"lightness":54}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#f6f2ee"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#9ab464"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#767676"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#d2deba"}]},{"featureType":"poi.park","stylers":[{"visibility":"on"}]},{"featureType":"poi.sports_complex","stylers":[{"visibility":"on"}]},{"featureType":"poi.medical","stylers":[{"visibility":"on"}]},{"featureType":"poi.business","stylers":[{"visibility":"simplified"}]}]
}

acertoPonto = function(CNPJ, CPF, uid, dateTimeST, mapOptions){

   
    const YYYYMMDD = moment(dateTimeST).format('YYYY-MM-DD');
    const HHmm =  moment(dateTimeST).format('HH-mm');
    var REPref = FS.collection('users/REP/'+uid+'/'+CNPJ+'/'+YYYYMMDD).doc(HHmm);

    $('#aprovaPonto').on('click', function(){

        REPref.update({
            justificativaAprovada:1, 
            justificativaAprovador:uid,
            justificativaAprovadorTimestamp: firebase.firestore.FieldValue.serverTimestamp()
        });

        $('#aprovaPonto').empty();

    });
                        
    REPref.get().then(function(doc) {

        var REP = doc.data();

        if(REP.justificativaImagem==1){

            //firebase.storage().ref('hcm/REP'+uid+'/'+CNPJ+'/'+YYYYMMDD+'/'+HHmm+'.jpg').getDownloadURL().then(function(imageUrl){
            firebase.storage().ref('users/REP/'+uid+'/'+CNPJ+'/'+YYYYMMDD+'/'+HHmm+'.jpg').getDownloadURL().then(function(imageUrl){

                $("#hasDoc").html('<h4 class="card-title">Documentação</h4><div class="card-avatar"><img width="50px" height="50px" id="justificativaImagem" class="img" src="'+imageUrl+'"></div>');
            });

        }else{

            $("#hasDoc").empty(); 
        }

        if(REP.justificativa==0){
            //$('#justificativa').empty();
        }


        if(REP.justificativaAprovada==1){
            $('#aprovaPonto').empty();
        }else{
            $('#aprovaPonto').html('<button  type="button" class="btn btn-success">Aprovar</button>');
        }


        if(REP.ES=='X'){
            $('.X').addClass('badge-warning warning');
            $('.X').addClass('badge-danger danger');
        }else{
            $('.X').removeClass('badge-danger danger');
            $('.X').addClass('badge-warning warning');
        }


        $('#dataHoraAcerto').html(REP.dataHoraAcerto);
        $('#dataHoraST').html(REP.dataHoraST);
        $('#justificativaAcerto').html(REP.justificativaAcerto);
        $('#dataHoraSTAgo').html(moment(REP.dateTimeST).fromNow());
        $('#dataHoraAcertoAgo').html(moment(REP.dataHoraAcerto,'DD/MM/YYYY HH:mm:ss').fromNow());

        mapOptions.zoom=17;

        var mapMarcacao = new google.maps.Map(document.getElementById("mapMarcacao"), mapOptions);
        
        GOOGLE = {"lat": REP.latitude, "lng": REP.longitude};

        mapMarcacao.setCenter(GOOGLE);  

        var marker = new google.maps.Marker({
            position: GOOGLE,
            title: REP.dataHoraST
        });

        marker.setMap(mapMarcacao);
    })
}


var dataMarcacao =  document.getElementById('dataMarcacao');

dataMarcacao.value = moment(new Date()).format('DD/MM/YYYY');

dataMarcacao.addEventListener('blur', function(){
    
    getMarcacao(mapOptions);
});


getMarcacao = function(mapOptions){


    var map = new google.maps.Map(document.getElementById("map"), mapOptions);
    var bounds = new google.maps.LatLngBounds();
    var infowindow = new google.maps.InfoWindow();

    var YYYYMMDD = moment($('#dataMarcacao').val(),'DD/MM/YYYY').format('YYYY-MM-DD');

    var uid = window.location.href.split("/")[window.location.href.split("/").length -1];
    
    var refEmployee = DB('rep','{{$RegFed}}'+'/'+YYYYMMDD+'/'+uid);

    refEmployee.on('value', function(REP){


        REP = REP.val();


        $("#ponto").empty();

        var REPStatus = '<tr><td> <button class="btn btn-sm ${btnESclass}">${ES}</button></td> <td><h5>${horaST}</h5></td> <td><button onclick="acertoPonto(\'${CNPJ}\',\'${CPF}\',\'${uid}\',\'${dateTimeST}\', mapOptions)" class="btn ${btnAcertoClass}" data-toggle="modal" data-target="#acertoPontoModal">${horaAcerto}</button></td> <td>${CPF}</td> <td>${PIS}</td> </tr>';

        $.each( REP, function(dia, ponto){

            if(ponto.ES!='X'){
                
                GOOGLE = {"lat": ponto.latitude, "lng": ponto.longitude};

                var marker = new google.maps.Marker({
                    position: GOOGLE,
                    title: ponto.dataHoraST,
                    map:map
                });

                bounds.extend(marker.position);

                map.fitBounds(bounds);

                google.maps.event.addListener(marker, 'click', function() {
      
                    infowindow.setContent('Registro de Ponto\n'+ponto.horaST);
                    infowindow.open(map, marker);
                });
            }



            if(ponto.justificativaAprovada==1){

                ponto.btnAcertoClass = 'btn-success';
            }

            $.tmpl( REPStatus, ponto ).appendTo( "#ponto" );
        })
    })
}

getMarcacao(mapOptions);

</script>
@stop