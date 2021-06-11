<?php
namespace App\Repositories;

use App\Interfaces\TransactionRepositoryInterface;
use App\Models\TransactionLog;


class TransactionRepository implements TransactionRepositoryInterface
{
    public function all()
    {
    	return TransactionLog::select('description','ip_address', 'payload')->get();
    	return TransactionLog::all();
    }

    public function findByName($name)
    {
        return TransactionLog::where('description', 'like', '%' . $name . '%')->get();
    }
}
