<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionLog extends Model
{
    use HasFactory;
    protected $fillable = ['request_header', 'request_data', 'ip_address', 'user_agent', 'user_id', 'description', 'payload'];
}
