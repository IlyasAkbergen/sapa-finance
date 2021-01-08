<?php


namespace App\View\Components;


use App\Models\Role;
use App\Models\User;
use Faker\Factory;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\Component;
use Laravel\Fortify\Contracts\RegisterResponse;

class UserForm extends Component
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

    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'iin' => ['required', 'string', 'max:12', 'unique:users'],
        'phone' => ['required', 'string', 'max:12'],
        'referrer_id' => ['numeric', 'exists:' . User::class . ',id'],
        'password' => ['required', 'string', 'confirmed']
    ];

    public function submit()
    {
        $this->validate();

        // Execution doesn't reach here if validation fails.
        event(
            new Registered(
                $user = User::create([
                    'name' => $this->name,
                    'email' => $this->email,
                    'iin' => $this->iin,
                    'phone' => $this->phone,
                    'referrer_id' => $this->referrer_id ?? null,
                    'role_id' => Role::ROLE_CLIENT,
                    'password' => Hash::make($this->password),
                ])
            )
        );

        $this->guard->login($user);

        return app(RegisterResponse::class);
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('auth.register-form');
    }
}
