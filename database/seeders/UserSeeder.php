<?php

namespace Database\Seeders;

use App\Enums\ReferralLevelEnum;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate(['phone' => '111'],[
            'name' => "Test Admin",
            'iin' => '111111111',
            'phone' => '111',
            'email' => "admin@mail.ru",
            'password' => bcrypt('password'),
            'email_verified_at' => Carbon::now(),
            'role_id' => Role::ROLE_ADMIN,
        ]);

        User::updateOrCreate(['phone' => '777'],[
            'name' => "Test Client",
            'iin' => '777777777',
            'phone' => '777',
            'email' => "client@mail.ru",
            'password' => bcrypt('password'),
            'role_id' => Role::ROLE_CLIENT,
            'email_verified_at' => Carbon::now(),
        ]);

        User::updateOrCreate(['phone' => '888'],[
            'name' => "Test Agent",
            'iin' => '888888888',
            'phone' => '888',
            'email' => "agent@mail.ru",
            'password' => bcrypt('password'),
            'role_id' => Role::ROLE_CLIENT,
            'referral_level_id' => ReferralLevelEnum::Agent,
            'email_verified_at' => Carbon::now(),
        ]);

        User::updateOrCreate(['phone' => '999'],[
            'name' => "Test Consultant",
            'iin' => '999999999',
            'phone' => '999',
            'email' => "consultant@mail.ru",
            'password' => bcrypt('password'),
            'role_id' => Role::ROLE_CLIENT,
            'referral_level_id' => ReferralLevelEnum::Consultant,
            'email_verified_at' => Carbon::now(),
        ]);
    }
}
