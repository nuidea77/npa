<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('customer.signin');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Check if the customer exists
        $customer = Customer::where('email', $request->email)->first();

        if (!$customer) {
            return back()->withErrors([
                'email_not_found' => 'Таны оруулсан имэйл хаяг олдсонгүй. Та бүртгэл үүсгээгүй бол бүртгүүлнэ үү.',
            ]);
        }

        // Check if the customer is verified
        if ($customer->verify_status === null || $customer->verify_status === 0) {
            return back()->withErrors([
                'verification' => 'Таны бүртгэлийг баталгаажаагүй байна. Таньд бид ажлын 72 цагийн дотор баталгаажуулж, хариу өгнө.',
            ]);
        }

        // Check if the password matches
        if (!\Hash::check($request->password, $customer->password)) {
            return back()->withErrors([
                'password_unmatch' => 'Таны оруулсан нууц үг буруу байна. Дахин оролдоно уу.',
            ]);
        }

        // Attempt login if credentials are valid
        if (Auth::guard('customer')->attempt($request->only('email', 'password'))) {
            return redirect()->route('customer.dashboard');
        }

        // General error for invalid login
        return back()->withErrors([
            'email' => 'Имэйл эсвэл нууц үг буруу байна. Дахин оролдоно уу.',
        ]);

    }
    public function logout()
    {
        Auth::guard('customer')->logout(); // Log out the customer
        return redirect()->route('customer.signin')->with('success', 'You have been logged out successfully.');
    }



}
