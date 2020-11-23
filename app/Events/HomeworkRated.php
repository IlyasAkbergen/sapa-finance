<?php

namespace App\Events;

use App\Models\Homework;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class HomeworkRated implements ShouldQueue
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
    }
}
