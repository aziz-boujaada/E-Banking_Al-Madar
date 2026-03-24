<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
   
    public function register(RegisterRequest $request): JsonResponse
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
        ], 201);
    }

   
    public function login(LoginRequest $request) :JsonResponse
    {

         $data = $request->only('email' , 'password');
       if(!Auth::attempt($data)){
          return response()->json([
            'status' => 'failed',
            'message' => 'invalid email or password'
          ],401);
       }

       $user = User::where('email' , $data['email'])->first();
       $token = JWTAuth::fromUser($user);

       return response()->json([
          'status' => 'success',
          'message' => 'You are Logged in with success',
          'token' => $token
       ],200);



    }

  
    public function logout(): JsonResponse
    {

        Auth::logout();

        return response()->json([
            'message' => 'Logout successful',
        ], 200);
    }
}
