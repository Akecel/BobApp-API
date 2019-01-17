<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController as ApiController;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;
use Validator;
use App\User;
use Session;

class AuthController extends ApiController {

    function validation(Request $request)
    {
        $input = $request->all();
        $phoneNum = $input['phone_num'];
        $user = User::firstOrCreate(['phone_number' => $phoneNum]);
        if($user)
        {
            Session::put('phoneNum', $phoneNum);
            $user->sendToken();
            $webToken = Session::get('token');
            return $this->apiResponseSuccess($webToken, 'User retrieved successfully.');
        } else
        {
            return $this->apiResponseError('User not found or bad number.');
        }

    }

    function login(Request $request)
    {
        $input = $request->all();
        $token = $input['token'];
        $phoneNum = Session::get('phoneNum');
        $user = User::where('phone_number', '=', $phoneNum)->firstOrFail();
        if($user && $user->validateToken($token)) {
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success['user'] =  $user;
            return $this->apiResponseSuccess($success, 'User connected successfully.');
        } else {
            return $this->apiResponseError('Error :  Wrong token or phone number.');
        }
    }

    function logout()
    {
        Auth::logout();
        return $this->apiResponseSuccess('Disconnection', 'User disconnected successfully.');
    }
}