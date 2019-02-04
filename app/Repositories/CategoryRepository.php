<?php

namespace App\Repositories;

use App\Models\FolderCategory;

class CategoryRepository extends ResourceRepository
{

    public function __construct(FolderCategory $folderCategory)
	{
		$this->model = $folderCategory;
	}


}