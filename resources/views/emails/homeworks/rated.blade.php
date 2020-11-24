@component('mail::message')

    @component('mail::panel')
    #    {{ $homework->user->name }}, рады приветствовать Вас!

    Ваша домашняя работа по уроку "{{ $homework->lesson->title }}" была оценена.

    Оценка: {{ $homework->score }}

    @endcomponent

@component('mail::button', ['url' => $homework->link, 'color' => 'success'])
    Перейти в портал
@endcomponent

    Пожалуйста, не отвечайте на это письмо. Оно было сгенерировано автоматически, исключительно с целью проинформировать Вас.
@endcomponent