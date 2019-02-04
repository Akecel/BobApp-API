<?php
namespace App\Http\Resources\FolderCategory;

use App\Http\Resources\FileType\FileTypeIdentifierResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FolderCategoryRelationshipResource extends JsonResource
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
            'type' => [
                'links' => [
                    'self' => route('category.relationships.types', ['category' => $this->id]),
                    'related' => route('category.types', ['category' => $this->id]),
                ],
                'data' => FileTypeIdentifierResource::collection($this->files_types),
            ],
        ];
    }
}