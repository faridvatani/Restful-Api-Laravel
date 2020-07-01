<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\User as UserResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function login(Request $request)
    {
        //validation data
        $validata = $this->validate($request, [
           'email' => 'required|exists:users',
           'password' => 'required',
        ]);
        //check login user
        if (! auth()->attempt($validata)){
            return response([
                'data' => 'اطلاعات صحیح نیست',
                'status' => 'error'
            ],403);
        }
        // update token for every login
//        auth()->user()->update([
//            'api_token' => Str::random(100),
//        ]);

        //use one token for every users
//        auth()->user()->tokens()->delete();

        $token = auth()->user()->createToken('api token for android')->accessToken;
        return new UserResource(auth()->user(), $token);
    }

    public function register(Request $request)
    {
        // Validation Data
        $validData = $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $validData['name'],
            'email' => $validData['email'],
            'api_token' => Str::random(100),
            'password' => bcrypt($validData['password']),
        ]);

        return new UserResource($user);
    }
}
