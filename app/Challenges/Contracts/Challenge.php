<?php


namespace App\Challenges\Contracts;


interface Challenge
{
    /**
     * @param Challengable $challengable
     * @return bool
     */
    static function check(Challengable $challengable): bool;
}