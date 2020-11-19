<?php


namespace App\Services;

use App\Models\Notification;

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
}