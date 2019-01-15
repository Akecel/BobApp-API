<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController as ApiController;
use App\Repositories\UserRepository;
use Validator;
use App\User;
use App\UserInfo;

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
        $users = User::all();
        return $this->apiResponseSuccess($users->toArray(), 'Users retrieved successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return $this->apiResponseError('Create Error.', 'Nothing to send'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'c_password' => 'required|same:password'
        ]);
        if($validator->fails()){
            return $this->apiResponseError('Validation Error.', $validator->errors());       
        }
        $user = $this->userRepository->store($request->all());
        $success['name'] =  $user->name;
        $success['email'] =  $user->email;
        //$user = User::create($input);
        return $this->apiResponseSuccess($success, 'User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return $this->apiResponseError('User not found.');
        }
        return $this->apiResponseSuccess($user->toArray(), 'User retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $user = User::find($id);
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
            'name' => 'required',
            'email' => 'required'
        ]);
        if($validator->fails()){
            return $this->apiResponseError('Validation Error.', $validator->errors());       
        }
        $user->name = $input['name'];
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
