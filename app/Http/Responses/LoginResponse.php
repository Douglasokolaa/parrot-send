<?php

namespace App\Http\Responses;

use Inertia\Inertia;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Redirect;
use Symfony\Component\HttpFoundation\Response;

class LoginResponse implements LoginResponseContract

{

    public function toResponse($request): \Illuminate\Http\Response|Response
    {
        return Inertia::location(Redirect::intended(route('dashboard')));
    }
}
