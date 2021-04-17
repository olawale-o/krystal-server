<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\LoginFormRequest;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function login(LoginFormRequest $request)
    {
        $validated  =  $request->validated();

        $user =  User::where('email', $validated["email"])->first();
        if($user) {
            $isPasswordValid =  Hash::check($validated["password"], $user->password);

            if($isPasswordValid) 
            {
                $response = [
                    'response' => [
                        "user" => $user,
                        "message" => "Logged in successfully"
                    ]
                ];
                return response($response, 200);
            } else{

                $response = [
                    'response' => [
                        "message" => "User does not exist"
                    ]
                ];

                return response($response, 404);
            }
        }
        $response = [
            'response' =>[
                "message" => "Internal server error"
            ]
        ];

        return response($response, 200);
    }
}
