<?php

namespace App\Listeners;

use App\Events\TodoCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Helper\Help;

class LogTodoCreatedTransaction
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
    public function handle(TodoCreated $event)
    {
        Help::logTransaction($event->todo, 'Todo Created!');
    }
}
