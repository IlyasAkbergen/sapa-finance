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
     * @param $user_id
     * @return Collection
     */
    public function getAll($user_id);

    /**
     * @param $user_id
     * @return Collection
     */
    public function getAllNew($user_id);

    /**
     * @param int $notification_id
     * @param int $user_id
     * @return mixed
     */
    public function makeSeen($notification_id, $user_id);

    /**
     * @param int $user_id
     * @param array $attributes
     * @return Notification $notification
     */
    public function createForUser($user_id, array $attributes);

    /**
     * @param Notification $notification
     * @param array $ids user ids to be attached
    */
    public function attachToUsers($notification, array $ids);
}