<?php

namespace App\Repositories;

use App\Models\FileType;

class TypeRepository extends ResourceRepository
{

    public function __construct(FileType $fileType)
	{
		$this->model = $fileType;
	}


}