<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $foods = $this->order->foods;
        $all = [];
        foreach ($foods as $key => $food) {
            $all[$key+1] =  $food->name;
        }
        return [
            "Id" => $this->id,
            "Food" =>$all,
            "User" => $this->user->name,
            "Order" => $this->order->id,
            "Comment" => $this->comment,
            "Reply" => $this->reply,
            "Score" => $this->score,
            "Status" => $this->status,
        ];
    }
}
