<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class UserResource
 * @package App\Http\Resources
 *
 * @OA\Schema(
 *    schema="UserResource",
 *    title="UserResource"
 * )
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            /**
             * @OA\Property(
             *     property="id",
             *     type="string"
             * )
             */
            'id'       => $this->_id,
            /**
             * @OA\Property(
             *     property="email",
             *     type="string"
             * )
             */
            'email'    => $this->email,
            /**
             * @OA\Property(
             *     property="name",
             *     type="string"
             * )
             */
            'name'     => $this->name,
            /**
             * @OA\Property(
             *     property="verified",
             *     type="boolean"
             * )
             */
            'verified' => $this->email_verified_at ?? false,
        ];
    }
}
