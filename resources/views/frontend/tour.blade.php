@extends('layouts.app')

@section('content')

{{-- include header --}}
@include('partials/navigation')

<section class="tour">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-3 tour__left pr-lg-4 mb-4">
                <div class="tour__guide border25 py-4 mb-3">
                    <div class="title mb-3">Гид</div>
                    <div class="d-flex align-items-center mb-4">
                        <div class="tour__guide-avatar mr-3">
                            @if ($tour->userData->avatar)
                                <img src="{{ asset($tour->userData->avatar) }}" alt="" class="border25">
                            @else 
                                <img src="https://via.placeholder.com/400" alt="" class="border25">
                            @endif
                        </div>
                        <div class="tour__guide-name">{{ $tour->user->name }}</div>
                    </div>

                    <div class="d-block mb-3">
                        <div class="subtitle mb-2">Услуги:</div>
                        <div class="tour__services">
                            {{ $tour->user->services()->pluck('title')->implode(', ') }}
                        </div>
                    </div>

                    @if ($tour->userData->contacts)
                    <div class="tour__contact">
                        <div class="subtitle mb-2">Контакты:</div>
                        @foreach ($tour->userData->contacts as $contact)
                            <div class="tour__contact-item mb-1">
                                {!! $tour->userData->contact_type($contact->type_id) !!}
                                <span class="ml-2">{{ $contact->value }}</span>
                            </div>
                        @endforeach
                    </div>
                    @endif

                </div>

                @if($tour->services)
                    <div class="d-block tour__small mb-3">
                        <p class="mb-1"><strong>Услуги:</strong></p>
                        <p>{{ $tour->services }}</p>
                    </div>
                @endif

                @if($tour->services)
                    <div class="d-block tour__small mb-3">
                        <p class="mb-1"><strong>Дополнительные расходы:</strong></p>
                        <p>{{ $tour->other_rate }}</p>
                    </div>
                @endif

                @if($tour->services)
                    <div class="d-block tour__small mb-3">
                        <p class="mb-1"><strong>Что с собой взять:</strong></p>
                        <p>{{ $tour->other_item }}</p>
                    </div>
                @endif
            </div>

            {{-- Right coll --}}
            <div class="col-12 col-lg-9 tour__right">
                <div class="tour__title mb-3">{{ $tour->name }}</div>
                {{-- Photo gallery --}}
                @if ($tour->photo)
                    <div class="tour__slider">
                        <div class="owl-carousel">
                            @foreach ($tour->photo as $photo)
                                <div><img src="{{ $photo->crop }}" class="border25" /></div>
                            @endforeach
                        </div>
                    </div>
                @endif
                
                <div class="tour__card">
                    <div class="card block-shadow border25">
                        <div class="card-body">
    
                            <div class="row mb-4">
                                <div class="col tour__about-item">
                                    <div class="tour__about-icon mb-1">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    {{ $tour->userData->get_city_name($tour->location) }}
                                </div>
                                <div class="col tour__about-item">
                                    <div class="tour__about-icon mb-1">
                                        <i class="fas fa-history"></i>
                                    </div>
                                    4 - 5 часов
                                </div>
                                <div class="col tour__about-item">
                                    <div class="tour__about-icon mb-1">
                                        <i class="fas fa-user-friends"></i>
                                    </div>
                                    {{ $tour->people_count }} человек
                                </div>
                                <div class="col tour__about-item">
                                    <div class="tour__about-icon mb-1">
                                        <i class="far fa-money-bill-alt"></i>
                                    </div>
                                    {{ $tour->price }} {{ $tour->userData->currency($tour->currency) }}
                                </div>
                            </div>
    
                            <hr />
        
                            <div class="tour__about">
                                <div class="subtitle mb-3">Описание экскурсии</div>
                                {!! nl2br(e($tour->about)) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection