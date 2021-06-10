<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\TodoList\TodoListRepository;
use App\Interfaces\TodoList\TodoListRepositoryInterface;
use App\Repositories\TransactionRepository;
use App\Interfaces\TransactionRepositoryInterface;


class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(TodoListRepositoryInterface::class, TodoListRepository::class);
        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepository::class);
    }
}
