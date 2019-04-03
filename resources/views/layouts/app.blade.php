<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>ExcursGuide</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">        
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div id="app">
    {{-- include header --}}
    @include('partials/navigation')

    <div class="container">
        <div class="row">
            @foreach (array(1,2,3,4,5) as $item)
                
            <div class="col-12 col-sm-6 col-lg-3 mb-4">
                <div class="tour-item border25 block-shadow block-shadow-hover">
                    <a href=""><img src="https://via.placeholder.com/400" alt="" class="border25 mb-3"></a>
                    <a href="" class="tour-item__title mb-3">Музей Ватикана</a>
                    <a href="" class="tour-item__guide mb-3">
                        <div class="tour-item__avatar mr-2">
                            <img src="https://via.placeholder.com/150" alt="" class="border25">
                        </div>
                        <div class="tour-item__name">Руслан Сафин</div>
                    </a>
                    <div class="tour-item__footer d-flex align-items-end justify-content-between">
                        <div class="tour-item__time" data-toggle="tooltip" data-placement="top" title="Длительность экскурсии">
                            <i class="fas fa-history"></i>
                            <span>4-5 часов</span>
                        </div>
                        <div class="tour-item__price">
                            от 
                            <span>250</span>
                            <span class="rubl"><i class="fas fa-ruble-sign"></i></span> 
                            с группы
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
    </div>

    {{-- include footer --}}
    @include('partials/footer')

</div>

@include('partials/scripts')
</body>
</html>