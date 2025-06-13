<?php

namespace App\Http\Controllers;

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
            'status' => 'pending',
        ]);

        return $order->load('menuEntry');
    }

    public function update(Order $order, Request $request)
    {
        $quantity = $request->input('quantity');

        // Si la cantidad es 0 o menor, eliminar el pedido
        if ($quantity <= 0) {
            $orderId = $order->id;
            $order->delete();
            return response()->json(['deleted' => true, 'id' => $orderId]);
        }

        // Si no, actualizar normalmente
        $order->update(['quantity' => $quantity]);
        return $order;
    }
}
