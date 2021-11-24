<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index($id){

        $order = Order::findOrFail($id);

        $order->update([

            'print' => 1

        ]);

        return view('admin.pages.invoice.index' , compact('order'));

    }
}
