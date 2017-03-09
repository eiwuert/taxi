<?php

namespace App\Http\Middleware;

use DB;
use Closure;
use Carbon\Carbon; 
use Illuminate\Support\Facades\Log;

class LogAfterRequest {

    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    public function terminate($request, $response)
    {
        $time = microtime(true) - LARAVEL_START;
        DB::connection('mongodb')
            ->table('requests')
            ->insert([
                'duration'  => $time,
                'url'       => $request->fullUrl(),
                'method'    => $request->getMethod(),
                'ip'        => $request->getClientIp(),
                'locale'    => $request->getLocale(),
                'languages' => $request->getLanguages(),
                'charsets'  => $request->getCharsets(),
                'encodings' => $request->getEncodings(),
                'languages' => $request->getLanguages(),
                'languages' => $request->getLanguages(),
                'isXml'     => $request->isXmlHttpRequest(),
                'proxies'   => $request->getTrustedProxies(),
                'parameters'=> $request->all(), 
            ]);
    }

}
