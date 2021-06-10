<?php

namespace App\Listeners;

use App\Events\TodoDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Helper\Help;

class LogTodoDeletedTransaction
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  TodoCreated  $event
     * @return void
     */
    public function handle(TodoDeleted $event)
    {
        Help::logTransaction($event->todo ?? null, 'Todo Deleted!');
    }
}
