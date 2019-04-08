@extends('layouts.auth')

@section('content')

<section class="auth mt-md-5">
    <div class="container">
        <div class="row align-items-center justify-content-center justify-content-lg-between">
            <div class="col-12 col-md-8 col-lg-6 mb-5">
                <img src="{{ asset('images/auth/login.png') }}" alt="">
            </div>
            <div class="col-12 col-md-8 col-lg-5 ml-lg-auto">
                <div class="auth__title">Поехали!</div>
                <div class="auth__subtitle">Мы рады Вашему возвращению</div>
                <div class="auth__form mt-3 mt-md-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group custom-input">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="example@mail.ru" required autofocus>
                            <label for="email">Введите Email</label>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group custom-input mb-0">                            
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="********" required>
                            <label for="password">Пароль</label>
                            <div class="d-flex justify-content-end mt-1 mb-0">
                                @if (Route::has('password.request'))
                                    <a class="auth__forgot-password" href="{{ route('password.request') }}">
                                        Забыли пароль
                                    </a>
                                @endif
                            </div>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group custom-checkbox mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    Запомнить меня
                                </label>
                            </div>
                        </div>

                        <div class="form-group custom-input">
                            <button type="submit" class="btn btn-md btn-blue auth__btn">
                                Ок!
                            </button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
