
@extends('layouts.overtblank')

@section('content')
<div class="col-md-5 col-sm-8 ml-auto mr-auto">
  <form method="POST" action="{{ route('password.email') }}">
    <div class="card card-login">

      @csrf
      <div class="card-header card-header-rose text-center">
        <h4 class="card-title">{{ __('Recuperar a Senha') }}</h4>
      </div>

      <div class="card-body ">
        <p class="card-description text-center"></p>
       <div class="col-md-12">
          <div class="form-group bmd-form-group is-filled">
            <label for="RegFed" class="bmd-label-floating">{{ __('Informe seu email') }}</label>
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
          </div>
        </div>

        <div class="checkbox col-md-12">
        @if (session('status'))
          <p class="text-success">
              {{ session('status') }}
          </p>
        @endif
        </div>
        <div class="card-footer justify-content-center">
          <div class="button-get-started">
            <button type="submit" class="btn btn-primary">
                {{ __('Me enviar o link') }}
            </button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection