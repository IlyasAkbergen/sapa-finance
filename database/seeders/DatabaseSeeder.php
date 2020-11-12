<?php

namespace Database\Seeders;

use App\Models\ReferralLevel;
use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            [
                'id'   => Role::ROLE_ADMIN,
                'name' => 'Администратор',
            ],
            [
                'id'   => Role::ROLE_CLIENT,
                'name' => 'Клиент'
            ]
        ]);

        ReferralLevel::insert([
            [
                'id'   => ReferralLevel::LEVEL_AGENT,
                'title' => 'Агент',
            ],
            [
                'id'   => ReferralLevel::LEVEL_CONSULTANT,
                'title' => 'Финансовый консультант',
//                'reach_points' => 100,
//                'defend_points' => null,
//                'defend_team_points' => 200,
            ],
            [
                'id'   => ReferralLevel::LEVEL_TUTOR,
                'title' => 'Наставник',
//                'reach_team_points' => 2000,
//                'defend_team_points' => 1000,
            ],
            [
                'id'   => ReferralLevel::LEVEL_MENTOR,
                'title' => 'Ментор',
//                'reach_team_points' => 20000,
//                'defend_team_points' => 7000,
            ],
            [
                'id'   => ReferralLevel::LEVEL_PARTNER,
                'title' => 'Управляющий партнер',
//                'reach_team_points' => 100000,
//                'defend_team_points' => 50000,
            ]
        ]);

        $this->call(UserSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
