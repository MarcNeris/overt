@extends('layouts.overtblank')

@section('content')
<div class="col-md-5 col-sm-8 ml-auto mr-auto">
  <form method="POST" action="{{ route('password.request') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="card card-login">

      <div class="card-header card-header-rose text-center">
        <h4 class="card-title">{{ __('Recuperar a Senha') }}</h4>
      </div>
      <div class="card-body ">
        <p class="card-description text-center"></p>

       <div class="col-md-12">
          <div class="form-group bmd-form-group is-filled">
            <label for="email" class="bmd-label-floating">{{ __('E-Mail') }}</label>
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email or old('email') }}" required autofocus>

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
            <input id="password-confirm" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required>

            @if ($errors->has('password_confirmation'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
          </div>
        </div>



        <div class="checkbox col-md-12">

        </div>
        <div class="card-footer justify-content-center">
          <div class="button-get-started">
          	    <button type="submit" class="btn btn-primary">
                    {{ __('Recuperar a Senha') }}
                </button>

          </div>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection