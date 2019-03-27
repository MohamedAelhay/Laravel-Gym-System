<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\Http\Requests\Api\RegisterUserRequest;
use App\Http\Requests\Api\UpdateUserRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Storage;


class ApiController extends Controller
{
    // public $loginAfterSignUp = true;

    /**
     * @param RegisterUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterUserRequest $request)
    {
        $password = bcrypt($request->password);

        $path = Storage::putFile('public/customer', $request->file('img'));

        $customer = Customer::create(
            $request->only(['date_of_birth', 'gender'])
        );

        $customer->user()->save(User::create(
            $request->only(['name', 'email']) +
            [
                "password" => $password,
                "img" => $path,
            ]));

        $user = User::where('email', $request->email)->first();

        $user->sendEmailVerificationNotification();

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

    public function update(UpdateUserRequest $request)
    {
        $password = bcrypt($request->password);

        $path = Storage::putFile('public/customer', $request->file('img'));

        $customer = Customer::findOrFail(Auth::User()->role_id);

        $customer->user()->update($request->only('name') +
            [
                'password' => $password,
                'img' => $path
                ]);

        $customer->update($request->only('gender', 'date_of_birth'));

        return response()->json([
            'message' => 'User Updated'
        ], 201);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
