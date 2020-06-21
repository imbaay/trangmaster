<?php

namespace App\Http\Controllers\Admin;

use App\Dienthoai;
use App\Donhang;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminBaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $users = User::all();
        $books_quantity = Dienthoai::sum('quantity');
        $total_earning = Donhang::where('order_status', 1)->sum('total_price');
        $pending_orders = Donhang::where('order_status', 0)->get();
        return view('admin.dashboard', compact('users', 'books_quantity', 'total_earning', 'pending_orders'));
    }

}
