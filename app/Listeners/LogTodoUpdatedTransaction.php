<?php

namespace App\Listeners;

use App\Events\TodoUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Helper\Help;

class LogTodoUpdatedTransaction
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
     * @param  TodoUpdated  $event
     * @return void
     */
    public function handle(TodoUpdated $event)
    {
        Help::logTransaction($event->todo, 'Todo Updated!');
    }
}
