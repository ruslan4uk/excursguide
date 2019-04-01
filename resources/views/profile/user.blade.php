@extends('layouts.profile')

@section('content')

<section class="profile mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-3 mb-4 mb-lg-0">
                <div class="profile__user d-flex align-items-center">
                    <div class="profile__avatar mr-3">
                        @if (Auth::user()->avatar)
                            <img src="" alt="" />
                        @else 
                            <img src="{{ asset('images/general/avatar-blank.jpg') }}" alt="" />
                        @endif
                    </div>
                    <div class="profile__username">{{ Auth::user()->name }}</div>
                </div>
                <a href="" class="profile__avatar-upload">Добавить фото</a>
            </div>
            <div class="col-12 col-lg-9">
                @if (session('status'))
                    <div class="alert alert-success mb-4">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('profile.store') }}" class="js--form">
                    @csrf
                    {{-- General information --}}
                    <div class="card block-shadow border25 mb-4">
                        <div class="card-body">
                            <div class="card-title mb-4">Основная информация</div>

                            <div class="form-group custom-input">
                                <input type="text" name="name" id="user_name" 
                                        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                                        value="{{ old('name') ? old('name') : Auth::user()->name }}"
                                        placeholder="Иванов Иван">
                                <label for="user_name">Введите Ваше ФИО или название компании</label>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="card-subtitle mb-3">Ваше местоположение</div>
                            <div class="form-row">
                                <div class="col js--location-wrap">
                                        
                                    @if ($user->userData->locations)
                                        @foreach ($user->userData->locations as $location)
                                            <div class="custom-input mb-3 js--location-row">
                                                <input type="text" class="form-control" name="locations[]" id="locations" value="{{ $location }}" placeholder=" ">
                                                <label for="locations">Город проживания</label>
                                            </div>
                                        @endforeach
                                    @else 
                                        <div class="custom-input mb-3 js--location-row">
                                            <input type="text" class="form-control" name="locations[]" id="locations" placeholder=" ">
                                            <label for="locations">Город проживания</label>
                                        </div>
                                    @endif
                                    
                                    <span class="invalid-feedback d-none" role="alert">
                                        <strong>Нельзя добавить больше 3х мест проживания</strong>
                                    </span>
                                </div>
                                <div class="col-auto">
                                    <div class="custom-input">
                                        <div class="btn btn-sm btn-small btn-blue js--location-add">Добавить</div>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="card-subtitle">Контакты</div>
                        </div>
                    </div>

                    {{-- About user --}}
                    <div class="card block-shadow border25 mb-4">
                        <div class="card-body">
                            <div class="card-title mb-0">Расскажите туристам о себе</div>
                            <div class="card-title-small mb-3">Это позволит привлечь больше внимания к Вам</div>
                            <div class="form-group custom-input">
                                <textarea name="about" id="userdata_about" cols="30" rows="10" 
                                          class="form-control{{ $errors->has('about') ? ' is-invalid' : '' }}">{{ old('about') ? old('about') : $user->userData->about }}</textarea>
                                
                                @if ($errors->has('about'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('about') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                        </div>
                    </div>

                    <div class="form-group custom-input d-flex justify-content-center">
                        <button type="submit" class="btn btn-sm btn-blue">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection