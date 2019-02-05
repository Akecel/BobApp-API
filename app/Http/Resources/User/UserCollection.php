<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class UserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $included = $this->withIncluded($this);

        return[
            'data' => $this->collection,
            'links' => [
                'self' => url()->current(),
            ],
            $this->mergeWhen($included->isNotEmpty(), [
                'included' => $included
            ])
        ];
    }

    private function withIncluded($include)
    {
        return $include->collection->flatMap(
            function ($resource) {
                return $resource->whenLoaded('folders');
            }
        )->unique('id');
    }
}
