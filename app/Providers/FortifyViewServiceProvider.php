<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Fortify::loginView(function () {
            return view('auth.login');
        });


        Fortify::registerView(function () {
            return view('auth.register');
        });
    }
}
