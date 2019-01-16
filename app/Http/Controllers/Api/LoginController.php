<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController as ApiController;
use App\Repositories\UserRepository;
use Validator;
use App\User;
use Session;

class LoginController extends ApiController {

    function validation(Request $request)
    {
        $input = $request->all();
        $phoneNum = $input['phone_num'];
        $user = User::where('phone_number', '=', $phoneNum)->firstOrFail();
        if($user)
        {
            Session::put('phoneNum', $phoneNum);
            $user->sendToken();
            $test = Session::get('token');
            return $this->apiResponseSuccess($test, 'User retrieved successfully.');
        } else
        {
            return $this->apiResponseError('User not found.');
        }

    }

    function login(Request $request)
    {
        $input = $request->all();
        $token = $input['token'];
        $phoneNum = Session::get('phoneNum');
        $user = User::where('phone_number', '=', $phoneNum)->firstOrFail();
        if($user && $user->validateToken($token)) {
            return $this->apiResponseSuccess($user->toArray(), 'User connected successfully.');
        } else {
            return $this->apiResponseError('Error.');
        }
    }
}