<?php

namespace App\Http\Middleware;

use App\Models\ApiLog;
use Closure;
use Illuminate\Support\Facades\Auth;

class ApiRequestResponseLogger
{
    private $logger;

    public function __construct(ApiLog $logger)
    {
        $this->logger = $logger;
    }
     /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    public function terminate($request, $response)
    {
        $this->logger->api_reference = uniqid().uniqid().uniqid();
        $this->logger->request_method = request()->method();
        $this->logger->request_url = request()->url();
        $this->logger->request_header = json_encode(request()->header());
        $this->logger->request_data = json_encode($request->getContent());
        $this->logger->response_data = json_encode($response->getContent());
        $this->logger->response_code = $response->status();
        $this->logger->ip_address = $request->ip();
        $this->logger->user_agent = $request->header('User-Agent');
        $this->logger->user_id = Auth::user() ? Auth::user()->id : null;
        $this->logger->save();
    }
}
