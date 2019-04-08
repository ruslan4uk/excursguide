@extends('layouts.app')

@section('content')

{{-- include header --}}
@include('partials/navigation')

<div class="container">
    <div class="row mt-5">
        <div class="col-12"><h3 class="mb-4">Гиды</h3></div>

        {{-- Плашка переключатель --}}
        <div class="col-12 mb-4">
            <div class="subnavigation border25">
                <div class="subnavigation__list d-flex">
                    <a href="{{ route('catalogTours', $id) }}" class="subnavigation__item border25 {{ (Route::current()->getName() == 'catalogTours') ? 'is-active' : 'null' }}">Экскурсии</a>
                    <a href="{{ route('catalogGuides', $id) }}" class="subnavigation__item border25 {{ (Route::current()->getName() == 'catalogGuides') ? 'is-active' : 'null' }}">Гиды</a>
                    <a href="" class="subnavigation__item border25 {{ (Route::current()->getName() == '') ? 'is-active' : 'null' }}">Достопримечательности</a>
                </div>
            </div>
        </div>
        
        @foreach ($guides as $guide)
            <div class="col-12 mb-3 mt-1">
                <div class="row">
                    <div class="col-2">
                        <a href="{{ route('guideIndex', $guide->id) }}">
                            @if ($guide->userData->avatar)
                                <img src="{{ asset($guide->userData->avatar) }}" alt="" class="border25 mb-3">
                            @else 
                                <img src="https://via.placeholder.com/400" alt="" class="border25 mb-3">
                            @endif
                        </a>
                    </div>
                    <div class="col-10">
                        <div class="guide-item border25">
                            <a href="{{ route('guideIndex', $guide->id) }}" class="guide-item__name mb-2">{{ $guide->name }}</a>
                            <div class="guide-item__count-tour mb-2">{{ count($guide->activeTours) }} {{ Lang::choice('экскурсия|экскурсии|экскурсий', count($guide->activeTours), [], 'ru') }}</div>
                            <div class="guide-item__about">{{ substr($guide->userData->about, 0, 100) }}</div>
                            <div class="d-flex justify-content-end align-item-center">
                                <a href="{{ route('guideIndex', $guide->id) }}" class="guide-item__more">Подробнее <i class="fas fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        @if(count($guides) == 0)
            <div class="col-12 mt-4">
                <div class="col-12 alert alert-danger border25 d-block pt-3 pb-3 text-center" role="alert">
                    В этом городе нет гидов! <a href="{{ route('tourAdd') }}">Зарегистрируйтесь</a> и станьте первым прямо сейчас
                </div>
            </div>    
        @endif

    </div>
</div>

@endsection