@extends('layouts.overtblank')

@section('content')
<div class="col-md-5 col-sm-8 ml-auto mr-auto">
  <form class="register-form" method="POST" action="{{ route('register') }}">
    <div class="card card-login">
      @csrf
      <div class="card-header card-header-rose text-center">
        <h4 class="card-title">Registrar um novo Membro</h4>
      </div>
      <div class="card-body ">
        <p class="card-description text-center"></p>
       <div class="col-md-12">
          <div class="form-group bmd-form-group is-filled">
            <label for="RegFed" class="bmd-label-floating">{{ __('Nome completo') }}</label>
            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
            @if ($errors->has('name'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group bmd-form-group is-filled">
            <label for="RegFed" class="bmd-label-floating">{{ __('Endereço de e-mail') }}</label>
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group bmd-form-group is-filled">
            <label for="RegFed" class="bmd-label-floating">{{ __('Senha') }}</label>
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
          </div>
        </div>


        <div class="col-md-12">
          <div class="form-group bmd-form-group is-filled">
            <label for="RegFed" class="bmd-label-floating">{{ __('Confirme a Senha') }}</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
          </div>
        </div>



        <div class="checkbox col-md-12">

        </div>
        <div class="card-footer justify-content-center">
          <div class="button-get-started">

              <button type="submit" class="btn btn-white btn-fill btn-lg">
                    {{ __('Registrar') }}
              </button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection