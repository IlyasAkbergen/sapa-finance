<?php


namespace App\Mail;


use App\Models\Homework;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HomeworkCreated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $homework;
    public $notifiable;

    /**
     * Create a new message instance.
     *
     * @param User $notifiable
     * @param Homework $homework
     */
    public function __construct(User $notifiable, Homework $homework)
    {
        $this->notifiable = $notifiable;
        $this->homework = $homework;
        $this->homework->loadMissing(['lesson', 'user']);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(
            'noreply@' . str_replace("https://", "", config('app.url')),
            env('APP_NAME'))
            ->markdown('emails.homeworks.created');
    }
}
