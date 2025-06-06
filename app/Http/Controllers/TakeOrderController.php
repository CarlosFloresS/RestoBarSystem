<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TakeOrderController extends Controller
{
    public function create()
    {
        return view('take-orders.create');
    }
}
