<?php


namespace App\Services;


use App\Models\Notification;
use Ramsey\Collection\Collection;

interface NotificationService
{
    /**
     * @param array $attributes
     * @return Notification
     */
    public function createPublic(array $attributes);

    /**
     * @param array $attributes
     * @return Notification
     */
    public function createPrivate(array $attributes);

    /**
     * @return Collection
     */
    public function getAll();


}