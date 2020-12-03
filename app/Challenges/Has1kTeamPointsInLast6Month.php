<?php


namespace App\Challenges;


use App\Challenges\Contracts\Challengable;
use App\Challenges\Contracts\Challenge;

class Has1kTeamPointsInLast6Month implements Challenge
{

    /**
     * @inheritDoc
     */
    static function check(Challengable $challengable): bool
    {
        return $challengable->getTeamPointsForLastMonths(6) >= 1000;
    }
}