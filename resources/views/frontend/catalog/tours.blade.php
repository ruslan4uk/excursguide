@extends('layouts.app')

@section('content')

{{-- include header --}}
@include('partials/navigation')

<div class="container">
    <div class="row mt-5">
        <div class="col-12"><h3 class="mb-4">Экскурсии</h3></div>

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
        
        @foreach ($tours as $tour)
            <div class="col-12 col-sm-6 col-lg-3 mb-4">
                <div class="tour-item border25 block-shadow block-shadow-hover">
                    <a href="{{ route('tourIndex', $tour->id) }}">
                        @if ($tour->avatar)
                            <img src="{{ asset($tour->avatar) }}" alt="" class="border25 mb-3">
                        @else 
                            <img src="https://via.placeholder.com/400" alt="" class="border25 mb-3">
                        @endif
                    </a>
                    <a href="{{ route('tourIndex', $tour->id) }}" class="tour-item__title mb-3">{{ $tour->name }}</a>
                    
                    <div class="tour-item__footer d-flex align-items-end justify-content-between">
                        <div class="tour-item__time" data-toggle="tooltip" data-placement="top" title="Длительность экскурсии">
                            <i class="fas fa-history"></i>
                            <span>4-5 часов</span>
                        </div>
                        <div class="tour-item__price">
                            от 
                            <span>{{ $tour->price }}</span>
                            <span class="rubl"><i class="fas fa-ruble-sign"></i></span> 
                            с группы
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        @if(count($tours) == 0)
            <div class="col-12 mt-4">
                <div class="col-12 alert alert-danger border25 d-block pt-3 pb-3 text-center" role="alert">
                    В этом городе нет экскурсий! <a href="{{ route('tourAdd') }}">Создайте</a> первую экскурсию прямо сейчас
                </div>
            </div>    
        @endif

    </div>
</div>

@endsection