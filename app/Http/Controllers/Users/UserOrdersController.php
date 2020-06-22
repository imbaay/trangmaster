<?php

namespace App\Http\Controllers\Users;

use App\Donhang;
use App\Chitietdonhang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserOrdersController extends UsersBaseController
{
    public function myOrders()
    {
        $userId = Auth::user()->id;
        $myOrders = Donhang::where('user_id', $userId)->latest()->get();
        return view('public.users.orders', compact('myOrders'));
    }
    public function order_details($id)
    {
        $order = Donhang::findOrFail($id);
        $order_details = Chitietdonhang::where('order_id', $id)->get();

        return view('public.users.order-details', compact('order_details', 'order'));
    }
}
