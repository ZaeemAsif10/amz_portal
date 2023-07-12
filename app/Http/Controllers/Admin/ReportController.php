<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $qry = User::query();
        $qry = $qry->join('orders', 'users.id', '=', 'orders.user_id');
        $qry = $qry->join('products', 'orders.product_no', '=', 'products.product_no');
        $qry = $qry->select(
            'users.*',
            'orders.c_email',
            'orders.order_limit',
            'orders.order_no',
            'orders.refund_date',
            'orders.review_date',
            'orders.status',
            'orders.date',
            'products.market',
            'products.chi_seller',
            'products.commission',
            'products.prod_type',
            'products.pmnl_commission'
        );

        $qry = $qry->where('users.role','pm');
        $qry = $qry->where('orders.status', $request->status);
        $qry = $qry->orderBy('id', 'asc');

        if ($request->isMethod('post')) {

            $month = $request->month;
            $year = $request->year;

            $qry->when($request->status, function ($query, $status) {
                return $query->where('orders.status', $status);
            });

            $qry->when($month, function ($query, $month) {
                return $query->whereMonth('orders.date', $month);
            });

            $qry->when($year, function ($query, $year) {
                return $query->whereYear('orders.date', $year);
            });

            $data['reports'] = $qry->get();
            return view('report.index', compact('data'));
        }

        $data['reports'] = [];
        return view('report.index', compact('data'));
    }
}
