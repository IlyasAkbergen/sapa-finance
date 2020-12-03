@component('mail::message')

    @component('mail::panel')
    #    {{ $user->name }}, рады приветствовать Вас!

    Ваш уровень сменен на "{{ $user->referral_level->title }}".

    @endcomponent

@component('mail::button', ['url' => url('/'), 'color' => 'success'])
    Перейти в портал
@endcomponent

    Пожалуйста, не отвечайте на это письмо. Оно было сгенерировано автоматически, исключительно с целью проинформировать Вас.
@endcomponent