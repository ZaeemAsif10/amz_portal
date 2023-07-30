<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

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
        if (Auth::user()->role == 'admin') {
            $data['completed'] = Order::where('status', 'Completed')->count();
            $data['cancelled'] = Order::where('status', 'Cancelled')->count();
            $data['refunded'] = Order::where('status', 'Refunded')->count();
            $data['ordered'] = Order::where('status', 'Ordered')->count();
            $data['reviewed'] = Order::where('status', 'Reviewed')->count();
            $data['delivered'] = Order::where('status', 'Delivered')->count();
            $data['reviewedDeleted'] = Order::where('status', 'ReviewedDeleted')->count();
            $data['onhold'] = Order::where('status', 'Onhold')->count();
            $data['pending'] = Order::where('status', 'Pending')->count();
            $data['completed'] = Order::where('status', 'Completed')->count();
            $data['enabled'] = Product::where('status', 1)->count();
            $data['disabled'] = Product::where('status', 0)->count();
            return view('home', compact('data'));
        } else {


            $qry = Order::query();
            if (Auth::user()->role == 'pmm') {
                $qry = $qry->where('pmm_id', Auth::user()->id);
            } else if (Auth::user()->role == 'pm') {
                $qry = $qry->where('user_id', Auth::user()->id);
            }

            $data['ordered'] = $qry->where('status', 'Ordered')->count();
            $data['reviewed'] = $qry->where('status', 'Reviewed')->count();
            $data['delivered'] = $qry->where('status', 'Delivered')->count();
            $data['reviewedDeleted'] = $qry->where('status', 'ReviewedDeleted')->count();
            $data['onhold'] = $qry->where('status', 'Onhold')->count();
            $data['pending'] = $qry->where('status', 'Pending')->count();
            $data['refunded'] = $qry->where('status', 'Refunded')->count();
            $data['completed'] = $qry->where('status', 'Completed')->count();
            $data['cancelled'] = $qry->where('status', 'Cancelled')->count();
            $data['enabled'] = Product::where('status', 1)->where('user_id', Auth::user()->id)->count();
            $data['disabled'] = Product::where('status', 0)->where('user_id', Auth::user()->id)->count();
            return view('home', compact('data'));
        }
    }

    public function Profile(Request $request)
    {
        $data['profile'] = User::where('id', $request->id)->first();
        return view('profile.profile', compact('data'));
    }

    public function profileUpdate(Request $request)
    {
        if ($request->profile_id) {
            $profile = User::where('id', $request->profile_id)->first();
            $profile->name = $request->name;

            if ($request->hasFile('image')) {

                $path = 'public/uploads/profile/' . $profile->image;

                if (File::exists($path)) {
                    File::delete($path);
                }
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('public/uploads/profile/', $filename);
                $profile->image = $filename;
            }

            $res = $profile->update();
            if ($res) {
                return back()->with('success', 'Profile update successfully');
            } else {
                return back()->with('error', 'Profile update failed');
            }
        } elseif ($request->customer_id) {

            $customer = User::where('id', $request->customer_id)->first();
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->whats_number = $request->whats_number;
            $customer->bank_name = $request->bank_name;
            $customer->account_h_name = $request->account_h_name;
            $customer->account_no = $request->account_no;

            //Customer image
            if ($request->hasFile('image')) {

                $path = 'public/uploads/profile/' . $customer->image;
                if (File::exists($path)) {
                    File::delete($path);
                }

                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('public/uploads/profile/', $filename);
                $customer->image = $filename;
            }

            //Cnic front
            if ($request->hasFile('cnic_front')) {

                $path_front = 'public/uploads/cnic/front/' . $customer->cnic_front;
                if (File::exists($path_front)) {
                    File::delete($path_front);
                }

                $file_front = $request->file('cnic_front');
                $extension_front = $file_front->getClientOriginalExtension();
                $filename_front = time() . '.' . $extension_front;
                $file_front->move('public/uploads/cnic/front/', $filename_front);
                $customer->cnic_front = $filename_front;
            }

            //Cnic back
            if ($request->hasFile('cnic_back')) {

                $path_back = 'public/uploads/cnic/back/' . $customer->cnic_back;
                if (File::exists($path_back)) {
                    File::delete($path_back);
                }

                $file_back = $request->file('cnic_back');
                $extension_back = $file_back->getClientOriginalExtension();
                $filename_back = time() . '.' . $extension_back;
                $file_back->move('public/uploads/cnic/back/', $filename_back);
                $customer->cnic_back = $filename_back;
            }

            $cus_res = $customer->update();

            if ($cus_res) {
                return back()->with('success', 'Customer Details update successfully');
            } else {
                return back()->with('error', 'Customer Details update failed');
            }
        }
    }
}
