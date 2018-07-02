@extends('layouts.overtsidebar')

@section('css')

<script src="{{ asset('assets/crm/js/echarts.min.js') }}"></script>
<script src="https://www.gstatic.com/firebasejs/5.0.4/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.0.4/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.0.4/firebase-database.js"></script>
<script src="{{asset('assets/hcm/js/firebase.js')}}"></script>
<script src="{{asset('assets/hcm/js/REP.js')}}"></script>
@stop

@section('content')
<div class="row"> 
    <div class="col-md-12">
        <div class="card card-nav-tabs">
          <h4 class="card-header card-header-rose">Administração de Ponto
          </h4>
          <div class="card-body">
            <div class="content table-responsive table-full-width">
                <table class="table table-striped">
                    <thead>
                        <th>Empresa</th>
                        <th>Matrícula</th>
                        <th>Crachá</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Pis</th>
                    </thead>
                    <tbody id="ponto">
                    </tbody>
                </table>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection



@section('js')
<script type="text/javascript">

access('{{$email}}','{{$pass}}');

var refEmployers = DB('employers','12345670010191');

refEmployers.on('value', function(employers) {

    employers = employers.val();

    $("#ponto").empty();

    var REPStatus = '<tr><td>${NomEmp} - ${NumCgc}</td><td>${NumCad}</td><td>${NumCra}</td><td>${NomFun}</td><td>${NumCpf}</td><td>${NumPis}</td></tr>';

    $.each( employers, function(cpf, employe){
                                                          
        $.tmpl( REPStatus, employe ).appendTo( "#ponto" );
                      
    })
}) 
</script>
@stop