@extends('layouts.app')

@section('content')

{{-- include header --}}
@include('partials/navigation')

<section class="guide">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-3 pr-lg-4 mb-4 text-center text-md-left">
                <div class="guide__avatar mb-3">
                    @if ($guide->userData->avatar)
                        <img src="{{ $guide->userData->avatar }}" alt="" class="border25">
                    @else 
                        <img src="/images/general/avatar-blank.jpg" alt="" class="border25">
                    @endif
                </div>
                <div class="guide__name mb-3">
                    {{ $guide->name }}
                </div>

                
                @if ($guide->userData->languages)
                    <div class="mb-3">
                        <div class="subtitle mb-1">Владение языками</div>
                        <div class="guide__small">
                            @foreach ($guide->userData->languages as $language)
                                {{ $guide->userData->language($language) }}
                            @endforeach
                        </div>
                    </div>
                @endif
                    
                <div class="mb-3">
                    <div class="subtitle mb-1">Услуги</div>
                    <div class="guide__small">
                        {{ $guide->services()->pluck('title')->implode(', ') }}
                    </div>
                </div>

                @if ($guide->userData->locations)
                    <div class="mb-3">
                        <div class="subtitle mb-1">Города проживания</div>
                        <div class="guide__small">
                            @foreach ($guide->userData->locations as $city)
                                <div class="mb-2">
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{ $guide->userData->get_city_name($city) }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif                

                @if ($guide->userData->contacts)
                    <div class="mb-3">
                        <div class="subtitle mb-1">Контакты</div>
                        <div class="guide__small">
                            @foreach ($guide->userData->contacts as $contact)
                                <div class="mb-1">
                                    {!! $guide->userData->contact_type($contact->type_id) !!}
                                    <span class="ml-2">{{ $contact->value }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>

            {{-- Right coll --}}
            <div class="col-12 col-lg-9">
                
                <div class="card block-shadow border25 mb-3">
                    <div class="card-body">

                        <div class="guide__about mb-4">
                            <div class="title mb-2">Обо мне</div>
                            <div class="guide__small">
                                {!! $guide->userData->about !!}
                            </div>
                        </div>
                        
                        <div class="guide__tours">
                            <div class="title mb-3">Экскурсии</div>
                            <div class="row">
                                @foreach ($guide->userTour as $tour)
                                    <div class="col-12 col-sm-6 col-lg-4 mb-4">
                                        <div class="border25">
                                            <a href="{{ route('tourIndex', $tour->id) }}">
                                                @if ($tour->avatar)
                                                    <img src="{{ asset($tour->avatar) }}" alt="" class="border25 mb-3">
                                                @else 
                                                    <img src="/images/general/blank.png" alt="" class="border25 mb-3">
                                                @endif
                                            </a>
                                            <a href="{{ route('tourIndex', $tour->id) }}" class="subtitle d-block mb-2">{{ $tour->name }}</a>
                                            
                                            <div class="d-block">
                                                <div class="tour-item__time mb-2" data-toggle="tooltip" data-placement="top" title="Длительность экскурсии">
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
                                @if (count($guide->userTour) == 0)
                                    <div class="col-12">
                                        <div class="alert alert-info">
                                            У гида еще нет экскурсий
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Comment --}}
                <div class="card block-shadow border25 mb-3">
                    <div class="card-body">
                        <div class="title mb-3">Комментарии</div>

                        <div class="guide__comments">
                            @if (count($comments) > 0)
                                @foreach ($comments as $comment)
                                    <div class="row mb-4 pb-4 guide__comments-item">
                                        <div class="col-4 col-md-2">
                                            @if ($comment->userData->avatar)
                                                <a href="{{ route('guideIndex', $comment->userData->user_id) }}">
                                                    <img src="{{ asset($comment->userData->avatar) }}" alt="" class="border25 mb-3 mb-md-0">
                                                </a>
                                            @else 
                                                <a href="{{ route('guideIndex', $comment->userData->user_id) }}">
                                                    <img src="https://via.placeholder.com/400" alt="" class="border25 mb-3 mb-md-0">
                                                </a>
                                            @endif
                                        </div>
                                        <div class="col-12 col-md-10">
                                            <a href="{{ route('guideIndex', $comment->userData->user_id) }}">
                                                <div class="title">{{$comment->user->name}}</div>
                                            </a>
                                            <div class="guide__small">
                                                {{$comment->text}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else 
                                <div class="alert alert-info mb-3">
                                    Гида пока никто не прокоментировал, сделайте это первыми
                                </div>
                            @endif
                        </div>
                        
                        <div class="guide__comment">
                            <form action="{{ route('addComment', $guide->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <textarea name="comment" id="" rows="5" class="form-control border25 {{$errors->has('comment') ? ' is-invalid' : ''}}">{{ old('comment') }}</textarea>
                                </div>
                                @if ($errors->has('comment'))
                                    <span class="invalid-feedback invalid-feedback--normal mb-2 d-block" role="alert">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                @endif
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-blue">Отправить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>
</section>

@endsection