
@extends('layouts.overtblank')

@section('content')
<div class="col-md-5 col-sm-8 ml-auto mr-auto">
  <form class="register-form" method="POST" action="{{ route('login') }}">
    <div class="card card-login">
      @csrf
      <div class="card-header card-header-rose text-center">
        <h4 class="card-title">Login</h4>
      </div>
      <div class="card-body ">
        <p class="card-description text-center"></p>
       <div class="col-md-12">
          <div class="form-group bmd-form-group is-filled">
            <label for="RegFed" class="bmd-label-floating">{{ __('email') }}</label>
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group bmd-form-group is-filled">
            <label for="RegFed" class="bmd-label-floating">{{ __('senha') }}</label>
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
             @if ($errors->has('password'))
              <span class="invalid-feedback">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
             @endif
          </div>
        </div>
        <div class="checkbox col-md-12">
          <label>
              <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Lembrar') }}
          </label>
        </div>
        <div class="card-footer justify-content-center">
          <div class="button-get-started">
              <a href="{{ route('password.request') }}">
              {{ __('Recuperar a Senha?') }}                                 
              </a>
              <button type="submit" class="btn btn-primary btn-fill">
                <i class="material-icons">fingerprint</i>
              {{ __('Entrar') }}
              </button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection