<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\Http\Requests\Api\RegisterUserRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

//use Tymon\JWTAuth\JWTAuth;

class ApiController extends Controller
{
    // public $loginAfterSignUp = true;

    public function register(RegisterUserRequest $request)
    {
        $password = bcrypt($request->password);

        User::create(
            $request->only(['name', 'email']) + ["password" => $password]
        );

        $user = DB::table('users')->where('email', $request->email)->first();

        Customer::create(
            $request->only(['date_of_birth', 'gender']) + ["user_id" => $user->id]
        );

        return response()->json([
            'success' => true,
            'data' => $user,
        ], 200);
    }

    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $jwt_token = null;


        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }

        return response()->json([
            'success' => true,
            'token' => $jwt_token,
        ]);
    }
}
