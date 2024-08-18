<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'table'=> new TableResource($this->table),
            'customer'=>new CustomerResource($this->customer),
            'form_time' => $this->from_time,
            'to_time' => $this->to_time,
        ];
    }
}
 