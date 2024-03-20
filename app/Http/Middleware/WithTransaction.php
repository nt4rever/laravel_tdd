<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class WithTransaction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        return rescue(fn() => DB::transaction(function () use ($request, $next) {
            $result = $next($request);

            if (isset ($result->exception)) {
                throw $result->exception;
            }

            return $result;
        }), function (Throwable $e) use ($request) {
            logger()->error('Rolled back transaction on error', [
                'error' => [
                    'msg' => $e->getMessage(),
                    // 'traces' => $e->getTrace(),
                ],
                'url' => $request->fullUrl(),
            ]);

            $result = [
                'outcome' => 'ACTION_FAILED',
                'path' => $request->path(),
                'timestamp' => now()->getTimestampMs(),
            ];
            if (config('app.debug')) {
                $result += ['msg' => $e->getMessage()];
            }

            return new JsonResponse($result, 400);
        });
    }
}
