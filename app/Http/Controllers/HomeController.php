<?php

namespace App\Http\Controllers;

use Cookie;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Illuminate\Foundation\Application;
use Inertia\Response;
use Route;

class HomeController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Welcome', [
            'canLogin'       => Route::has('login'),
            'canRegister'    => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion'     => PHP_VERSION,
        ]);
    }

    
    public function theme(): RedirectResponse
    {
        return back()->cookie('theme', Cookie::get('theme') === 'dark' ? 'light' : 'dark');
    }
}
