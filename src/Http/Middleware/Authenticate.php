<?php

namespace Module\Customer\Http\Middleware;

use Illuminate\Auth\AuthenticationException;

class Authenticate extends \Illuminate\Auth\Middleware\Authenticate
{
    protected function unauthenticated($request, array $guards)
    {
        throw new AuthenticationException(
            'Unauthenticated.', $guards, $this->redirectToWithGuard($request, $guards)
        );
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $guards
     * @return string|null
     */
    protected function redirectToWithGuard($request, $guards)
    {
        if (!$request->expectsJson()) {
            if (in_array('customer', $guards)) {
                return route('customer.web.customer.login');
            } elseif (\Route::has('login')) {
                return route('login');
            } else {
                return url('login');
            }
        }
    }
}
