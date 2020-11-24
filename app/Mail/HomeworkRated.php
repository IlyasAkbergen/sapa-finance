<?php

namespace App\Mail;

use App\Models\Homework;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HomeworkRated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $homework;

    /**
     * Create a new message instance.
     *
     * @param Homework $homework
     */
    public function __construct(Homework $homework)
    {
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
            ->markdown('emails.homeworks.rated');
    }
}
