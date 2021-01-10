<?php


namespace App\Interfaces;


interface WithPurchase
{
    function purchases();

    function isAwardable();

    function getAwardSum();

    function users();

    function getDescription();

    function getPurchaseSum($with_feedback);

    function getIsPartPaidAttribute();

    function getLinkAttribute();
}