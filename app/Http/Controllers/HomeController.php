<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
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
        $data['completed'] = Order::where('status', 'Completed')->count();
        $data['cancelled'] = Order::where('status', 'Cancelled')->count();
        $data['refunded'] = Order::where('status', 'Refunded')->count();
        $data['ordered'] = Order::where('status', 'Ordered')->count();
        return view('home', compact('data'));
    }

    public function Profile(Request $request)
    {
        $data['profile'] = User::where('id', $request->id)->first();
        return view('profile.profile', compact('data'));
    }

    public function profileUpdate(Request $request)
    {
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
    }
}
