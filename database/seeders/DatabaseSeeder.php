<?php

namespace Database\Seeders;

use App\Challenges\BoughtStartCourse;
use App\Challenges\Has100kTeamPoints;
use App\Challenges\Has100Points;
use App\Challenges\Has1kTeamPointsInLast6Month;
use App\Challenges\Has1kTeamPointsLast3month;
use App\Challenges\Has200TeamPointsInLast6Month;
use App\Challenges\Has20kTeamPoints;
use App\Challenges\Has2kTeamPoints;
use App\Challenges\Has300TeamPointsInLast3Month;
use App\Challenges\Has50kTeamPointsInLast6Month;
use App\Challenges\Has5kTeamPointsLast3Month;
use App\Challenges\Has7kTeamPointsInLast6Month;
use App\Challenges\Referred100FC;
use App\Challenges\Referred10FC;
use App\Challenges\Referred50FC;
use App\Models\Briefcase;
use App\Models\BriefcaseType;
use App\Models\Course;
use App\Models\ReferralLevel;
use App\Enums\ReferralLevelEnum as Level;
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
                'id'   => Level::Agent,
                'slug'   => Level::Agent()->key,
                'achieve_challenges' => json_encode([
                    BoughtStartCourse::class
                ]),
                'remain_challenges' => null,
                'title' => 'Агент',
                'team_fee_percent' => 0
            ],
            [
                'id'   => Level::Consultant,
                'slug'   => Level::Consultant()->key,
                'achieve_challenges' => json_encode([
                    Has100Points::class
                ]),
                'remain_challenges' => json_encode([
                    Has200TeamPointsInLast6Month::class
                ]),
                'title' => 'Финансовый консультант',
                'team_fee_percent' => 10
            ],
            [
                'id'   => Level::Tutor,
                'slug'   => Level::Tutor()->key,
                'achieve_challenges' => json_encode([
                    Has2kTeamPoints::class,
                    Referred10FC::class,
                    Has300TeamPointsInLast3Month::class
                ]),
                'remain_challenges' => json_encode([
                    Has1kTeamPointsInLast6Month::class
                ]),
                'title' => 'Наставник',
                'team_fee_percent' => 15
            ],
            [
                'id'   => Level::Mentor,
                'slug'   => Level::Mentor()->key,
                'achieve_challenges' => json_encode([
                    Has20kTeamPoints::class,
                    Referred50FC::class,
                    Has1kTeamPointsLast3month::class
                ]),
                'remain_challenges' => json_encode([
                    Has7kTeamPointsInLast6Month::class
                ]),
                'title' => 'Ментор',
                'team_fee_percent' => 20
            ],
            [
                'id'   => Level::Partner,
                'slug'   => Level::Partner()->key,
                'achieve_challenges' => json_encode([
                    Has100kTeamPoints::class,
                    Referred100FC::class,
                    Has5kTeamPointsLast3Month::class
                ]),
                'remain_challenges' => json_encode([
                    Has50kTeamPointsInLast6Month::class
                ]),
                'title' => 'Управляющий партнер',
                'team_fee_percent' => 20
            ]
        ]);


        $this->call(UserSeeder::class);
        // \App\Models\User::factory(10)->create();

        BriefcaseType::create([
           'title' => 'Накопительный'
        ]);

        BriefcaseType::create([
            'title' => 'Разовый'
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

        Course::factory(1)->create([
            'direct_fee' => 2000,
            'awardable' => true,
            'tag' => 'is_became_agent',
        ]);
    }
}
