<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function signup_view()
    {
        return view('auth.register');
    }

    public function signup(Request $request)
    {
        $check_duplicate = User::where('email', $request->email)->first();
        if (!$check_duplicate) {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'cnic_front' => 'required',
                'cnic_back' => 'required',
                'phone' => 'required',
                'whats_number' => 'required',
                'account_h_name' => 'required',
                'account_no' => 'required',
                'role' => 'required',
            ]);

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->whats_number = $request->whats_number;
            $user->account_h_name = $request->account_h_name;
            $user->account_no = $request->account_no;
            $user->role = $request->role;
            $seller_id = User::orderBy('id', 'DESC')->pluck('seller_id')->first();
            if ($seller_id == null or $seller_id == "") {
                #If Table is Empty
                $seller_id = 1;
            } else {
                #If Table has Already some Data
                $seller_id = $seller_id + 1;
            }
            $user->seller_id = $seller_id;

            if ($request->hasFile('cnic_front')) {
                $file = $request->file('cnic_front');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('public/uploads/cnic/front/', $filename);
                $user->cnic_front = $filename;
            }

            if ($request->hasFile('cnic_back')) {
                $file1 = $request->file('cnic_back');
                $extension1 = $file1->getClientOriginalExtension();
                $filename1 = time() . '.' . $extension1;
                $file1->move('public/uploads/cnic/back/', $filename1);
                $user->cnic_back = $filename1;
            }

            $user->save();

            if ($user) {
                return redirect('login');
            }
        } else {
            return back()->with('error', 'This email already exist');
        }
    }
}
