<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $userSocial = Socialite::driver($provider)->stateless()->user();

        $user = User::where(['email' => $userSocial->getEmail()])->first();
        if ($user) {
            Auth::login($user);
            return response(['message' => 'login successful', 'redirect' => 'Dashboard'], 200);
        } else {
            $user = User::create([
                'name'          => $userSocial->getName(),
                'email'         => $userSocial->getEmail(),
                'password' => Hash::make('12345678'),
                'provider_id'   => $userSocial->getId(),
                'provider'      => $provider,
            ]);

            return response(['message' => 'registration successful', 'redirect' => 'Dashboard'], 201);
        }
    }
}
