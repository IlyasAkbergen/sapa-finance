<?php

namespace Database\Seeders;

use App\Models\Briefcase;
use App\Models\BriefcaseType;
use App\Models\Course;
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
                'team_fee_percent' => 0
            ],
            [
                'id'   => ReferralLevel::LEVEL_CONSULTANT,
                'title' => 'Финансовый консультант',
                'team_fee_percent' => 10
            ],
            [
                'id'   => ReferralLevel::LEVEL_TUTOR,
                'title' => 'Наставник',
                'team_fee_percent' => 15
            ],
            [
                'id'   => ReferralLevel::LEVEL_MENTOR,
                'title' => 'Ментор',
                'team_fee_percent' => 20
            ],
            [
                'id'   => ReferralLevel::LEVEL_PARTNER,
                'title' => 'Управляющий партнер',
                'team_fee_percent' => 20
            ]
        ]);


        $this->call(UserSeeder::class);
        // \App\Models\User::factory(10)->create();

        BriefcaseType::create([
           'title' => 'Накопительный'
        ]);

        Briefcase::create([
            'title' => 'Первый портфель',
            'type_id' => 1,
            'sum' => 1200000,
            'profit' => 100000,
            'duration' => 10,
            'monthly_payment' => 12000,
            'direct_fee' => 3000,
            'awardable' => true
        ]);

        Course::factory(5)->create([
            'direct_fee' => 2000,
            'awardable' => true
        ]);
    }
}
