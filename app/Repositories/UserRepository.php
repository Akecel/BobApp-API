<?php

namespace App\Repositories;

use App\User;
use App\UserInfo;

class UserRepository extends ResourceRepository
{

    public function __construct(User $user)
	{
		$this->model = $user;
	}
	public function getAllSelect()
	{
		return UserInfo::pluck('lastName', 'user_id');
	}

	public function updateUserInfo($id, Array $inputs)
	{
		$user = $this->getById($id);
		$user->userinfo()->update($inputs);
	}

	public function updateUserAddress($id, Array $inputs)
	{
		$user = $this->getById($id);
		$user->address()->update($inputs);
	}

	public function saveUserInfo($user, $inputs)
	{
		$user->userinfo()->create($inputs);
	}

	public function saveUserAddress($user, $inputs)
	{
		$user->address()->create($inputs);
	}

}