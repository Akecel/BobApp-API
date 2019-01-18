<?php

namespace App\Repositories;

use App\User;

class UserRepository extends ResourceRepository
{

    public function __construct(User $user)
	{
		$this->model = $user;
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