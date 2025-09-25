<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $locale = $request->route('locale'); // ambil dari URL

        if (!in_array($locale, ['id', 'en'])) {
            $locale = 'en'; // fallback
        }

        app()->setLocale($locale);

        return $next($request);
    }

}