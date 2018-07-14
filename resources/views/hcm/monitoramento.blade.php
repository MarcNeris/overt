@extends('layouts.overtsidebar')

@section('css')

<script src="{{ asset('assets/crm/js/echarts.min.js') }}"></script>
<script src="https://www.gstatic.com/firebasejs/5.0.4/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.0.4/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.0.4/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.0.4/firebase-storage.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.0.4/firebase-firestore.js"></script>
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
        <div class="card card-nav-tabs">
          <h4 class="card-header card-header-rose">Administração de Ponto
          </h4>
          <div class="card-body">
            <div class="content table-responsive table-full-width">
                <div class="content" id="tablePonto">
                     <div class="col-md-2">
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
                            <th>Matrícula</th>
                            <th>Crachá</th>
                            <th>CPF</th>
                            <th>PIS</th>
                        </thead>
                        <tbody id="ponto">
                        </tbody>
                    </table>
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-danger">Reprovar</button>
                        <span id="aprovaPonto"></span>
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
                        </ul>
                    </div>
                    <div class="col-sm-6">
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">

acertoPonto = function(CNPJ, CPF, uid, dateTimeST){

   
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

            firebase.storage().ref('hcm/rep/'+uid+'/'+CNPJ+'/'+YYYYMMDD+'/'+HHmm+'.jpg').getDownloadURL().then(function(imageUrl){

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

        

        console.log(REP);

        $('#dataHoraAcerto').html(REP.dataHoraAcerto);
        $('#dataHoraST').html(REP.dataHoraST);
        $('#justificativaAcerto').html(REP.justificativaAcerto);
        $('#dataHoraSTAgo').html(moment(REP.dateTimeST).fromNow());
        $('#dataHoraAcertoAgo').html(moment(REP.dataHoraAcerto,'DD/MM/YYYY HH:mm:ss').fromNow());
    })
}


var dataMarcacao =  document.getElementById('dataMarcacao');

dataMarcacao.value = moment(new Date()).format('DD/MM/YYYY');

dataMarcacao.addEventListener('blur', function(){
    
    getMarcacao();
});

getMarcacao = function(){

    var YYYYMMDD = moment($('#dataMarcacao').val(),'DD/MM/YYYY').format('YYYY-MM-DD');

    var uid = window.location.href.split("/")[window.location.href.split("/").length -1];
    
    var refEmployee = DB('rep','{{$RegFed}}'+'/'+YYYYMMDD+'/'+uid);
    refEmployee.on('value', function(REP){

        REP = REP.val();

        $("#ponto").empty();

        var REPStatus = '<tr><td> <button class="btn btn-sm ${btnESclass}">${ES}</button></td> <td><h5>${dataHoraST}</h5></td> <td><button onclick="acertoPonto(\'${CNPJ}\',\'${CPF}\',\'${uid}\',\'${dateTimeST}\')" class="btn ${btnAcertoClass}" data-toggle="modal" data-target="#acertoPontoModal">${dataHoraAcerto}</button></td> <td>${NumCad}</td> <td>${NumCra}</td> <td>${CPF}</td> <td>${PIS}</td> </tr>';

        $.each( REP, function(dia, ponto){

            if(ponto.justificativaAprovada==1){
                ponto.btnAcertoClass = 'btn-success';
            }

            ponto.dataHoraAcerto = moment(ponto.dataHoraAcerto,'DD/MM/YYYY HH:mm:ss').format('HH:mm');

            $.tmpl( REPStatus, ponto ).appendTo( "#ponto" );
        })
    })
}

getMarcacao();



</script>
@stop