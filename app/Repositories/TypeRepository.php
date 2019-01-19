<?php

namespace App\Repositories;

use App\FileType;

class TypeRepository extends ResourceRepository
{

    public function __construct(FileType $fileType)
	{
		$this->model = $fileType;
	}


}