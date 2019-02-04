<?php
namespace App\Http\Resources\FileType;

use App\Http\Resources\File\FileIdentifierResource;
use App\Http\Resources\FolderCategory\FolderCategoryIdentifierResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FileTypeRelationshipResource extends JsonResource
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
            'category' => [
                'links' => [
                    'self' => route('type.relationships.category', ['type' => $this->id]),
                    'related' => route('type.category', ['type' => $this->id]),
                ],
                'data' => new FolderCategoryIdentifierResource($this->folder_category),
            ],
            'files' => [
                'links' => [
                    'self' => route('type.relationships.files', ['type' => $this->id]),
                    'related' => route('type.files', ['type' => $this->id]),
                ],
                'data' => FileIdentifierResource::collection($this->files),
            ],
        ];
    }
}