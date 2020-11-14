<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->stateless()->user();

            $email = $user->getEmail();

            $finduser = User::where('google_id', $user->id)->first();

            if($finduser){

                Auth::login($finduser);

                return redirect()->intended('dashboard');

            } else {

                $existingUser = User::where('email', $email)->first();

                if ($existingUser) {
                    // error should not create new account
                    // login
                    Auth::login($existingUser);
                } else {
                    $newUser = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'google_id'=> $user->id,
                        'password' => encrypt('123456dummy')
                    ]);

                    Auth::login($newUser);
                }

//                return redirect()->intended('dashboard');
                  return redirect()->intended('https://pms-tasker.web.app/token=' . $user->token);
            }

        } catch (Exception $e) {
            // uncaught error
        }
    }
}
