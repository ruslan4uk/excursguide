@extends('layouts.app')

@section('content')

{{-- include header --}}
@include('partials/navigation')

    <section class="pages mb-5 pb-5 pt-5">
        <div class="container">
            <div class="row align-items-center flex-md-row-reverse">
                <div class="col-12 col-md-6 mb-4">
                    <img src="{{ asset('images/about/pic1.png') }}" alt="">
                </div>
                <div class="col-12 col-md-6">
                    <div class="pages__h1">
                            Исследуйте!<br/>
                            Мечтайте!<br/>
                            Открывайте!
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pages pb-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-6 mb-4">
                    <img src="{{ asset('images/about/pic2.png') }}" alt="">
                </div>
                <div class="col-12 col-md-6">
                    <div class="pages__title mb-3">Почему мы?</div>
                    <p>
                        Это очень простой вопрос! Мы знакомим вас не с гидами, передающими 
                        сухую информацию, а энтузиастами в мире туризма, великолепными 
                        рассказчиками и потрясающими путеводителями, которые откроют вам 
                        удивительный мир, наполненный приключениями.
                    </p>
                    <p>  
                        Забудьте о жесткой привязанности к графику экскурсии, корректируйте 
                        свой маршрут и находите новых друзей в лице ваших гидов.
                    </p><p>
                        И еще несколько наших особенностей за которые нас выбирают:
                    </p>
                    <ol>
                        <li>
                            Чаще всего экскурсии проводят гиды из России, что позволяет стереть 
                            языковой барьер и почувствовать себя своим даже в чужой стране
                        </li>
                        <li>
                            У большинства наших гидов малогабаритный транспорт (микроавтобусы, 
                            легковые автомобили), что позволяет путешествовать небольшой 
                            группой, и дает вам больше возможностей для личного общения с гидом
                        </li>
                        <li>
                            Ну и на десерт самое приятное — цены без накрученных процентов, 
                            что делает их значительно ниже 
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="pages pb-5 pt-md-5">
        <div class="container">
            <div class="row flex-md-row-reverse align-items-center">
                <div class="col-12 col-md-6 mb-4">
                    <img src="{{ asset('images/about/pic3.png') }}" alt="">
                </div>
                <div class="col-12 col-md-6">
                    <p>
                        Вы путешественник? Первооткрыватель? Или просто любитель съездить 
                        — отдохнуть? Мы разделяем с вами интересы, потому что нет ничего 
                        прекраснее, чем открывать перед собой неизведанные уголки нашей 
                        планеты. Поэтому мы создали ресурс, который объединяет всех, кому 
                        не чужды постоянные поиски новых мест. Мы всегда рады туристам 
                        и гидам, ведь нас всех объединяет невероятная страсть к путешествиям. 
                    </p><p>
                        Сделайте парочку кликов и окажитесь в пучине настоящих приключений! 
                        Дерзайте и поймайте ветер в свои паруса прямо сейчас!
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="peges mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-9 pb-5">
                    <hr/>
                </div>
                <div class="col-12 col-md-6 mb-3 text-center">
                    <div class="pages__quote pb-3">«Путешествие за тысячу миль <br />
                        начинается с одного шага»</div>
                    <div class="pages__quote-italic text-right pr-5">Лао-Цзы</div>
                </div>
            </div>
        </div>
    </section>

@endsection