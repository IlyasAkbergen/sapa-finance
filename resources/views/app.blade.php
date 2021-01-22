<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="yandex-verification" content="86c9f5bf65e2fb5c" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ mix('css/style.css') }}">
        <link rel="stylesheet" href="{{ mix('css/style_agent.css') }}">
        <link rel="stylesheet" href="{{ mix('css/style_client.css') }}">
        <link rel="stylesheet" href="{{ mix('css/style_consaltant.css') }}">
        <link rel="stylesheet" href="{{ mix('css/style_admin.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" />

        <!-- Scripts -->
        <script src="https://kit.fontawesome.com/c9e46db961.js" crossorigin="anonymous"></script>
        @routes
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="{{ mix('js/script.min.js') }}"></script>
    </head>
    <body class="font-sans antialiased">
        @if ($message = Session::get('flash'))
            <div class="main__content__course-success pointable">
                <div class="main__content__course-success__left">
                    <img src="../img/lesson-icon-passed.png">
                </div>
                <div class="main__content__course-success__right">
                    <i class="fas fa-times fa-sm"></i>
                    <p class="main__content__course-success__right__title"
                       v-show="flash">
                        {{ $message }}
                    </p>
                </div>
            </div>
        @endif
        @inertia
    </body>
</html>
