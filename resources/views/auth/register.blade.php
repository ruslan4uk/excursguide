@extends('layouts.auth')

@section('content')

<section class="auth mt-md-5">
    <div class="container">
        <div class="row align-items-center justify-content-center justify-content-lg-between">
            <div class="col-12 col-md-8 col-lg-6 mb-5">
                <img src="{{ asset('images/auth/register.png') }}" alt="">
            </div>
            <div class="col-12 col-md-8 col-lg-5 ml-lg-auto">
                <div class="auth__title">Сделайте первый шаг!</div>
                <div class="auth__subtitle">И откройте много нового с сервисом</div>
                <div class="auth__form mt-3 mt-md-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group custom-input">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Иван Иванов" required autofocus>
                            <label for="name">Введите Ваше ФИО</label>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group custom-input">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required>
                            <label for="email">Введите Ваш E-mail</label>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group custom-input">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="********" required>
                            <label for="password">Придумайте пароль</label>
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

                        <div class="form-group custom-checkbox mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    Согласие на обработку персональных данных
                                </label>
                            </div>
                        </div>

                        <div class="form-group custom-input">
                            <button type="submit" class="btn btn-md btn-blue auth__btn">
                                Начинаем!
                            </button>
                        </div>
                    </form>
                </div>
                {{-- Social auth btn --}}
                <div class="auth__social d-flex align-items-center">
                    <span>Вы также можете войти через</span>
                    <div class="auth__social-list ml-4">
                        <a href="" class="auth__social-item"><img src="images/general/vk.png" alt="" /></a>
                        <a href="" class="auth__social-item"><img src="images/general/ok.png" alt="" /></a>
                        <a href="" class="auth__social-item"><img src="images/general/fb.png" alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
