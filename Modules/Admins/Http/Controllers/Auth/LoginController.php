<?php

namespace Modules\Admins\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Modules\Admins\Providers\RouteServiceProvider;
use Modules\Admins\Http\Controllers\Auth\Traits\AuthenticatesAdmins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesAdmins;

    /**
     * Where to redirect admins after login.
     *
     * @var string
     */
    protected string $redirectAdminTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout'); // ...for Admins
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

     public function logout(Request $request) 
    {
        Session::flush();
        
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        

        // return redirect('/login');
        return redirect()->guest(route('login'));
    }
}
