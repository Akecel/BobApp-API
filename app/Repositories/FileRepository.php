<?php

namespace App\Repositories;

use App\File;

class FileRepository extends ResourceRepository
{

    public function __construct(File $file)
	{
		$this->model = $file;
	}


}