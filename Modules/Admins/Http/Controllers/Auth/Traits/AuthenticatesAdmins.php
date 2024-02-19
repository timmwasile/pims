<?php

namespace Modules\Admins\Http\Controllers\Auth\Traits;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

trait AuthenticatesAdmins
{
    use RedirectsAdmins;
    use ThrottlesLogins;

    /**
     * Show the application's login form.
     *
     * @return View
     */
    public function showAdminLoginForm()
    {
        return view('backend.auth.login', ['url' => 'admin']);
    }

    /**
     * Handle a login request to the application.
     *
     * @param Request $request
     *
     * @return JsonResponse|RedirectResponse|\Illuminate\Http\Response|Response
     *
     * @throws ValidationException
     */
    public function adminLogin(Request $request)
    {
        $this->validateAdminLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptAdminLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('backend.auth.password_confirmed_at', time());
            }

            return $this->sendAdminLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendAdminFailedLoginResponse($request);
    }

    /**
     * Validate the user login request.
     *
     * @param Request $request
     *
     * @return void
     *
     * @throws ValidationException
     */
    protected function validateAdminLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param Request $request
     *
     * @return bool
     */
    protected function attemptAdminLogin(Request $request)
    {
        return $this->adminGuard()->attempt(
            $this->adminCredentials($request),
            $request->boolean('remember')
        );
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param Request $request
     *
     * @return array
     */
    protected function adminCredentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param Request $request
     *
     * @return RedirectResponse|JsonResponse
     */
    protected function sendAdminLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->adminAuthenticated($request, $this->adminGuard()->user())) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended($this->redirectAdminPath());
    }

    /**
     * The user has been authenticated.
     *
     * @param Request $request
     * @param mixed $user
     *
     * @return mixed
     */
    protected function adminAuthenticated(Request $request, $user)
    {
    }

    /**
     * Get the failed login response instance.
     *
     * @param Request $request
     *
     * @return Response
     *
     * @throws ValidationException
     */
    protected function sendAdminFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Log the admin out of the application.
     *
     * @param Request $request
     *
     * @return RedirectResponse|JsonResponse
     */
    public function adminLogout(Request $request)
    {
        $this->adminGuard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->adminLoggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/admin');
    }

    /**
     * The admin has logged out of the application.
     *
     * @param Request $request
     *
     * @return mixed
     */
    protected function adminLoggedOut(Request $request)
    {
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return StatefulGuard
     */
    protected function adminGuard()
    {
        return Auth::guard('admin');
    }
}
