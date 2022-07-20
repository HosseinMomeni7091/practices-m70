<?php

namespace App\Http\Resources;

use App\Http\Resources\ScheduleResource;
use App\Http\Resources\RestAddressResource;
use App\Http\Resources\RestCategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
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
            'phone' => $this->phone,
            'freight' => $this->freight,
            'score' => $this->score,
            'bank account' => $this->bank_account,
            'is_active' => $this->is_active,
            'restaurant Category' => new RestCategoryResource($this->restcategory),
            'Schedule' => new ScheduleResource($this->schedule),
            'Address' => new RestAddressResource($this->restaddress),
        ];
    }
}
