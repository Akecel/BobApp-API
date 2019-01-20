<?php

namespace App\Repositories;

use App\User;

class UserRepository extends ResourceRepository
{

    public function __construct(User $user)
	{
		$this->model = $user;
	}
	public function getAllSelect()
	{
		return $this->model->pluck('email', 'id');
	}

}