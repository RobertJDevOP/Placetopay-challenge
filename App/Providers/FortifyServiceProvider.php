<?php

namespace App\Providers;


use App\Actions\Fortify\CreateNewUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);

        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return false;
            }

            if (!Hash::check($request->password, $user->password)) {
                return false;
            }

            if (!$user->isEnabled()) {
                throw ValidationException::withMessages([
                    Fortify::username() => [trans('auth.blocked')],
                ]);
            }

            return $user;
        });
    }
}
