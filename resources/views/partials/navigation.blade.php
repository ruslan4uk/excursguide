<section class="navigation">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-4 col-md-6">
                <a href="/" class="logo mr-md-5">EG</a>
                <a href="" class="navigation__link d-none d-md-inline">О нас</a>
                <a href="" class="navigation__link d-none d-md-inline">Обратная связь</a>
            </div>
            <div class="d-flex col-8 col-md-6 ml-auto justify-content-end">
                <!-- Authentication Links -->
                @guest
                    <div class="d-none d-md-block">
                        <a href="{{ route('login') }}" class="btn btn-sm btn-blue">Вход</a>
                        <a href="{{ route('register') }}" class="btn btn-sm btn-white ml-3">Регистрация</a>
                    </div>

                    <div class="d-md-none position-relative">
                        <div class="navigation__burger" id="js--navigation-burger">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>    
                        <div class="navigation__submenu block-shadow mt-2" id="js--navigation-burger-submenu">
                            <div class="navigation__submenu-item">
                                <a href="{{ route('login') }}" class="navigation__submenu-link">Вход</a>
                            </div>
                            <div class="navigation__submenu-item">
                                <a href="{{ route('register') }}" class="navigation__submenu-link">Регистрация</a>
                            </div>
                            <hr />
                            <div class="navigation__submenu-item">
                                <a href="" class="navigation__submenu-link">О нас</a>
                            </div>
                            <div class="navigation__submenu-item">
                                <a href="" class="navigation__submenu-link">Обратная связь</a>
                            </div>
                        </div>
                    </div>                    
                @else 
                    <div class="navigation__user">
                        <div class="navigation__name d-flex justify-content-end align-items-center" id="js--navigation-user">
                            <span>{{ Auth::user()->name }}</span>
                            <div class="navigation__avatar ml-3">
                                {{-- TODO: Avatar --}}
                                @if ($uu['user_data']['avatar'])
                                    <img src="{{ asset($uu['user_data']['avatar']) }}" alt="" />
                                @else 
                                    <img src="{{ asset('images/general/avatar-blank.jpg') }}" alt="" />
                                @endif
                            </div>
                        </div>
                        <div class="navigation__submenu block-shadow mt-2" id="js--navigation-submenu">
                            <div class="navigation__submenu-item">
                                <a href="{{ route('profile.index') }}" class="navigation__submenu-link">Настройки профиля</a>
                            </div>
                            <div class="navigation__submenu-item">
                                <a href="{{ route('tourAdd') }}" class="navigation__submenu-link">Добавить экскурсию</a>
                            </div>
                            <div class="navigation__submenu-item">
                                <a href="" class="navigation__submenu-link">Мои экскурсии</a>
                            </div>
                            <div class="navigation__submenu-item">
                                <a href="" class="navigation__submenu-link js--navigation-logout">Выход</a>
                            </div>

                            <form id="js--logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</section>