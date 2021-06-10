<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\TodoCreated' => [
            'App\Listeners\LogTodoCreatedTransaction',
        ],
        'App\Events\TodoUpdated' => [
            'App\Listeners\LogTodoUpdatedTransaction',
        ],
        'App\Events\TodoDeleted' => [
            'App\Listeners\LogTodoDeletedTransaction',
        ],
        'App\Events\TodoFetched' => [
            'App\Listeners\LogTodoFetchedTransaction',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
