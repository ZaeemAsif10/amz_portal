<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Reserve;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $qry = User::query();
        $qry = $qry->join('products', 'users.id', '=', 'products.user_id')
            ->select('products.*', 'users.id as pmm_id', 'users.seller_id', 'users.whats_number');

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

            $qry->when($request->chi_seller, function ($query, $chi_seller) {
                return $query->where('chi_seller', $chi_seller);
            });

            $qry->when($request->seller_id, function ($query, $seller_id) {
                return $query->where('users.seller_id', $seller_id);
            });
        }

        $qry = Auth::user()->role == 'pmm' ?
            $qry->where('products.user_id', Auth::user()->id) :
            $qry->orderBy('id','desc');

        $data['products'] = $qry->get();
        return view('product.product', compact('data'));
    }

    public function Enabled()
    {
        $qry = Product::query();
        $qry = $qry->where('status', 1);
        $qry = Auth::user()->role == 'pmm' ?
            $qry->where('user_id', Auth::user()->id) :
            $qry->latest();

        $data['products'] = $qry->get();
        return view('product.enabled', compact('data'));
    }

    public function Disabled()
    {
        $qry = Product::query();
        $qry = $qry->where('status', 0);
        $qry = Auth::user()->role == 'pmm' ?
            $qry->where('user_id', Auth::user()->id) :
            $qry->latest();

        $data['products'] = $qry->get();
        return view('product.disabled', compact('data'));
    }

    public function createProducts(Request $request)
    {
        $categories = Category::all();
        $data['product'] = User::where('id', $request->id)->first();;
        return view('product.create', compact('categories', 'data'));
    }

    public function storeProducts(Request $request)
    {
        if ($request->commission < $request->commission_val) {
            return back()->with('com_error', 'Minimum commission is ' . $request->commission_val);
        } else {
            $product = new Product();
            $product->user_id = Auth::user()->id;
            $product->pmm_id = $request->pmm_id;
            $product->keyword = $request->keyword;
            $product->brand_name = $request->brand_name;
            $product->amz_seller = $request->amz_seller;
            $product->market = $request->market;
            $product->chi_seller = $request->chi_seller;
            $product->cate_id = $request->cate_id;
            $product->prod_type = $request->prod_type;
            $product->commission = $request->commission;
            $product->pmnl_commission = $request->pmnl_commission;
            $product->day_sale = $request->day_sale;
            $product->tot_remaining = $request->day_sale;
            $product->text_fee_cover = $request->text_fee_cover ? 1 : 0;
            $product->paypal_fee_cover = $request->paypal_fee_cover ? 1 : 0;
            $unique_no = Product::orderBy('id', 'DESC')->pluck('product_no')->first();
            $product->tot_sale = $request->tot_sale;
            if ($unique_no == null or $unique_no == "") {
                #If Table is Empty
                $unique_no = 1;
            } else {
                #If Table has Already some Data
                $unique_no = $unique_no + 1;
            }
            $product->product_no = $unique_no;

            if ($request->hasFile('amz_image')) {
                $file = $request->file('amz_image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('public/uploads/amz/image/', $filename);
                $product->amz_image = $filename;
            }

            if ($request->hasFile('image')) {
                $file1 = $request->file('image');
                $extension1 = $file1->getClientOriginalExtension();
                $filename1 = time() . '.' . $extension1;
                $file1->move('public/uploads/image/', $filename1);
                $product->image = $filename1;
            }
            $res = $product->save();
            if ($res) {
                return back()->with('success', 'Product add successfully');
            } else {
                return back()->with('error', 'Something went wrong');
            }
        }
    }

    public function updateStatus(Request $request)
    {
        $change_status = Product::where('id', $request->id)->first();
        if ($change_status->status == 1) {
            $change_status->status = 0;
            $change_status->update();
        } else if ($change_status->status == 0) {
            $change_status->status = 1;
            $change_status->update();
        }
        return response()->json([
            'status' => 200,
            'message' => 'Status update successfully',
        ]);
    }

    public function productDetail($product_no)
    {
        $data['product_detail'] = Product::with('category')->where('product_no', $product_no)->first();
        $data['categories'] = Category::all();
        return view('product.product_detail', compact('data'));
    }

    public function updateProductDetail(Request $request)
    {
        $product = Product::where('product_no', $request->edit_detail_id)->first();
        $product->keyword = $request->keyword;
        $product->brand_name = $request->brand_name;
        $product->amz_seller = $request->amz_seller;
        $product->market = $request->market;
        $product->cate_id = $request->cate_id;
        $product->prod_type = $request->prod_type;
        $product->commission = $request->commission;


        if ($request->hasFile('amz_image')) {
            $path = 'public/uploads/amz/image/' . $product->amz_image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('amz_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/uploads/amz/image/', $filename);
            $product->amz_image = $filename;
        }

        if ($request->hasFile('image')) {
            $path = 'public/uploads/image/' . $product->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file1 = $request->file('image');
            $extension1 = $file1->getClientOriginalExtension();
            $filename1 = time() . '.' . $extension1;
            $file1->move('public/uploads/image/', $filename1);
            $product->image = $filename1;
        }
        $product->update();
        return back()->with('success', 'Product update successfully');
    }

    public function reserveNow(Request $request)
    {

        $reserve = new Reserve();
        $reserve->user_id = Auth::user()->id;
        $reserve->pmm_id = $request->pmm_id;
        $reserve->product_no = $request->product_no;
        $reserve->start_time = Carbon::now();
        $unique_check = Product::where('id', $request->id)->pluck('tot_remaining')->first();
        if ($unique_check > 0) {
            $reserve->save();
            $this->updateReserve($request);
            return back()->with('success', 'Product Reserve now');
        } else {
            return back()->with('error', 'Today remianing limit is zero');
        }
    }

    public function getRemainingTime($cellId)
    {
        // Fetch the countdown record from the database based on the cellId
        $countdown = Reserve::where('id', $cellId)->first();

        if ($countdown) {
            // Calculate the remaining time based on the created_at timestamp
            $currentTime = time();
            $createdAt = strtotime($countdown->created_at);
            $remainingTime = max(3600 - ($currentTime - $createdAt), 0);

            return response()->json(['remaining_time' => $remainingTime]);
        }

        // If no record found, return 0 as the remaining time
        return response()->json(['remaining_time' => 0]);
    }

    public function updateReserve(Request $request)
    {
        $unique_no = Product::where('id', $request->id)->orderBy('id', 'DESC')->pluck('tot_remaining')->first();
        if ($unique_no == null or $unique_no == "") {
            #If Table is Empty
            $unique_no = 0;
        } else {
            #If Table has Already some Data
            $unique_no = $unique_no - 1;
        }
        $product = Product::where('id', $request->id)->first();
        $product->tot_remaining = $unique_no;
        $product->update();
    }

    public function Reservations(Request $request)
    {

        $qry = Reserve::query();
        $qry = $qry->where('status', 1);

        if ($request->role == 'admin') {
            $qry->latest();
        } else if ($request->role == 'pmm') {
            $qry->where('pmm_id', $request->pmm_id)->latest();
        } else {
            $qry->where('user_id', Auth::user()->id)->latest();
        }

        // return $qry->get();

        $data['reserve_products'] = $qry->get();
        return view('product.reserve_products', compact('data'));
    }

    public function removeReservation(Request $request)
    {
        $remove_reserve = Reserve::where('id', $request->id)->where('status', 1)->first();
        $remove_reserve->status = 0;
        $res = $remove_reserve->update();
        if ($res) {
            $this->returnReserve($request);
            return response()->json([
                'message' => 'Product remove successfully',
            ]);
        }
    }

    public function returnReserve(Request $request)
    {
        $unique_no = Product::where('id', $request->product_id)->orderBy('id', 'DESC')->pluck('tot_remaining')->first();
        if ($unique_no == null or $unique_no == "") {
            #If Table is Empty
            $unique_no = 0;
        } else {
            #If Table has Already some Data
            $unique_no = $unique_no + 1;
        }
        $product = Product::where('id', $request->product_id)->first();
        $product->tot_remaining = $unique_no;
        $product->update();
    }
}
