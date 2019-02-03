<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Folder\FolderCollection;
use App\Http\Resources\File\FileCollection;

use App\User;

class UserRelationshipController extends Controller
{
    public function folders(User $user)
    {
        return new FolderCollection($user->folders);
    }

    public function files(User $user)
    {
        return new FileCollection($user->files);
    }
}