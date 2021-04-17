<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserCreateFormRequest;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

  
    /**
     * Create a new user instance after a valid registration.
     *
     * @param \App\Http\UserCreateFormRequest|request
     * @return JsonResponse
     */
    protected function create(UserCreateFormRequest $request)
    {
        $validated =  $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
        if ($user) 
        {
            $response  = [
                'response' => [
                    'user' => $user,
                    'message' => "user created"
                ]
            ];
            return response($response, 200);
        }

        $response =  [
            'response' => ['message' => 'Internal server error']
        ];

        return response($response, 500);
    }
}
