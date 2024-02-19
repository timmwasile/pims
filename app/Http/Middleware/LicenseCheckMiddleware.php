<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Admins\Entities\Company;
use Modules\Admins\Entities\License;
use Session;

class LicenseCheckMiddleware
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
        $response = $next($request);
        $status = License::where("licenses.company_id", auth()->user()->company_id)->first()->status_id;

        if ($status == 0 || !$status)
        {
                Session::flush();
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->guest(route('login'))->withErrors(['msg' => 'Account has no License OR Licence Is
                                    Expired']);
        }
                return $response;
    }
    
}
