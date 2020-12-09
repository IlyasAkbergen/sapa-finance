<?php


namespace App\Services;


use App\Models\User;

interface CourseService
{
    function ofUser(User $user);

    function allCanBuy(User $user);
}