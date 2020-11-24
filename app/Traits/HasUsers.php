<?php


namespace App\Traits;


use App\Models\User;

trait HasUsers
{
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}