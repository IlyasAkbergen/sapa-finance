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
use App\Mail\HomeworkCreated as HomeworkCreatedMail;

class HomeworkCreated extends Notification implements ShouldQueue
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
        $this->homework->load('user.referrer', 'course');
        $user = $this->homework->user;
        if (!empty($user->referrer)) {
            $user->referrer->notify($this);
        }
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
        return (new HomeworkCreatedMail($notifiable, $this->homework))
            ->subject('Домашнее задание сдана на проверку')
            ->to($notifiable->email);
    }
}
