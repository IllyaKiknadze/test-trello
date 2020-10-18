<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class BoardResource
 * @package App\Http\Resources
 *
 * @OA\Schema(
 *    schema="BoardResource",
 *    title="BoardResource"
 * )
 */
class BoardResource extends JsonResource
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
            'id'    => $this->_id,
            /**
             * @OA\Property(
             *     property="title",
             *     type="string"
             * )
             */
            'title' => $this->title,
            /**
             * @OA\Property(
             *     property="owner",
             *     ref="#/components/schemas/UserResource"
             * )
             */
            'owner' => UserResource::make($this->owner)
        ];
    }
}
