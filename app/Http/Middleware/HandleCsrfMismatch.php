<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Http\Request;

class HandleCsrfMismatch extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            return parent::handle($request, $next);
        } catch (TokenMismatchException $exception) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'CSRF token mismatch. Please refresh the page and try again.',
                    'error' => 'CSRF_TOKEN_MISMATCH',
                    'code' => 419
                ], 419);
            }

            // For web requests, redirect back with error message
            return redirect()->back()
                ->withInput($request->except('_token'))
                ->withErrors([
                    'csrf' => 'Your session has expired. Please refresh the page and try again.'
                ]);
        }
    }

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        // Add any routes that should be excluded from CSRF protection
        // Example: 'api/webhook/*'
    ];
}


