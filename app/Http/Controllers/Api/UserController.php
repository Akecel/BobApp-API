<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController as ApiController;
use App\Repositories\UserRepository;
use Validator;
use App\User;

class UserController extends ApiController
{
    /**
     * Set User Repository.
     * Constructor
     */

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $users = User::with('userinfo','address')->get();
        return $this->apiResponseSuccess($users, 'Users retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     
    NOT NEEDED FOR USER, USER ARE STORED IN AUTHCONTROLLER

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'phone_number' => 'required|max:255|unique:users',
            'email' => 'max:255|unique:users',
            'password' => 'confirmed|min:4|max:6',
            'c_password' => 'same:password'
        ]);
        if($validator->fails()){
            return $this->apiResponseError('Validation Error.', $validator->errors());       
        }
        $success['phone_number'] =  $user->phone_number;
        $success['email'] =  $user->email;
        $user = $this->userRepository->store($request->all());
        return $this->apiResponseSuccess($success, 'User created successfully.');
    }

    */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $user = User::with('userinfo','address')->find($id);
        if (is_null($user)) {
            return $this->apiResponseError('User not found.');
        }
        return $this->apiResponseSuccess($user->toArray(), 'User retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, User $user)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'email' => 'required',
            'phone_number' => 'required'
        ]);
        if($validator->fails()){
            return $this->apiResponseError('Validation Error.', $validator->errors());       
        }
        $user->phone = $input['phone_number'];
        $user->detail = $input['email'];
        $user->save();
        return $this->apiResponseSuccess($user->toArray(), 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $this->userRepository->destroy($id);
        return $this->apiResponseSuccess($user->toArray(), 'User deleted successfully.');
    }
    
}
