<?php

namespace App\Http\Controllers;

use App\Enums\orderStatus;
use App\Models\MenuEntry;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;

class TakeOrderController extends Controller
{
    public function create(Table $table)
    {
        return view('take-orders.create', [
            'tables' => Table::get(),
            'selectedTable' => $table->load('orders.menuEntry'),
            'menuEntries' => MenuEntry::get(),
        ]);
    }

    public function store(Table $table, Request $request)
    {
        $order = Order::create([
            'table_id' => $table->id,
            'menu_entry_id' => $request->menu_entry_id,
            'quantity' => $request->quantity,
            'notes' => '',
            'status' => orderStatus::Pending,
        ]);

        return $order->load('menuEntry');
    }

    public function update(Order $order, Request $request)
    {
        $order->update([
            'quantity' => $request->input('quantity', $order->quantity),
            'notes'    => $request->input('notes',    $order->notes),
        ]);

        if ($order->quantity <= 0) {
            $order->delete();
            return response()->json(['deleted' => true]);
        }

        return response()->json([
            'deleted'  => false,
            'quantity' => $order->quantity,
            'notes'    => $order->notes,
        ]);
    }

}
