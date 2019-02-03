<?php
namespace App\Http\Resources\Folder;

use App\Http\Resources\User\UserIdentifierResource;
use App\Http\Resources\File\FileIdentifierResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FolderRelationshipResource extends JsonResource
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
            'user' => [
                'links' => [
                    'self' => route('folder.relationships.user', ['folder' => $this->id]),
                    'related' => route('folder.user', ['folder' => $this->id]),
                ],
                'data' =>  new UserIdentifierResource($this->user),
            ],
            'files' => [
                'links' => [
                    'self' => route('folder.relationships.files', ['folder' => $this->id]),
                    'related' => route('folder.files', ['folder' => $this->id]),
                ],
                'data' => FileIdentifierResource::collection($this->files),
            ],
        ];
    }
}