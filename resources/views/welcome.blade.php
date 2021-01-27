@extends('layouts.guest')
@section('content')
    <div class="main-slider">
        <div>
            <div class="main-slider__inner-block">
                <h1>Обучение, инвестирование, соправождение</h1>
                <p>Повышение финансовой грамотности является целью каждого преуспевающего человека</p>
                <a href="#">Подробнее</a>
            </div>
            <img src="{{asset('images/slides/image.png')}}" alt="">
        </div>
        <div>
            <div class="main-slider__inner-block">
                <h1>Обучение, инвестирование, соправождение</h1>
                <p>Повышение финансовой грамотности является целью каждого преуспевающего человека</p>
                <a href="#">Подробнее</a>
            </div>
            <img src="{{asset('images/slides/image.png')}}" alt="">
        </div>
        <div>
            <div class="main-slider__inner-block">
                <h1>Обучение, инвестирование, соправождение</h1>
                <p>Повышение финансовой грамотности является целью каждого преуспевающего человека</p>
                <a href="#">Подробнее</a>
            </div>
            <img src="{{asset('images/slides/image.png')}}" alt="">
        </div>
    </div>

    <div id="test">
        <div class="inner">
            <div>
                <p>Пройди тест и определи свою финансовою стратегию!</p>
                <a href="#">Пройти тест</a>
            </div>
            <div>
                <p>Пройди тест и определи свою финансовою стратегию!</p>
                <a href="#">Пройти диагностику</a>
            </div>
        </div>
    </div>

    <div class="community">
        <div class="community__inner">
            <div class="community__blog">
                <div class="community__blog__title">
                    <h1>Повышение финансовой грамотности является целью каждого преуспевающего человека</h1>
                </div>
                <div class="community__blog__main">
                    <h1>Сообщество</h1>
                    <img src="/images/community-blog-img.png" alt="">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the industry's standard dummy text ever.</p>
                </div>
            </div>
            <div class="community__blog-slider">
                <div class="community__blog-slider__for">
                    <div>
                        <img src="/images/slides/community-slider-img1.png" alt="">
                    </div>
                    <div>
                        <img src="/images/slides/community-slider-img2.png" alt="">
                    </div>
                    <div>
                        <img src="/images/slides/community-slider-img3.png" alt="">
                    </div>
                    <div>
                        <img src="/images/slides/community-slider-img2.png" alt="">
                    </div>
                </div>
                <div class="community__blog-slider__nav">
                    <div>
                        <img src="/images/slides/community-slider-img1-mini.png" alt="">
                    </div>
                    <div>
                        <img src="/images/slides/community-slider-img2-mini.png" alt="">
                    </div>
                    <div>
                        <img src="/images/slides/community-slider-img3-mini.png" alt="">
                    </div>
                    <div>
                        <img src="/images/slides/community-slider-img2-mini.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="about">
        <div class="wrapper">
            <div class="inner">
                <h1>О компании</h1>
                <p>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Totam, repellat iste in veniam minima
                    sequi molestiae, rerum aspernatur, consequatur ducimus necessitatibus ab blanditiis repellendus
                    excepturi, porro! Aliquam maxime officia eligendi?
                    Reiciendis molestias assumenda deserunt in labore quod vitae alias vero animi nihil illum dolor,
                    dolorum aliquid enim, rerum, totam? Accusamus nemo deleniti cum repudiandae ullam esse nesciunt
                    provident amet sunt! Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum, explicabo
                    veritatis mollitia in laboriosam numquam iste adipisci praesentium, hic magnam molestiae cupiditate
                    saepe, vitae voluptate debitis accusantium iure ea vel. Lorem ipsum dolor, sit amet consectetur
                    adipisicing elit. Dolores amet, numquam, tempora ipsa ea autem magni sequi ad quod libero placeat
                    vitae rem qui velit saepe. Culpa repellat cum nesciunt?
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Totam, repellat iste in veniam minima
                    sequi molestiae, rerum aspernatur, consequatur ducimus necessitatibus ab blanditiis repellendus
                    excepturi, porro! Aliquam maxime officia eligendi?
                    Reiciendis molestias assumenda deserunt in labore quod vitae alias vero animi nihil illum dolor,
                    dolorum aliquid enim, rerum, totam? Accusamus nemo deleniti cum repudiandae ullam esse nesciunt
                    provident amet sunt! Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum, explicabo
                    veritatis mollitia in laboriosam numquam iste adipisci praesentium, hic magnam molestiae cupiditate
                    saepe, vitae voluptate debitis accusantium iure ea vel. Lorem ipsum dolor, sit amet consectetur
                    adipisicing elit. Dolores amet, numquam, tempora ipsa ea autem magni sequi ad quod libero placeat
                    vitae rem qui velit saepe. Culpa repellat cum nesciunt?
                </p>
            </div>
        </div>
    </div>

    <div class="founder">
        <div class="founder__inner">
            <div class="founder__main">
                <h1>Об основателе</h1>
                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type
                    and scrambled it to make a type specimen book. It has survived not only five centuries, but also the
                    leap into electronic typesetting, remaining essentially unchanged.
                    <br><br>
                    It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                    and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem
                    Ipsum.
                </p>
                <div class="founder__slider">
                    <div>
                        <img src="{{asset('images/slides/founder-slider-img1.png')}}" alt="">
                    </div>
                    <div>
                        <img src="{{asset('images/slides/founder-slider-img2.jpeg')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="academy">
        <div class="academy__inner">
            <div class="academy__inner__1" id="academy__inner__1">
                <h1>SAPA Academy</h1>
                <div class="academy__slider1">
                    <div>
                        <img src="{{asset('images/icons/academy-slider-img1.png')}}" alt="">
                        <h1>Финансовая диагностика</h1>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever.
                        </p>
                        <a href="#">Подробнее о курсе</a>
                    </div>
                    <div>
                        <img src="{{asset('images/icons/academy-slider-img1.png')}}" alt="">
                        <h1>Курсы, тренинги</h1>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever.
                        </p>
                        <a href="#">Подробнее о курсе</a>
                    </div>
                    <div>
                        <img src="{{asset('images/icons/academy-slider-img3.png')}}" alt="">
                        <h1>Составление ЛФП</h1>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever.
                        </p>
                        <a href="#">Подробнее о курсе</a>
                    </div>
                    <div>
                        <img src="{{asset('images/icons/academy-slider-img3.png')}}" alt="">
                        <h1>Курсы, тренинги</h1>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever.
                        </p>
                        <a href="#">Подробнее о курсе</a>
                    </div>
                    <div>
                        <img src="{{asset('images/icons/academy-slider-img3.png')}}" alt="">
                        <h1>Составление ЛФП</h1>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever.
                        </p>
                        <a href="#">Подробнее о курсе</a>
                    </div>
                    <div>
                        <img src="{{asset('images/icons/academy-slider-img1.png')}}" alt="">
                        <h1>Финансовая диагностика</h1>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever.
                        </p>
                        <a href="#">Подробнее о курсе</a>
                    </div>
                    <div>
                        <img src="{{asset('images/icons/academy-slider-img1.png')}}" alt="">
                        <h1>Финансовая диагностика</h1>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever.
                        </p>
                        <a href="#">Подробнее о курсе</a>
                    </div>
                    <div>
                        <img src="{{asset('images/icons/academy-slider-img2.png')}}" alt="">
                        <h1>Курсы, тренинги</h1>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever.
                        </p>
                        <a href="#">Подробнее о курсе</a>
                    </div>
                    <div>
                        <img src="{{asset('images/icons/academy-slider-img3.png')}}" alt="">
                        <h1>Составление ЛФП</h1>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever.
                        </p>
                        <a href="#">Подробнее о курсе</a>
                    </div>
                </div>
            </div>
            <div class="academy__inner__2" id="academy__inner__2">
                <h1>SAPA Market</h1>
                <div class="academy__slider2">
                    <div>
                        <img src="{{asset('images/icons/academy-slider-img1.png')}}" alt="">
                        <h1>Финансовая диагностика</h1>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever.
                        </p>
                        <a href="#">Подробнее о курсе</a>
                    </div>
                    <div>
                        <img src="{{asset('images/icons/academy-slider-img2.png')}}" alt="">
                        <h1>Курсы, тренинги</h1>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever.
                        </p>
                        <a href="#">Подробнее о курсе</a>
                    </div>
                    <div>
                        <img src="{{asset('images/icons/academy-slider-img3.png')}}" alt="">
                        <h1>Составление ЛФП</h1>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever.
                        </p>
                        <a href="#">Подробнее о курсе</a>
                    </div>
                    <div>
                        <img src="{{asset('images/icons/academy-slider-img2.png')}}" alt="">
                        <h1>Курсы, тренинги</h1>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever.
                        </p>
                        <a href="#">Подробнее о курсе</a>
                    </div>
                    <div>
                        <img src="{{asset('images/icons/academy-slider-img3.png')}}" alt="">
                        <h1>Составление ЛФП</h1>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever.
                        </p>
                        <a href="#">Подробнее о курсе</a>
                    </div>
                    <div>
                        <img src="{{asset('images/icons/academy-slider-img1.png')}}" alt="">
                        <h1>Финансовая диагностика</h1>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever.
                        </p>
                        <a href="#">Подробнее о курсе</a>
                    </div>
                    <div>
                        <img src="{{asset('images/icons/academy-slider-img1.png')}}" alt="">
                        <h1>Финансовая диагностика</h1>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever.
                        </p>
                        <a href="#">Подробнее о курсе</a>
                    </div>
                    <div>
                        <img src="{{asset('images/icons/academy-slider-img2.png')}}" alt="">
                        <h1>Курсы, тренинги</h1>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever.
                        </p>
                        <a href="#">Подробнее о курсе</a>
                    </div>
                    <div>
                        <img src="{{asset('images/icons/academy-slider-img3.png')}}" alt="">
                        <h1>Составление ЛФП</h1>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever.
                        </p>
                        <a href="#">Подробнее о курсе</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="materials">
        <div class="inner">
            <div class="materials-text">
                <img src="{{asset('images/icons/Paper.png')}}" alt="paper">
                <p>Полезные материалы</p>
            </div>
            <div class="files">
                <a href="#"><img src="{{asset('images/icons/Downlaod.png')}}" alt="">Шаблон бюджета</a>
                <a href="#"><img src="{{asset('images/icons/Downlaod.png')}}" alt="">Гайд</a>
                <a href="#"><img src="{{asset('images/icons/Downlaod.png')}}" alt="">Чек-лист</a>
            </div>
        </div>
    </div>

    <div class="consultants">
        <div class="consultants__inner">
            <div class="consultants__main">
                <p>
                    <b>Центр повышения квалификации финансовых консультантов</b> - это обучение и развитие навыков и
                    компитенции профессиональных финансовых советников
                </p>
                <div class="consultants__main__slider">
                    <div>
                        <img src="{{asset('images/slides/consultants-consultants-slider-img1.png')}}" alt="">
                    </div>
                    <div>
                        <img src="{{asset('images/slides/consultants-consultants-slider-img2.png')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="consultants__consultants">
                <h1>Выбери финансового консультанта</h1>
                <div class="consultants__consultants__slider">
                    @foreach($consultants as $consultant)
                        <div>
                            <p>{{ $consultant->name }}</p>
                            <img src="{{
                                    $consultant->profile_photo_path
                                    ?: asset('images/slides/consultants-consultants-slider-img4.png')
                                }}">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="articles">
        <div class="articles__wrapper">
            <h1>Статьи</h1>
            <div class="articles__slider">
                @foreach($articles as $article)

                    @php

                        $imgPath = !empty($article->image_path)
                                        ? $article->image_path
                                        : asset('images/slides/articles-slider-img1.png');
                        $title = $article->title;
                        $content = $article->content;
                    @endphp
                    <div>
                        <div class="articles__slider__slide__inner">
                            <img src="{{$imgPath}}"
                            >
                            <p>
                                {{ substr($title, 0, 65) . (strlen($title) > 65 ? '...' : '') }}
                            </p>
                            <p>
                                {{ substr($content, 0, 65) . (strlen($content) > 65 ? '...' : '') }}
                            </p>
                            <a onclick="openArticleModal('{{$title}}', '{{$content}}', '{{$imgPath}}')">
                                Читать &#8594;
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="process">
        <div class="process__inner">
            <h1>SAPA жол</h1>
            <h3>Сопровождение в процессе</h3>
            <img src="{{asset('images/sapa-zhol-img.png')}}" alt="">
        </div>
    </div>
@endsection
