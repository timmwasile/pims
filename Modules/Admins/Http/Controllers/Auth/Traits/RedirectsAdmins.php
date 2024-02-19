<?php

namespace Modules\Admins\Http\Controllers\Auth\Traits;

trait RedirectsAdmins
{
    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectAdminPath()
    {
        if (method_exists($this, 'redirectAdminTo')) {
            return $this->redirectAdminTo();
        }

        return property_exists($this, 'redirectAdminTo') ? $this->redirectAdminTo : '/admin';
    }
}
