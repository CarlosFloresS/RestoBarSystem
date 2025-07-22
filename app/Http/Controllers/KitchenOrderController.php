<?php

namespace App\Http\Controllers;

use App\Enums\orderStatus;
use App\Models\Order;
use Illuminate\Http\Request;

class KitchenOrderController extends Controller
{
    public function index(Request $request)
    {
        $pendingOrders = Order::with(['menuEntry', 'table'])
            ->where('status', orderStatus::Pending)
            ->latest()
            ->get();

        $preparingOrders = Order::with(['menuEntry', 'table'])
            ->where('status', orderStatus::Preparing)
            ->latest()
            ->get();

        $completedOrders = Order::with(['menuEntry', 'table'])
            ->where('status', orderStatus::Completed)
            ->latest()
            ->take(10)
            ->get();

        if ($request->wantsJson()) {
            return response()->json([
                'pendingOrders' => $pendingOrders,
                'preparingOrders' => $preparingOrders,
                'completedOrders' => $completedOrders,
            ]);
        }

        return view('kitchen.index', [
            'pendingOrders' => $pendingOrders,
            'preparingOrders' => $preparingOrders,
            'completedOrders' => $completedOrders,

            'orderStatus' => orderStatus::toArray(),
        ]);
    }
}
