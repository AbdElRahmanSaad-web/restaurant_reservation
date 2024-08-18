<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Meal;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'customer_id' => 'required|exists:customers,id',
            'table_id' => 'required|exists:tables,id',
            'order_details' => 'required|array',
        ]);

        $orderData = $request->only('reservation_id', 'customer_id', 'table_id');
        $orderData['user_id'] = auth()->user()->id;
        $orderData['date'] = now();
    
        $order = Order::create($orderData);
        foreach ($request->order_details as $detail) {
            $meal = Meal::find($detail['meal_id']);
            
            if ($meal->available_quantity > 0) {
                $meal->available_quantity -= 1;
                $meal->save();
            } else {
                return response()->json(['error' => 'Meal is out of stock.'], 400);
            }
    
            $amountToPay = $meal->price - ($meal->price * ($meal->discount / 100));
            OrderDetails::create([
                'order_id' => $order->id,
                'meal_id' => $meal->id,
                'amount_to_pay' => $amountToPay,
            ]);
        }

        return response()->json(['data' => new OrderResource($order)], 201);
    }
}
