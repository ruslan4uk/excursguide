@extends('layouts.auth')

@section('content')

<section class="auth mt-md-5">
    <div class="container">
        <div class="row align-items-center justify-content-center justify-content-lg-between">
            <div class="col-12 col-md-8 col-lg-6 mb-5">
                <img src=" {{ asset('images/auth/login.png') }}" alt="">
            </div>
            <div class="col-12 col-md-8 col-lg-5 ml-lg-auto">
                <div class="auth__title">Сброс пароля</div>
                <div class="auth__subtitle">Придумайте новый пароль</div>

                <div class="auth__form mt-3 mt-md-4">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group custom-input">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" placeholder="example@mail.ru" required autofocus>
                            <label for="email">Ваш Email</label>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group custom-input">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="********" required>
                            <label for="password">Новый пароль</label>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group custom-input">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="********" required>
                            <label for="password-confirm">Повторите пароль</label>
                        </div>

                        <div class="form-group custom-input">
                            <button type="submit" class="btn btn-md btn-blue auth__btn">
                                Сбросить пароль
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
