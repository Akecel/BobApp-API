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
        $users = new UserCollection(User::get());
        return $this->apiResponseSuccess($users, 'Users retrieved successfully.');
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
            return $this->apiResponseError('User not found.');
        }
        return $this->apiResponseSuccess($user, 'User retrieved successfully.');
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
        $this->userRepository->update($id, $request->all());
        $user = User::find($id);
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
        Storage::deleteDirectory('user_files_' . $id);
        $this->userRepository->destroy($id);
        return $this->apiResponseSuccess('User', 'User deleted successfully.');
    }
    
}
