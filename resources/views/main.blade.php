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

@endsection