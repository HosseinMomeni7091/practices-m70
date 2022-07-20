<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FoodResource extends JsonResource
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
            'name' => $this->name,
            'raw' => $this->raw,
            'price' => $this->price,
            'score' => $this->score,
            'discount' => $this->discount,
            // 'restaurant Category' => new RestCategoryResource($this->restcategory),
            // 'Schedule' => new ScheduleResource($this->schedule),
            // 'Address' => new RestAddressResource($this->restaddress),
        ];
    }
}
