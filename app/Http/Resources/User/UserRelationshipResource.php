<?php
namespace App\Http\Resources\User;

use App\Http\Resources\Folder\FolderIdentifierResource;
use App\Http\Resources\File\FileIdentifierResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserRelationshipResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'folders' => [
                'links' => [
                    'self' => route('user.relationships.folders', ['user' => $this->id]),
                    'related' => route('user.folders', ['user' => $this->id]),
                ],
                'data' => FolderIdentifierResource::collection($this->folders),
            ],
            'files' => [
                'links' => [
                    'self' => route('user.relationships.files', ['user' => $this->id]),
                    'related' => route('user.files', ['user' => $this->id]),
                ],
                'data' => FileIdentifierResource::collection($this->files),
            ],
        ];
    }
}