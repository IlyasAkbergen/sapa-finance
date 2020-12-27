<?php

namespace App\Actions\Fortify;

use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
//        Validator::make($input, [
//            'name' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//            'iin' => ['required', 'string', 'max:12', 'unique:users'],
//            'phone' => ['required', 'string', 'max:12', 'unique:users'],
//            'referrer_id' => ['numeric', 'exists:' . User::class . ',id'],
//            'password' => $this->passwordRules(),
//        ])->validate();

        return DB::transaction(function () use ($input) {
            return User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'iin' => $input['iin'],
                'phone' => $input['phone'],
                'referrer_id' => $input['referrer_id'],
                'role_id' => Role::ROLE_CLIENT,
                'password' => Hash::make($input['password']),
            ]);
        });
    }

    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }
}
