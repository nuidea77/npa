<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer; // Assume you have a Customer model
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\StampHistory; // Assuming you have a StampHistory model
use App\Models\Lesson;
class DashboardController extends Controller
{
    public function feedback()

    {
        return view('customer.form');
    }

   public function index()
    {


        return view('customer.dashboard');
    }

        // Display the customer dashboard
        public function dashboard()
        {
            // Retrieve the currently authenticated customer
            $customer = Auth::guard('customer')->user();

            // Debugging: Check if the $customer is null
            if (!$customer) {
                abort(403, 'No customer authenticated');
            }
            // Retrieve the customer's stamp history
            $stampHistory = StampHistory::with('stamp')->where('customer_id', $customer->id)->get();
            $lessons = Lesson::orderBy('started_at', 'desc')->get();
            // Retrieve the lessons associated with the customer



            // Pass the customer to the view
            return view('customer.dashboard', compact('customer', 'stampHistory', 'lessons'));
        }


        // Show the edit form
        public function edit()
        {
            $customer = Auth::guard('customer')->user();
            return view('customer.edit-customer', compact('customer'));
        }

        // Handle the update request
        public function update(Request $request)
        {
            $request->validate([
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' => 'required|email|unique:customers,email,' . Auth::guard('customer')->id(),
                'phone' => 'required|string|max:15',
            'sex' => 'nullable|string|max:255',
            'hz' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'password' => 'nullable|string|min:8|confirmed',
            ]);

            $customer = Auth::guard('customer')->user();
            $customer->firstname = $request->firstname;
            $customer->lastname = $request->lastname;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->email = $request->email;
        $customer->sex = $request->sex;
        $customer->hz = $request->hz;
        $customer->position = $request->position;
        $customer->phone = $request->phone;

            // Update password if provided
            if ($request->password) {
                $customer->password = Hash::make($request->password);
            }

            $customer->save();

            return redirect()->route('customer.dashboard')->with('success', 'Your information has been updated successfully.');
        }
}
