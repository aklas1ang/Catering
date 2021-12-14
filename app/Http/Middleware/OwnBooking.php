<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OwnBooking
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
        if($request->route('package')->user_id == \Auth::user()->id) {
            return back()->with('error', 'Not allowed to book on your own package!');
        }
        
        return $next($request);
    }
}
