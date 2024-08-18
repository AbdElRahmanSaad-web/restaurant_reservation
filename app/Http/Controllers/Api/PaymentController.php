<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function pay(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        $request->validate([
            'payment_method' => 'required|in:method_1,method_2',
        ]);

        $totalAmount = $order->orderDetails->sum('amount_to_pay');

        if ($request->payment_method == 'method_1') {
            $totalAmount += $totalAmount * 0.14; // 14% taxes
            $totalAmount += $totalAmount * 0.20; // 20% service charge
        } else {
            $totalAmount += $totalAmount * 0.15; // 15% service charge
        }

        $order->update([
            'paid' => true,
            'total' => $totalAmount,
        ]);

        return response()->json(['message' => 'Payment successful', 'total_amount' => $totalAmount]);
    }
}
