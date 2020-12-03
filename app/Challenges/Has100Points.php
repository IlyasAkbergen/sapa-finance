<?php


namespace App\Challenges;


use App\Challenges\Contracts\Challengable;
use App\Challenges\Contracts\Challenge;

class Has100Points implements Challenge
{

    /**
     * @inheritDoc
     */
    static function check(Challengable $challengable): bool
    {
        return $challengable->getPoints() >= 100;
    }
}