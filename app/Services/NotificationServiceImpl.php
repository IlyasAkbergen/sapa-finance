<?php


namespace App\Services;

use App\Models\Notification;
use App\Models\UserNotification;

class NotificationServiceImpl extends BaseServiceImpl implements NotificationService
{
    public function __construct(Notification $model)
    {
        parent::__construct($model);
    }

    public function createPublic(array $attributes)
    {
        $attributes = array_merge($attributes, [
            'is_public' => true
        ]);

        return $this->create($attributes);
    }

    public function createPrivate(array $attributes)
    {
        $attributes = array_merge($attributes, [
            'is_public' => false
        ]);

        return $this->create($attributes);
    }

    public function allForUser($user_id) {
        return $this->model->public()
            ->orWhere
            ->forUser($user_id);
    }

    public function allNew($user_id)
    {
        $model = $this->allForUser($user_id)
                    ->newFor($user_id)
                    ->get();

        return $model;
    }

    public function makeSeen($notification_id, $user_id)
    {
        $pivot = UserNotification::where('notification_id', $notification_id)
            ->where('user_id', $user_id)
            ->firstOrFail();

        return $pivot->update([
            'seen' => true
        ]);
    }

    /**
     * @inheritDoc
     */
    public function createForUser($user_id, array $attributes)
    {
        $model = $this->createPrivate($attributes);

        $model->user_notifications()->create([
            'user_id' => $user_id
        ]);

        return $model;
    }

    /**
     * @inheritDoc
     */
    public function attachToUsers($notification, array $ids)
    {
        return $notification->users()->attach($ids);
    }
}