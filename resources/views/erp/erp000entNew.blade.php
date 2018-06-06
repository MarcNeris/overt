@extends('adminlte::page')

@section('content_header')

<ol class="breadcrumb">
	<li><a href=""></a>{{ Auth::user()->name }}</li>
	<li><a href=""></a>Dashboard</li>
</ol>
@stop

@section('content')
<div class="col-md-6">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">ERP | Nova Entidade</h3>
		</div>
		
		<form role="form" method="POST" action="{{ route('erp000ent') }}">
			<div class="box-body">
				{!! csrf_field() !!}
				<div class="form-group">
					<input type="text" class="form-control input-lg" name="nome_entidade" value="{{ old('nome_entidade') }}" placeholder="Nome da Entidade">
					<span class="text-red">
	                    <strong>{{ $errors->first('nome_entidade') }}</strong>
	                </span>
				</div>

				<div class="form-group">
					<input type="text" class="form-control input-lg" name="nome_fantasia" value="{{ old('nome_fantasia') }}" placeholder="Nome Fantasia">
					<span class="text-red">
	                    <strong>{{ $errors->first('nome_fantasia') }}</strong>
	                </span>
				</div>


				<div class="form-group">
					<input type="text" class="form-control input-lg" name="natureza_juridica" value="{{ old('natureza_juridica') }}" placeholder="Natureza Jurídica">
	                <span class="text-red">
	                    <strong>{{ $errors->first('natureza_juridica') }}</strong>
	                </span>
				</div>
				
				@include('layouts.alert')
				<div class="box-footer">
					
				</div>
				<button type="submit" class="btn btn-primary btn-lg pull-right">Salvar</button>
			</div>
		</form>
	</div>
</div>
@stop