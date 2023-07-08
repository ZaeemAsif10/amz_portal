<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['completed'] = Order::where('status','Completed')->count();
        $data['cancelled'] = Order::where('status','Cancelled')->count();
        $data['refunded'] = Order::where('status','Refunded')->count();
        $data['ordered'] = Order::where('status','Ordered')->count();
        return view('home', compact('data'));
    }
}
