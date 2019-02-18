<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Validator;

use App\Http\Controllers\Api\ApiController;

use App\Repositories\UserRepository;
use App\Http\Resources\User\User as UserResource;
use App\Http\Resources\User\UserCollection;
use App\Models\User;

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

    public function index(Request $request, User $user)
    {
        $this->authorize('adminManage', $user);
        $users = new UserCollection(User::with($this->getIncluded($request))->get());
        return $this->apiResponse200($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request, User $user)
    {
        $this->authorize('adminManage', $user);
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|max:255',
        ]);
        if($validator->fails()){
            return $this->apiResponse403('Validation Error', $validator->errors());       
        }
        $this->setAdmin($request,$user);
        $store = $this->userRepository->store($request->all());
        $id = $store['id'];
        $directory = "/user_files_" . $id;
        Storage::disk('public')->makeDirectory($directory);
        $user = new UserResource($store);
        return $this->apiResponse201($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(Request $request, User $user)
    {
        $this->authorize('manage', $user);
        $user = new UserResource(User::with($this->getIncluded($request))->find($user->id));
        if (is_null($user)) {
            return $this->apiResponse404('User not found');
        }
        return $this->apiResponse200($user);
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
        $this->authorize('manage', $user);
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|max:255',
        ]);
        if($validator->fails()){
            return $this->apiResponse403('Validation Error', $validator->errors());       
        }
        $this->setAdmin($request, $user);
        $this->userRepository->update($user->id, $request->all());
        $user = new UserResource(User::find($user->id));
        return $this->apiResponse200($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(User $user)
    {
        $this->authorize('manage', $user);
        $id = 
        $user = User::find($user->id);
        if (is_null($user)) {
            return $this->apiResponse404('User do not exist');
        }
        Storage::deleteDirectory('user_files_' . $user->id);
        $this->userRepository->destroy($user->id);
        return $this->apiResponse204();
    }

    /**
     * Set user as Admin.
     */

    private function setAdmin(Request $request, User $user)
    {
        $this->authorize('adminManage', $user);
        if(!$request->has('admin'))
        {
            $request->merge(['admin' => 0]);
        }       
    }
    
}
