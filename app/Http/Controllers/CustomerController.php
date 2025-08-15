<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer; // Assume you have a Customer model
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{


    public function create()
    {
        if (auth()->guard('customer')->check()) {
            return redirect('/customer/dashboard');
        }
        return view('customer.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:customers,email',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'sex' => 'nullable|string|max:255',
            'hz' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $customer = new Customer();
        $customer->email = $request->email;
        $customer->firstname = $request->firstname;
        $customer->lastname = $request->lastname;
        $customer->sex = $request->sex;
        $customer->hz = $request->hz;
        $customer->position = $request->position;
        $customer->phone = $request->phone;
        $customer->password = Hash::make($request->password);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $customer->avatar = $path;
        }

        $customer->save();

return view('customer.register', [
    'success_message' => 'Таны бүртгэл үүсгэх хүсэлтийг амжилттай илгээлээ. Тантай бид эргэн холбогдох болно.'
]);  }
}

