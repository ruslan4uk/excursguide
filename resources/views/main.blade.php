@extends('layouts.app')

@section('content')

{{-- include header --}}
@include('partials/navigation', ['class' => 'navigation--revers navigation--main'])

<section class="main d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-12 col-lg-6">
                <div class="main__title mb-3">Все совершенно просто!</div>
                <div class="main__subtitle">Выберите страну и начните путешествие прямо сейчас</div>
                <div class="main__search">
                    <main-search></main-search>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="main-popular mt-5 mb-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4 class="mb-5">Популярные направления</h4>
            </div>
            <a href="" class="col-12 col-md-4 col-lg-3 main-popular__link mb-2">Рим</a>
            <a href="" class="col-12 col-md-4 col-lg-3 main-popular__link mb-2">Москва</a>
            <a href="" class="col-12 col-md-4 col-lg-3 main-popular__link mb-2">Санкт - Питербург</a>
            <a href="" class="col-12 col-md-4 col-lg-3 main-popular__link mb-2">Нижний Новгород</a>
            <a href="" class="col-12 col-md-4 col-lg-3 main-popular__link mb-2">Нью - Йорк</a>
            <a href="" class="col-12 col-md-4 col-lg-3 main-popular__link mb-2">Лос Анжелес</a>
        </div>
    </div>
</section>

@endsection