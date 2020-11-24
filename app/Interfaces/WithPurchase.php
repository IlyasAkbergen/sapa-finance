<?php


namespace App\Interfaces;


interface WithPurchase
{
    function purchases();

    function isAwardable();

    function getAwardSum();

    function users();
}