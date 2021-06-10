<?php

namespace App\Listeners;

use App\Events\TodoFetched;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Helper\Help;

class LogTodoFetchedTransaction
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
    public function handle(TodoFetched $event)
    {
        Help::logTransaction($event->todo, 'Todo Fetched Successfully!');
    }
}
