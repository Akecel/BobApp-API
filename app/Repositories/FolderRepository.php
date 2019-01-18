<?php

namespace App\Repositories;

use App\Folder;

class FolderRepository extends ResourceRepository
{

    public function __construct(Folder $folder)
	{
		$this->model = $folder;
	}


}