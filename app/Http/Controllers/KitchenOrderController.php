<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KitchenOrderController extends Controller
{
   public function index()
   {
       return view('kitchen.index');
   }
}
