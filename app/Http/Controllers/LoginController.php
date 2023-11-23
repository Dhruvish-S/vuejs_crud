<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function check(Request $request ,User $user)
    {
        // $credentials = $request->validate([
        //     'email' => 'required',
        //     'password' => 'required',
        // ]);

        $requestData = $request->all();
        $validator = Validator::make($requestData,[
            'email' => 'email|required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        if(! auth()->attempt($requestData)){
            return response()->json(['error' => 'UnAuthorised Access'], 401);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response(['user' => auth()->user(), 'access_token' => $accessToken], 200);


    }
    public function me(Request $request)
    {
        $user = $request->user();

        return response()->json(['user' => $user], 200);
    }
    public function logout (Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }

}
