<form method="POST"
      wire:submit.prevent="submit"
      action="{{ route('login') }}">
    @csrf
    <x-jet-input class="block mt-1 w-full"
                 placeholder="E-mail"
                 id="email"
                 type="text"
                 wire:model="email"
                 autofocus />
    <x-jet-input-error for="email" class="text-danger"/>

    <x-jet-input class="block mt-1 w-full"
                 type="password"
                 wire:model="password"
                 placeholder="Пароль"
                 autocomplete="current-password" />
    <x-jet-input-error for="password" class="text-danger" />

    <x-jet-input-error class="mb-4" for="common" class="text-danger" />

    <button class="modal-btn" type="submit">
        Войти
    </button>
    <div class="modal-flex">
        <div>
            <input type="checkbox"
                   id="remember"
                   wire:model="remember"
                   name="remember">
            <label for="remember">Запомнить меня</label>
        </div>
        @if (Route::has('password.request'))
            <button style="border: none; background: none; margin: 0; padding: 0;" type="button" data-bs-dismiss="modal"
                    aria-label="Close"  data-bs-toggle="modal" data-bs-target="#passModal">
                Забыл пароль?
            </button>
        @endif
    </div>
</form>