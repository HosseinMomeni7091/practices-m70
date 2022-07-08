<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
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
            'sat' => $this->sat_start."-".$this->sat_end,
            'sun' => $this->sun_start."-".$this->sun_end,
            'mon' => $this->mon_start."-".$this->mon_end,
            'tue' => $this->tues_start."-".$this->tues_end,
            'wed' => $this->wednes_start."-".$this->wednes_end,
            'thur' => $this->thurs_start."-".$this->thurs_end,
            'fri' => $this->fri_start."-".$this->fri_end,
        ];
    }
}
