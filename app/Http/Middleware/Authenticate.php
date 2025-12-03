<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    protected function redirectTo(Request $request)
    {
        if (!Auth::guard('wooblr')->check()) {
            return $request->expectsJson() ? null : route('wooblr.auth');
        }
    }
}
