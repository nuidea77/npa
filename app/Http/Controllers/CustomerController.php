<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Notifications\NewCustomerNotification;
use App\Models\ProtectedArea;

class CustomerController extends Controller
{
    public function create()
    {
        $protected_areas = ProtectedArea::orderBy('name')->get();

        if (auth()->guard('customer')->check()) {
            return redirect('/customer/dashboard');
        }

        return view('customer.register', [
            'protected_areas' => $protected_areas,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:customers,email',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'sex' => 'nullable|string|max:255',
            'protected_area_id' => 'required|exists:protected_areas,id',
            'position' => 'nullable|string|max:255',
            'phone' => 'required|string|max:8',
            'password' => 'required|string|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $customer = new Customer();
        $customer->email = $request->email;
        $customer->firstname = $request->firstname;
        $customer->lastname = $request->lastname;
        $customer->sex = $request->sex;
        $customer->protected_area_id = $request->protected_area_id;
        $customer->position = $request->position;
        $customer->phone = $request->phone;
        $customer->password = Hash::make($request->password);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $customer->avatar = $path;
        }

        $customer->save();

        // Админд мэдэгдэл илгээх
        $admins = User::where('role_id', 1)->get();
        foreach ($admins as $admin) {
            $admin->notify(new NewCustomerNotification($customer));
        }

        // redirect ашиглана, form дахин submit болохгүй
  return redirect()->route('customer.register')
                     ->with('success_message', true);

    }
}
