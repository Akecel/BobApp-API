<?php

namespace App\Http\Resources\FolderCategory;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\FileType\FileType as FileTypeResource;

class FolderCategory extends JsonResource
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
            'type' => 'category',
            'id' => (string)$this->id,
            'attributes' => [
                'title' => $this->title,
            ],
            'relationships' => new FolderCategoryRelationshipResource($this),
            'links' => [
                'self' => route('category.show', ['category' => $this->id]),
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
        $included = [];

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
                $modelRelation = get_class($this->{$nameRelation}()->getRelated());
                if($nameRelation == "files_types") {
                    $relationships[$nameRelation][] = $relation->mapInto(FileTypeResource::class);
                } 
            }
        }
        return $relationships;
    }
}
