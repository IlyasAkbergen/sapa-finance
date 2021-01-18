<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            Вы успешно зарегистрировались!
            Перед тем, как попасть на портал, Вам нужно подтвердить адрес электронной почты, кликнув на ссылку, которую мы отправили.

            Если Вы не можете найти письмо во входящих, просим Вас проверить спам.
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                Новое письмо было отправлено на Вашу почту.
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-jet-button type="submit">
                        Переотправить письмо.
                    </x-jet-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Выйти
                </button>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
