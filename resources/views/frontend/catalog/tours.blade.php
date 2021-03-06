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
                    <a href="{{ route('catalogTours', $id) }}" class="subnavigation__item border25 {{ (Route::current()->getName() == 'catalogTours' || Route::current()->getName() == 'catalogCategory') ? 'is-active' : 'null' }}">Экскурсии</a>
                    <a href="{{ route('catalogGuides', $id) }}" class="subnavigation__item border25 {{ (Route::current()->getName() == 'catalogGuides') ? 'is-active' : 'null' }}">Гиды</a>
                    <a href="" class="subnavigation__item border25 {{ (Route::current()->getName() == '') ? 'is-active' : 'null' }}">Достопримечательности</a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Категории --}}
<div class="mt-2 mb-5">
    <div class="container">
        <div class="tour-category border25 py-5 px-5">
            <div class="row">
                <div class="col-12 mb-3"><div class="tour-category__title">Категории экскурсий</div></div>
                @foreach ($categories as $category)
                    <div class="col-12 col-md-6 col-lg-3">
                        <a href="{{ route('catalogCategory', ['id' => $id, 'category' => $category->id]) }}" class="tour-category__link mb-1">{{ $category->title }}</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">        
        @foreach ($tours as $tour)
            <div class="col-12 col-sm-6 col-lg-3 mb-4">
                <div class="tour-item border25 block-shadow block-shadow-hover">
                    <a href="{{ route('tourIndex', $tour->id) }}">
                        @if ($tour->avatar)
                            <img src="{{ asset($tour->avatar) }}" alt="" class="border25 mb-3">
                        @else 
                            <img src="/images/general/blank.png" alt="" class="border25 mb-3">
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
                            <span class="rubl">
                                @switch($tour->currency)
                                    @case(643)
                                        <i class="fas fa-ruble-sign"></i>
                                        @break
                                    @case(840)
                                        <i class="fas fa-dollar-sign"></i>
                                        @break
                                    @case(978)
                                        <i class="fas fa-euro-sign"></i>
                                        @break
                                    @default
                                        
                                @endswitch
                            </span> 
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