<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\Http\Requests\Api\RegisterUserRequest;
use App\Http\Requests\Api\UpdateUserRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiController extends Controller
{
    // public $loginAfterSignUp = true;

    public function register(RegisterUserRequest $request)
    {
        $password = bcrypt($request->password);

        $customer = Customer::create(
            $request->only(['date_of_birth', 'gender'])
        );

        $customer->user()->save(User::create($request->only(['name', 'email']) + ["password" => $password]));

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

//    public function edit(User $user)
//    {
//        return redirect()->route('user.update', [
//            'user' => $user
//        ]);
//    }

    public function update(User $user, UpdateUserRequest $request)
    {
        $password = bcrypt($request->password);

        $customer = Customer::findOrFail($user->role_id);

        $customer->user()->update($request->only('name') + ['password' => $password]);

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
