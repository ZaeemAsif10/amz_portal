<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Reserve;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $data['orders'] = Order::paginate(10);
        return view('order.order', compact('data'));
    }

    public function createOrder($product_no)
    {
        $data['product_no'] = Product::where('product_no', $product_no)->first();
        return view('order.create', compact('data'));
    }

    public function orderNow(Request $request)
    {
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->product_no = $request->product_no;
        $order->order_no = $request->order_no;
        $order->c_email = $request->c_email;
        $order->review_link = $request->review_link;
        $order->date = Carbon::now();
        $order->status = 'Ordered';

        $unique_no = Order::orderBy('id', 'DESC')->pluck('order_limit')->first();
        if ($unique_no == null or $unique_no == "") {
            #If Table is Empty
            $unique_no = 1;
        } else {
            #If Table has Already some Data
            $unique_no = $unique_no + 1;
        }
        $order->order_limit = $unique_no;

        if ($request->hasFile('order_image')) {
            $file = $request->file('order_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/uploads/order_image/', $filename);
            $order->order_image = $filename;
        }

        if ($request->hasFile('refund_image')) {
            $file1 = $request->file('refund_image');
            $extension1 = $file1->getClientOriginalExtension();
            $filename1 = time() . '.' . $extension1;
            $file1->move('public/uploads/refund_image/', $filename1);
            $order->refund_image = $filename1;
        }
        $res = $order->save();

        if ($res) {
            $this->updateTotalSale($request);
            $this->reserveComplete($request);
            return redirect('all_orders')->with('success', 'Order created successfully');
        }
    }

    public function updateTotalSale(Request $request)
    {
        $unique_no = Product::where('product_no', $request->product_no)->orderBy('id', 'DESC')->pluck('tot_sale')->first();
        if ($unique_no == null or $unique_no == "") {
            #If Table is Empty
            $unique_no = 0;
        } else {
            #If Table has Already some Data
            $unique_no = $unique_no - 1;
        }
        $product = Product::where('product_no', $request->product_no)->first();
        $product->tot_sale = $unique_no;
        $product->update();
    }

    public function reserveComplete(Request $request)
    {
        $res_comp = Reserve::where('product_no', $request->product_no)->where('status', 1)->first();
        $res_comp->status = 0;
        $res_comp->update();
    }

    public function orderDetail($order_limit)
    {
        $data['order_detail'] = Order::where('order_limit', $order_limit)->first();
        return view('order.order_detail', compact('data'));
    }

    public function updateOrderDetail(Request $request)
    {
        $order_detail = Order::where('order_limit', $request->edit_order_detail_id)->first();


        $order_detail->order_no = $request->order_no;
        $order_detail->review_link = $request->review_link;
        if ($request->status == 'Reviewed') {
            $order_detail->review_date = Carbon::now();
        } else if ($request->status == 'Refunded') {
            $order_detail->refund_date = Carbon::now();
        }
        $order_detail->status = $request->status;
        $order_detail->remarks = $request->remarks;

        if ($request->hasFile('order_image')) {
            $path = 'public/uploads/order_image/' . $order_detail->order_image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('order_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/uploads/order_image/', $filename);
            $order_detail->order_image = $filename;
        }

        if ($request->hasFile('refund_image')) {
            $path = 'public/uploads/refund_image/' . $order_detail->refund_image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file1 = $request->file('refund_image');
            $extension1 = $file1->getClientOriginalExtension();
            $filename1 = time() . '.' . $extension1;
            $file1->move('public/uploads/refund_image/', $filename1);
            $order_detail->refund_image = $filename1;
        }

        if ($request->hasFile('review_image')) {
            $path = 'public/uploads/review_image/' . $order_detail->review_image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file2 = $request->file('review_image');
            $extension2 = $file2->getClientOriginalExtension();
            $filename2 = time() . '.' . $extension2;
            $file2->move('public/uploads/review_image/', $filename2);
            $order_detail->review_image = $filename2;
        }

        $res = $order_detail->update();
        if ($res) {
            return back();
        }
    }
}
