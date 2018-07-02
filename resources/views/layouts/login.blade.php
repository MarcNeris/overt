@extends('layouts.overtsidebar')

@section('css')

@stop

@section('content')

<div class="row"> 
    <div class="col-md-12">
        <div class="card card-nav-tabs">
          <h4 class="card-header card-header-rose">
            {{ session()->get('NomFta') }} 
          </h4>
          <div class="card-body">
           <h4>{{ $exception->getMessage() }}</h4> 
          </div>
        </div>
    </div>
</div>

@endsection

@section('js')

@stop