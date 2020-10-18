<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id'       => $this->_id,
            'email'    => $this->email,
            'name'     => $this->name,
            'verified' => isset($this->email_verified_at) && !empty($this->email_verified_at),
        ];
    }
}
