<?php

namespace Modules\Admins\Http\Controllers\Auth\Traits;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\StatefulGuard;

trait RegistersAdmins
{
    use RedirectsAdmins;

    /**
     * Show the application registration form.
     *
     * @return View
     */
    public function showAdminRegistrationForm()
    {
        return view('backend.auth.register', ['url' => 'admin']);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param Request $request
     *
     * @return RedirectResponse|JsonResponse
     */
    public function adminRegister(Request $request)
    {
        $this->adminValidator($request->all())->validate();

        event(new Registered($admin = $this->createAdmin($request->all())));

        $this->adminGuard()->login($admin);

        if ($response = $this->adminRegistered($request, $admin)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectAdminPath());
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return StatefulGuard
     */
    protected function adminGuard()
    {
        return Auth::guard('admin');
    }

    /**
     * The user has been registered.
     *
     * @param Request $request
     * @param mixed   $user
     *
     * @return mixed
     */
    protected function adminRegistered(Request $request, $user)
    {
    }
}
