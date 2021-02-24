<?php

namespace App\Events;

use App\Models\Course;
use App\Models\Homework;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;
use App\Mail\HomeworkCreated as HomeworkCreatedMail;

class HomeworkCreated extends Notification implements ShouldQueue
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
        $this->homework->load('course');
        $purchase = Purchase::where('purchasable_id', data_get($this, 'homework.course.id'))
            ->where('purchasable_type', Course::class)
            ->where('user_id', data_get($this, 'homework.user_id'))
            ->first()
        ;
        if (!empty($purchase) && $purchase->with_feedback) {
            $admins = User::query()
                ->isAdmin()
                ->orWhere('email', env('HOMEWORK_CHECKER_EMAIL', 'br.akzhunis@gmail.com'))
                ->get()
            ;
            foreach ($admins as $admin) {
                $admin->notify($this);
            }
        }
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new HomeworkCreatedMail($notifiable, $this->homework))
            ->subject('Домашнее задание сдана на проверку')
            ->to($notifiable->email);
    }
}
