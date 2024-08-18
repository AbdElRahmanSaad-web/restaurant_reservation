<?php

namespace App\Http\Resources;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'table' => new TableResource($this->table),
            'reservation' => new ReservationResource($this->reservation),
            'user' => $this->user,
            'total' => $this->total,
            'paid' => ($this->paid),
            'date' => $this->date,
        ];
    }
}
