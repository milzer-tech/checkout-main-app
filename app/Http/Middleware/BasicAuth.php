<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BasicAuth
{
    /**
     * Protect routes (Horizon dashboard, home page) with HTTP Basic Auth.
     *
     * Access is denied when no credentials are configured, so a missing
     * env value never leaves a protected route open.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $username = (string) config('auth.basic_auth.username');
        $password = (string) config('auth.basic_auth.password');

        if ($username === '' || $password === '') {
            abort(403);
        }

        $validUsername = hash_equals($username, (string) $request->getUser());
        $validPassword = hash_equals($password, (string) $request->getPassword());

        if (! $validUsername || ! $validPassword) {
            return response('Unauthorized.', 401, [
                'WWW-Authenticate' => 'Basic realm="Restricted", charset="UTF-8"',
            ]);
        }

        return $next($request);
    }
}
