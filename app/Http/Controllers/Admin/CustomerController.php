<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $data['users'] = User::all();
        return view('customer.customer', compact('data'));
    }

    public function customersStatus(Request $request)
    {
        $change_status = User::where('id', $request->id)->first();
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
}
