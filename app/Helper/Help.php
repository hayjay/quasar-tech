<?php

namespace App\Helper;
use App\Models\TransactionLog;

class Help
{
	public static function logTransaction ($data, $action)
	{
		TransactionLog::create([
            'request_header' => json_encode(request()->header()),
            'request_data' => json_encode(request()->getContent()),
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'description' => $action,
            'payload' => $data,
        ]);
	}
}