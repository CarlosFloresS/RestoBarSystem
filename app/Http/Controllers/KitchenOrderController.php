<?php

namespace App\Http\Controllers;

use App\Enums\orderStatus;
use App\Models\Order;
use Illuminate\Http\Request;

class KitchenOrderController extends Controller
{
   public function index()
   {
       return view('kitchen.index',[
           'pendingOrders' => Order::with(['menuEntry', 'table'])
               ->where('status', orderStatus::Pending)
               ->get(),
           'preparingOrders' => Order::with(['menuEntry', 'table'])
               ->where('status', orderStatus::Preparing)
               ->get(),
           'completedOrders' => Order::with(['menuEntry', 'table'])
               ->where('status', orderStatus::Completed)
               ->get()
       ]);
   }
}
