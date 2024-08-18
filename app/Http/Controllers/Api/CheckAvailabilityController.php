<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckAvailabilityController extends Controller
{
    public function check_availability(Request $request)
    {
        $request->validate([
            'table_id' => 'required|exists:tables,id',
            'from_time' => 'required|date_format:Y-m-d H:i:s', 
            'number_of_seats' => 'required|integer|min:1'
        ]);
    
        $table = \App\Models\Table::where('id', $request->table_id)
            ->where('capacity', '>=', $request->number_of_seats) 
            ->first();
    
        if (!$table) {
            return response()->json(['message' => 'Table is not available'], 409);
        } else {
            $hasOverlap = $table->reservations()
                ->where(function($query) use ($request) {
                    $query->where('from_time', '<=', $request->from_time)
                          ->where('to_time', '>=', $request->from_time);
                })
                ->exists();
    
            if ($hasOverlap) {
                return response()->json(['message' => 'Table is not available for the selected time'], 409);
            } else {
                return response()->json(['message' => 'Table is available'], 200);
            }
        }
    }
    
}
