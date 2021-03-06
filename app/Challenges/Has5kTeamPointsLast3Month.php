<?php


namespace App\Challenges;


use App\Challenges\Contracts\Challengable;
use App\Challenges\Contracts\Challenge;

class Has5kTeamPointsLast3Month implements Challenge
{

    /**
     * @inheritDoc
     */
    static function check(Challengable $challengable): bool
    {
        return $challengable->getTeamPointsForLastMonths(3) >= 5000;
    }
}