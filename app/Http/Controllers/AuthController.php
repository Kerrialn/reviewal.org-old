<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{


  /**
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function login(Request $request)
  {
    $login = $request->validate([
      'email' => 'required|string',
      'password' => 'required|string',
    ]);



    if (!Auth::attempt($login)) {
      return response([
        'flash' => [
          'message' => 'invalid credentials',
          'type' => 'is-danger'
        ],
      ], 400);
    }

    $authUserId = Auth::user()->id;
    $user = User::find($authUserId);

    $token = $user->createToken('PERSONAL_ACCESS_TOKEN')->accessToken;


    return response([
      'flash' => [
        'message' => 'login successful',
        'type' => 'is-success'
      ],
      'token' => $token
    ], 200);
  }


  /**
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function profile(Request $request)
  {

    $authUserId = Auth::user()->id;
    $user = User::find($authUserId);

    return response($user);
  }

  /**
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function register(Request $request)
  {
    $formData = $request->validate([
      'name' => 'required|string',
      'email' => 'required|string',
      'password' => 'required|string',
    ]);

    if ($formData && !User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password)
    ])->sendEmailVerificationNotification()) {


      response([
        'message' => 'registration failed'
      ], 400);
    }

    response([
      'message' => 'registration successful'
    ], 201);
  }
}
