<?php


namespace App\Traits;

trait Awardable
{
    public function isAwardable() {
        return $this->awardable;
    }

    public function getAwardSum() {
        return $this->direct_fee;
    }
}