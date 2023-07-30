<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebController extends Controller
{
    public function index(Request $request)
    {
        $qry = Product::query();
        $qry = $qry->select(
            'id',
            'keyword',
            'product_no',
            'market',
            'tot_remaining',
            'tot_sale',
            'image',
        );

        // return $qry->get();


        if ($request->isMethod('post')) {

            $qry->when($request->product_no, function ($query, $product_no) {
                return $query->where('product_no', $product_no);
            });

            $qry->when($request->market, function ($query, $market) {
                return $query->where('market', $market);
            });

            $qry->when($request->prod_type, function ($query, $prod_type) {
                return $query->where('prod_type', $prod_type);
            });

            $qry->when($request->keyword, function ($query, $keyword) {
                return $query->where('keyword', 'like', '%' . $keyword . '%');
            });
        }

        $qry = $qry->latest();
        $data['products'] = $qry->paginate(30);
        return view('web-side.index', compact('data'));
    }
}
