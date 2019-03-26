<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Validator;
use Session;

use App\Http\Controllers\Api\ApiController;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Http\Resources\User\User as UserResource;


class AuthController extends ApiController {

    /**
     * 
     * Select or create user and send token
     *
     */

    function validation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_num' => 'required|max:255',
        ]);
        if($validator->fails()){
            return $this->apiResponse403('Validation Error', $validator->errors());       
        }
        $input = $request->all();
        $phoneNum = $input['phone_num'];
        $user = User::firstOrCreate(['phone_number' => $phoneNum]);
        if($user)
        {
            Session::put('phoneNum', $phoneNum);
            $user->sendToken();
            $webToken = Session::get('token');
            return $this->apiResponse200($webToken);
        } else
        {
            return $this->apiResponse404('User not found');
        }

    }

    /**
     * 
     * Log user (Mobile).
     *
     */

    function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required|max:255',
        ]);
        if($validator->fails()){
            return $this->apiResponse403('Validation Error', $validator->errors());       
        }
        $input = $request->all();
        $token = $input['token'];
        $phoneNum = Session::get('phoneNum');
        $user = User::where('phone_number', '=', $phoneNum)->firstOrFail();
        if($user && $user->validateToken($token)) {
            $id = $user['id'];
            $directory = "/user_files_" . $id;
            Storage::disk('public')->makeDirectory($directory);
            $success['token'] =  $user->createToken('BobApp')->accessToken;
            $success['user'] =  new UserResource($user);
            return $this->apiResponse200($success);
        } else {
            return $this->apiResponse404('Wrong token');
        }
    }

    /**
     * 
     * Log user (Backoffice).
     *
     */

    public function signin(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:255',
            'password' => 'required|max:255',
        ]);
        if($validator->fails()){
            return $this->apiResponse403('Validation Error', $validator->errors());       
        } 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user();
            if ($user->admin == 1) {
                $success['token'] =  $user->createToken('BobApp')->accessToken;
                return $this->apiResponse200($success);
            } 
            else {
                return $this->apiResponse403('Unautorized');
            }
        } 
        else{ 
            return $this->apiResponse403('Wrong login or password');
        } 
    }

    /**
     * 
     * Logout user.
     *
     */

    public function logout() { 
        $user = Auth::user()->token();
        $user->revoke();
        return $this->apiResponse204();
    }

    /**
     * 
     * Auth user resource.
     *
     */

    public function user() { 
        $user = Auth::user();
        return new UserResource($user);
    }

}