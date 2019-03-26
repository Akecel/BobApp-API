<?php

namespace App\Http\Resources\FileType;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\File\File as FileResource;
use App\Http\Resources\FolderCategory\FolderCategory as FolderCategoryResource;

class FileType extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

     
    public function toArray($request)
    {
        return [
            'type' => 'file_type',
            'id' => (string)$this->id,
            'attributes' => [
                'title' => $this->title,
            ],
            'relationships' => new FileTypeRelationshipResource($this),
            'links' => [
                'self' => route('type.show', ['type' => $this->id]),
            ],
        ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function with($request) 
    {
        if ($request->has('include')) {
            return [
                'included' => [
                    $this->withIncluded()
                ],
                'links' => [
                    'self' => $request->fullUrl(),
                ]
            ];
        }
        else return [];
    }

    /**
     * Retrieve the relationships that have been included.
     *
     * @return array
     */

    private function withIncluded(): array
    {
        $relationships = [];

        $relations = $this->getRelations();

        if (!empty($relations)) {
            foreach ($relations as $nameRelation => $relation) {
                get_class($this->{$nameRelation}()->getRelated());
                if($nameRelation == "folder_category") {
                    $relationships[$nameRelation][] = new FolderCategoryResource($relation);
                } 
                elseif ($nameRelation == 'files') {
                    $relationships[$nameRelation][] = $relation->mapInto(FileResource::class);
                }
            }
        }
        return $relationships;
    }
}
