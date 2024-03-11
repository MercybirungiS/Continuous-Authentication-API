<?php

namespace App\Http\Middleware;

use App\Models\ApiConfiguration;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('X-API-Key');

        if (empty($apiKey)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $apiConfiguration = ApiConfiguration::where('api_key', $apiKey)->where('name', 'API AUTH TOKEN')->first();

        if (!$apiConfiguration) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        Cache::put('apiConfiguration', $apiConfiguration, now()->addMinutes(1));

        return $next($request);
    }
}
