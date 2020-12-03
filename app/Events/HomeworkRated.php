<?php

namespace App\Events;

use App\Models\Course;
use App\Models\Homework;
use App\Models\Purchase;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;

class HomeworkRated extends Notification implements ShouldQueue
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $homework;

    /**
     * Create a new event instance.
     *
     * @param Homework $homework
     */
    public function __construct(Homework $homework)
    {
        $this->homework = $homework;
        $this->homework->load('user', 'course');
        $this->homework->user->notify($this);
    }

    public function via($notifiable)
    {
        $result = [];
        $purchase = Purchase::where('purchasable_id', $this->homework->course->id)
            ->where('purchasable_type', Course::class)
            ->where('user_id', $notifiable->id)
            ->first();

        if (!empty($purchase) && $purchase->with_feedback) {
            array_push($result, 'mail');
        }

        return $result;
    }

    public function toMail($notifiable)
    {
        return (new \App\Mail\HomeworkRated($this->homework))
            ->subject('Домашняя работа оценена')
            ->to($notifiable->email);
    }
}
