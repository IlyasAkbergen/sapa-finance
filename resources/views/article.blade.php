@extends('layouts.landing-guest')
@section('content')
    <div id="about" style="background: none;">
        <div class="wrapper" style="background: none;">
            <div class="inner page-course-inner">
                <a href="{{ route('welcome') }}" class="back-button">
                    <svg style="margin-top: -2.5px;" xmlns="http://www.w3.org/2000/svg" width="7" height="12" viewBox="0 0 7 12" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.58934 0.410093C6.91477 0.73553 6.91477 1.26317 6.58934 1.5886L2.17859 5.99935L6.58934 10.4101C6.91477 10.7355 6.91477 11.2632 6.58934 11.5886C6.2639 11.914 5.73626 11.914 5.41083 11.5886L0.410826 6.58861C0.0853888 6.26317 0.0853888 5.73553 0.410826 5.41009L5.41083 0.410093C5.73626 0.0846564 6.2639 0.0846564 6.58934 0.410093Z" />
                    </svg>
                    Вернуться назад
                </a>
                <img style="width: 100%;"
                     class="mt-4"
                     src="{{ $article->image_path ?: '/images/course-card-img.png' }}" alt="">
                <h2 style="margin-top: 20px; font-weight: 600; font-size: 36px;">{{  $article->title }}</h2>
                <p>
                    {{ $article->content }}
                </p>
            </div>
        </div>
    </div>

    <div class="articles__wrapper">
        <h1>Читать также</h1>
        <div class="articles__slider">
            @foreach($related_articles as $item)

                @php
                    $imgPath = !empty($item->image_path)
                                    ? $item->image_path
                                    : asset('images/slides/articles-slider-img1.png');
                    $title = $item->title;
                    $content = $item->content;
                @endphp
                <div>
                    <div class="articles__slider__slide__inner">
                        <img src="{{$imgPath}}"
                        >
                        <h4 class="mt-2">
                            {{ substr($title, 0, 65) . (strlen($title) > 65 ? '...' : '') }}
                        </h4>
                        <p>
                            {{ substr($content, 0, 65) . (strlen($content) > 65 ? '...' : '') }}
                        </p>
                        <a href="{{ route('guest_article', $item->id) }}">
                            Читать &#8594;
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
