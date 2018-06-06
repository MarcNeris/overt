@if ($errors->any())
<div class="alert alert-warning" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    @foreach ($errors->all() as $error)
        <p>{{$error}}</p>
    @endforeach
</div>
@endif

@if (session('success'))
<div class="alert alert-success alert-dismissible">
    <p>{{ session('success') }}</p>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger alert-dismissible">
    <p>{{ session('error') }}</p>
</div>
@endif