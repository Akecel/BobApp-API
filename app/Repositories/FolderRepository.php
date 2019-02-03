<?php

namespace App\Repositories;

use App\Models\Folder;

class FolderRepository extends ResourceRepository
{

    public function __construct(Folder $folder)
	{
		$this->model = $folder;
	}

	public function getByIdWithFiles($id)
	{
		return $this->model->with('files')->find($id);
	}


}