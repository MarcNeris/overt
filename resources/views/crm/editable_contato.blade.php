@extends('adminlte::page')

@section('title', 'CRM | Contatos')

@section('css')
    <link href="{{ asset('assets/css/responsive.bootstrap.min.csss') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/dataTables.bootstrap.min.csss') }}" rel="stylesheet">
@stop

@section('content')
<div class="col-xs-12">
	<div class="box box-primary">
		<div class="box-header">
		    <table  id="exemplo" class="table table-striped table-bordered table-hover display" cellspacing="0" width="100%">
		    </table>
    	</div>
    </div>
</div>
@stop
@section('js')
<script>

function faturamento(Id_Rub) {	
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "getRowDetailsData",
        type: 'GET',
        success: function() {
            var table = $('#exemplo').DataTable( {
             retrieve: true,
            } );
            table.ajax.reload( null, false );
        }
    });
}

function compra(Id_Rub) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{url('nfi/t000rub/')}}/"+Id_Rub+"/compra",
        type: 'GET',
        success: function() {
            var table = $('#exemplo').DataTable( {
             retrieve: true,
            } );
            table.ajax.reload( null, false );
        }
    });
}

function imposto(Id_Rub) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "getRowDetailsData",
        type: 'GET',
        success: function() {
            var table = $('#exemplo').DataTable( {
             retrieve: true,
            } );
            table.ajax.reload( null, false );
        }
    });
}


function inativar(Id_Rub) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "getRowDetailsData",
        type: 'GET',
        success: function() {
            var table = $('#exemplo').DataTable( {
             retrieve: true,
            } );
            table.ajax.reload( null, false );
        }
    });
}
    
    
    
$(document).ready(function () {

    var table = $('#exemplo').DataTable({
        "aaSorting": [[0, "asc"]],
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "ajax": "getRowDetailsData",

        "columns": [
			{data: 'nome_contato', title: 'Nome do Contato'},
			{data: 'sobrenome', title: 'Sobrenome'},
			{data: 'telefone', title: 'Telefone Celular'},
			{data: 'email_pessoal', title: 'Email Pessoal'},
			{data: 'created_at', title: 'Criado Em'},
			{data: null,
			title: 'Editar',
			className: "center",
			orderable: false,
			searchable: false,
			"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
			    $(nTd).html("<div id='actions'>\n\
			         <a onclick='faturamento("+oData.Id+")' href='editar'><i class='fa fa-dollar   fa-fw'></i></a>\n\
			         <a onclick='compra("+oData.Id_Rub+")' href='#'><i class='fa fa-shopping-cart fa-fw'></i></a>\n\
			         <a onclick='imposto("+oData.Id_Rub+")' href='#'><i class='fa fa-institution fa-fw'></i></a>\n\
			         <a onclick='inativar("+oData.Id_Rub+")' href='#'><i class='fa fa-times fa-fw'></i></a></div>")
                }
            }
        ],
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
    });
});
    
    
    
</script>
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.bootstrap.min.jsss') }}"></script>
<script src="{{ asset('assets/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/js/responsive.bootstrap.min.jsss') }}"></script>
@endsection