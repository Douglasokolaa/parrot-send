<?php

namespace App\Http\Responses;

use Inertia\Inertia;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;
use Redirect;
use Symfony\Component\HttpFoundation\Response;

class LogoutResponse implements LogoutResponseContract

{

    public function toResponse($request): \Illuminate\Http\Response|Response
    {
        return Inertia::location(Redirect::intended(route('login')));
    }
}
