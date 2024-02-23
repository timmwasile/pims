<?php

namespace Modules\Recruitments\Http\Middleware;
// namespace Modules\Recruitments\Http\Repositories;


use Auth;
use Closure;
use Illuminate\Http\Request;
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
        if (!Auth::check()) {
            return redirect()->guest(route('login'))->withErrors(['msg' => 'You are not logged in']);
        }

        $response = $next($request);

        $user = Auth::user();
        if ($user) {
            $status = License::where("company_id", $user->company_id)->first()->status_id;

            if ($status == 0 || !$status) {
                Session::flush();
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->guest(route('login'))->withErrors(['msg' => 'Account has no License OR License Is Expired']);
            }
        }

        return $response;
    }


}
