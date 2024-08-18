<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReservationResource;
use App\Http\Resources\TableResource;
use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function checkAvailability(Request $request)
    {
        $request->validate([
            'from_time' => 'required|date',
            'to_time' => 'required|date|after:from_time',
            'guests' => 'required|integer',
        ]);

        $availableTables = Table::whereDoesntHave('reservations', function ($query) use ($request) {
            $query->whereBetween('from_time', [$request->from_time, $request->to_time])
                ->orWhereBetween('to_time', [$request->from_time, $request->to_time]);
        })->where('capacity', '>=', $request->guests)->get();

        return response()->json(['data'=> TableResource::collection($availableTables)]);
    }

    public function reserveTable(Request $request)
    {
        $request->validate([
            'table_id' => 'required|exists:tables,id',
            'customer_id' => 'required|exists:customers,id',
            'from_time' => 'required|date',
            'to_time' => 'required|date|after:from_time',
        ]);

        $reservation = Reservation::create($request->all());

        return response()->json(['data' => new ReservationResource($reservation)], 201);
    }
}
