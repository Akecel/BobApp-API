<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController as ApiController;
use App\Repositories\UserRepository;
use App\Http\Resources\User\User as UserResource;
use App\Http\Resources\User\UserCollection;
use Validator;
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

    public function index(Request $request)
    {
        if ($request->has('include')) {
            $withs = explode(',', $request->include);
        }
        $users = new UserCollection(User::with($withs)->get());
        return $this->apiResponse200($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|max:255',
        ]);
        if($validator->fails()){
            return $this->apiResponse403('Validation Error', $validator->errors());       
        }
        $this->setAdmin($request);
        $store = $this->userRepository->store($request->all());
        $user = new UserResource($store);
        return $this->apiResponse201($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(User $user)
    {
        $user = new UserResource($user);
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

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|max:255',
        ]);
        if($validator->fails()){
            return $this->apiResponse403('Validation Error', $validator->errors());       
        }
        $this->setAdmin($request);
        $this->userRepository->update($id, $request->all());
        $user = new UserResource(User::find($id));
        return $this->apiResponse200($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return $this->apiResponse404('User do not exist');
        }
        Storage::deleteDirectory('user_files_' . $id);
        $this->userRepository->destroy($id);
        return $this->apiResponse204();
    }

    /**
     * Set user as Admin.
     */

    private function setAdmin($request)
    {
        if(!$request->has('admin'))
        {
            $request->merge(['admin' => 0]);
        }       
    }
    
}
