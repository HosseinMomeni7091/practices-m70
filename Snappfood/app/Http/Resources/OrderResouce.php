<?php

namespace App\Http\Resources;

use App\Http\Resources\RestaurantResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResouce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'ID' => $this->id,
            'Total Cost' => $this->cost,
            'Total Quantity' => $this->quantity,
            'Latest Status' => $this->status,
            'Restaurant info' => new RestaurantResource($this->restaurant),
            'All food' => FoodResource::collection($this->foods),
            'Created at' => $this->created_at,
            'Updated at' => $this->updated_at,
        ];
    }
}
