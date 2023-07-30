<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $qry = User::query();

        if ($request->isMethod('post')) {

            $qry->when($request->email, function ($query, $email) {
                return $query->where('email', $email);
            });

            $qry->when($request->role, function ($query, $role) {
                return $query->where('role', $role);
            });

            $qry->when($request->status, function ($query, $status) {
                return $query->where('status', $status);
            });
        }

        $data['users'] = $qry->latest()->paginate(20);
        return view('customer.customer', compact('data'));
    }

    public function customersStatus(Request $request)
    {
        $change_status = User::where('id', $request->id)->first();
        if ($change_status->status == 'active') {
            $change_status->status = 'inactive';
            $change_status->update();
        } else if ($change_status->status == 'inactive') {
            $change_status->status = 'active';
            $change_status->update();
        }
        return response()->json([
            'status' => 200,
            'message' => 'Status update successfully',
        ]);
    }

    public function customerDetails($customer_id)
    {
        $data['customer_detail'] = User::where('id', $customer_id)->first();
        return view('customer.customer_details', compact('data'));
    }
}
