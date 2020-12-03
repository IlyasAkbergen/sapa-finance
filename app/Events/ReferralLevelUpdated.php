<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;

class ReferralLevelUpdated extends Notification implements ShouldQueue
{
use Dispatchable, InteractsWithSockets, SerializesModels, Queueable;

    public $user;

    /**
     * Create a new event instance.
     *
     * @param $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $user->notify($this);
    }

    public function via($user)
    {
        return ['mail']; // , 'database'
    }

    public function toMail($user)
    {
        return (new \App\Mail\ReferralLevelUpdatedMailable($user))
            ->subject('У Вас сменился уровень.')
            ->to($user->email);
    }

    public function toDatabase($user)
    {
        // todo $user->addNotification
    }
}
