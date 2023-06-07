<?php

namespace App\Http\Middleware;

use App\Http\Helpers\ActivityLogHelper;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ActivityLogMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $activityLog = ActivityLogHelper::generateLogFromMiddleware($request);
        $request->request->add(['log_id' => $activityLog->id]);

        return $next($request);
    }
}
