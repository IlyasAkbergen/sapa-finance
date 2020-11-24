<?php

namespace App\Events;

use App\Models\Homework;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;

class HomeworkRated extends Notification implements ShouldQueue
{
    use Dispatchable, InteractsWithSockets, SerializesModels, Queueable;

    public $homework;

    /**
     * Create a new event instance.
     *
     * @param Homework $homework
     */
    public function __construct(Homework $homework)
    {
        $this->homework = $homework;
        $this->homework->load('user');
        $this->homework->user->notify($this);
    }

    public function via($notifiable)
    {
        // todo check if notifiable can receive email, has subscription
        return [];
    }

    public function toMail($notifiable)
    {
        return (new \App\Mail\HomeworkRated($this->homework))
            ->subject('Домашняя работа оценена')
            ->to($notifiable->email);
    }
}
