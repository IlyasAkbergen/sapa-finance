<?php


namespace App\Services;


use App\Models\Message;
use Ramsey\Collection\Collection;

interface MessageService
{
    /**
     * @param array $attributes
     * @return Message
     */
    public function createPublic(array $attributes);

    /**
     * @param array $attributes
     * @return Message
     */
    public function createPrivate(array $attributes);

    /**
     * @param $user_id
     * @return Collection
     */
    public function allNew($user_id);

    /**
     * @param int $notification_id
     * @param int $user_id
     * @return mixed
     */
    public function makeSeen($notification_id, $user_id);

    /**
     * @param int $user_id
     * @param array $attributes
     * @return Message $message
     */
    public function createForUser($user_id, array $attributes);

    /**
     * @param Message $message
     * @param array $ids user ids to be attached
    */
    public function attachToUsers($message, array $ids);
}