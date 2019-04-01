@extends('layouts.auth')

@section('content')

<section class="auth mt-md-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-md-8 col-lg-6 mb-5">
                    <img src=" {{ asset('images/auth/login.png') }}" alt="">
                </div>
                <div class="col-12 col-md-8 col-lg-5 ml-lg-auto">
                    <div class="auth__title">Смена пароля</div>
                    <div class="auth__subtitle">Ссылка для смены пароля придет на почту</div>

                    <div class="auth__form mt-3 mt-md-4">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group custom-input">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="example@mail.ru" required>
                                <label for="email">Введите Ваш Email адрес</label>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
    
                            <div class="form-group custom-input">
                                <button type="submit" class="btn btn-md btn-blue auth__btn">
                                    Сменить пароль
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
