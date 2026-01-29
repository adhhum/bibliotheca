<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminBasicAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        $username = env('ADMIN_USER', 'admin');
        $password = env('ADMIN_PASSWORD', 'secret');

        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header('WWW-Authenticate: Basic realm="Admin Area"');
            header('HTTP/1.0 401 Unauthorized');
            exit('Auth required');
        }

        if ($_SERVER['PHP_AUTH_USER'] !== $username ||
            $_SERVER['PHP_AUTH_PW']   !== $password) {
            header('HTTP/1.0 403 Forbidden');
            exit('Access denied');
        }

        return $next($request);
    }
}