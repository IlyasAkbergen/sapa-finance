<form method="POST"
      wire:submit.prevent="submit"
      action="{{ route('register') }}">
    @csrf
    <x-jet-input
            type="text"
            placeholder="Имя"
            autocomplete="name"
            :value="old('name')"
            id="name"
            wire:model="name" />

    <x-jet-input-error for="name" class="text-danger"/>

    <x-jet-input type="text"
                 placeholder="E-mail"
                 :value="old('email')"
                 wire:model="email" />

    <x-jet-input-error for="email" class="text-danger"/>

    <x-jet-input type="text"
                 placeholder="Номер телефона"
                 :value="old('phone')"
                 wire:model="phone" />

    <x-jet-input-error for="phone" class="text-danger"/>

    <x-jet-input type="text" placeholder="ИИН"
                 :value="old('iin')"
                 wire:model="iin" />
    <x-jet-input-error for="iin" class="text-danger"/>

    <x-jet-input type="hidden" wire:model="referrer_id" />

    <x-jet-input id="password"
                 class="block mt-1 w-full"
                 type="password"
                 wire:model="password"
                 placeholder="Пароль"
                 autocomplete="new-password" />

    <x-jet-input-error for="password" class="text-danger"/>

    <x-jet-input
            id="password_confirmation"
            class="block mt-1 w-full"
            type="password"
            wire:model="password_confirmation"
            placeholder="Подтверждение пароля"
            autocomplete="new-password" />

    <x-jet-input-error for="password_confirmation" class="text-danger"/>

    <x-jet-input-error for="referrer_id" class="text-danger"/>

    <button class="modal-btn" type="submit">
        Зарегистрироваться
    </button>
    <div class="text-center">
        <div>
            <label for="remember">Если уже есть аккаунт</label>
        </div>
    </div>
</form>