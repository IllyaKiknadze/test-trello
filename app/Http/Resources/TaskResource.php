<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            '_id'         => $this->_id,
            'title'       => $this->title,
            'description' => $this->description,
            'labels'      => $this->labels,
            'images'      => $this->images,
            'status'      => StatusResource::make($this->status),
            'worker'      => UserResource::make($this->worker)
        ];
    }
}
