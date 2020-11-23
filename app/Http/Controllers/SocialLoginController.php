<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{

    public $provider;

    public function __construct($provider)
    {
        return $this->provider = $provider;
    }

    /**
     * Create a new controller instance.
     *
     * @param $provider
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider()
    {
        return Socialite::driver($this->provider)->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleCallback()
    {
        try {

            $user = Socialite::driver($this->provider)->user();

            $email = $user->getEmail();

            $finduser = User::where($this->provider. '_id', $user->id)->first();

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
                        $this->provider . '_id'=> $user->id,
                        'password' => encrypt('123456dummy')
                    ]);

                    Auth::login($newUser);
                }

                return redirect()->intended('dashboard');
            }

        } catch (Exception $e) {
            // uncaught error
        }
    }
}
