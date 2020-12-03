<?php


namespace App\Challenges\Contracts;


interface Challengable
{
    function getPoints();

    function getTeamPoints();

    function getAllReferrals();

    function getBalanceIncomes($lastMonths = null);

    function getPointsForLastMonths($lastMonths);

    function getTeamPointsForLastMonths($lastMonths);
}