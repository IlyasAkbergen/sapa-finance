@extends('layouts.landing-guest')
@section('content')

    <h1>{{ $article->title }}</h1>

{{--  Читать также $related_articles  --}}

    @foreach($related_articles as $article)
        <h2>{{ $article->title }}</h2>
    @endforeach

@endsection
