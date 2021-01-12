<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Contracts\RegisterResponse;
use Livewire\Component;

class RegisterForm extends Component
{
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public $name;
    public $email;
    public $iin;
    public $phone;
    public $referrer_id;
    public $password;
    public $password_confirmation;
    public $user;

    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'iin' => ['required', 'string', 'max:12', 'min:12', 'unique:users'],
        'phone' => ['required', 'string', 'max:12', 'unique:users'],
        'referrer_id' => ['nullable', 'exists:' . User::class . ',id'],
        'password' => ['required', 'string', 'same:password_confirmation', 'min:6'],
        'password_confirmation' => ['required', 'string'],
    ];

    protected $messages = [
        'name.required'  => 'Введите имя.',
        'email.required' => 'Введите email.',
        'iin.required'   => 'Введите ИИН.',
        'iin.max' => 'ИИН должен состоять из 12 символов.',
        'iin.min' => 'ИИН должен состоять из 12 символов.',
        'phone.required' => 'Введите номер телефона.',
        'password.same' => 'Пароли не совпадают.',
        'password.required' => 'Введите пароль.',
        'password.min' => 'Пароль должен состоять из 6 или более символов.',
        'password_confirmation.required' => 'Повторите пароль.',
        'email.unique' => 'Введенный email занят другим пользователем.',
        'phone.unique' => 'Введенный номер телефона занят другим пользователем.',
        'iin.unique' => 'Введенный ИИН занят другим пользователем.',
        'email.email' => 'Неверный формат.',
        'referrer_id.exists' => 'Пользователь с введенным в ссылке уникальным номером не существует.'
    ];

    public function submit(CreatesNewUsers $creator)
    {
        $this->validate();

        $user = $creator->create([
            'name' => $this->name,
            'email' => $this->email,
            'iin' => $this->iin,
            'phone' => $this->phone,
            'referrer_id' => $this->referrer_id
                ?: env('SAPA_USER_ID'),
            'role_id' => Role::ROLE_CLIENT,
            'password' => $this->password,
        ]);

        if (!env('APP_DEBUG')) {
            event(
                new Registered(
                    $user
                )
            );
        }

        Auth::login($user);

        return redirect()->to('/');
    }

    public function render()
    {
        return view('livewire.register-form');
    }
}
