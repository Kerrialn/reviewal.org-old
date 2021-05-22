<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify($user_id, Request $request)
    {
        if (!$request->hasValidSignature()) {
            return response(["message" => "Invalid url provided."], 401);
        }

        $user = User::findOrFail($user_id);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        return redirect()->to('/');
    }

    public function resend()
    {
        $authUserId = auth()->user()->id;
        $user = User::find($authUserId);

        if ($user->hasVerifiedEmail()) {
            return response(["message" => "Email already verified."], 400);
        }

        $user->sendEmailVerificationNotification();

        return response(["message" => "Email verification link sent"], 200);
    }
}
