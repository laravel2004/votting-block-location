<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
use Symfony\Component\HttpFoundation\Response;

class IPChecker {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        $possition = Location::get('140.0.92.74');
        if ($possition->cityName == 'Surabaya') {
            // dd($possition);
            return $next($request);
        }
        // return redirect('/404');
    }
}
