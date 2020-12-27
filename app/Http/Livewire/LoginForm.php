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
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Requests\LoginRequest;
use Livewire\Component;

class LoginForm extends Component
{
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public $email;
    public $password;
    public $remember;

    protected $rules = [
        'email' => ['required', 'string', 'email', 'max:255', 'exists:' . User::class . ',email'],
        'password' => ['required', 'string'],
    ];

    protected $messages = [
        'email.required' => 'Введите email.',
        'email.exists' => 'Пользователя с таким email не существует.',
        'password.required' => 'Введите пароль.',
    ];

    public function submit()
    {
        $this->validate();

//        $request = new LoginRequest();
//
//        $request->replace([
//            ['email' => $this->email],
//            ['password' => $this->password],
//            ['remember' => $this->remember]
//        ]);

        if(\Auth::attempt([
            'email' => $this->email,
            'password' => $this->password
        ])){
            return redirect('/');
        }else{
            $this->addError('common', 'Неправильный логин или пароль');
        }
//        return app(AuthenticatedSessionController::class)
//            ->store($request);
    }

    public function render()
    {
        return view('livewire.login-form');
    }
}
