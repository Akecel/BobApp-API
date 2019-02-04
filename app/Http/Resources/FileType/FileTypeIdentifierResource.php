<?php

namespace App\Http\Resources\FileType;

use Illuminate\Http\Resources\Json\JsonResource;

class FileTypeIdentifierResource extends JsonResource
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
        ];
    }
}