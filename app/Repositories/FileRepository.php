<?php

namespace App\Repositories;

use App\Models\File;

class FileRepository extends ResourceRepository
{

    public function __construct(File $file)
	{
		$this->model = $file;
	}


}