@component('mail::message')

    @component('mail::panel')
    #    {{ $notifiable->name }}, рады приветствовать Вас!

    Пользователь "{{ $homework->user->name }}" сдал домашнее задание по уроку "{{ $homework->lesson->title }}".

    @endcomponent

@component('mail::button', ['url' => $homework->link, 'color' => 'success'])
    Перейти в портал
@endcomponent

    Пожалуйста, не отвечайте на это письмо. Оно было сгенерировано автоматически, исключительно с целью проинформировать Вас.
@endcomponent