<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use App\Models\ProtectedArea;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (auth()->guard('customer')->check()) {
            return redirect('/customer/dashboard');
        }
        return view('customer.signin');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $customer = Customer::where('email', $request->email)->first();

        if (!$customer) {
            return back()->withErrors([
                'email_not_found' => 'Таны оруулсан имэйл олдсонгүй.',
            ]);
        }

        if ($customer->verify_status === null || $customer->verify_status === 0) {
            return back()->withErrors([
                'verification' => 'Таны бүртгэл баталгаажаагүй байна.',
            ]);
        }

        if (!Hash::check($request->password, $customer->password)) {
            return back()->withErrors([
                'password_unmatch' => 'Нууц үг буруу байна.',
            ]);
        }

        if (Auth::guard('customer')->attempt($request->only('email', 'password'))) {
            return redirect()->route('customer.dashboard');
        }

        return back()->withErrors([
            'email' => 'Имэйл эсвэл нууц үг буруу байна.',
        ]);
    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('customer.signin')->with('success', 'Амжилттай гарлаа.');
    }

    // ---------------- REGISTER ----------------
    public function showRegisterForm()
    {
        $protected_areas = ProtectedArea::all();
        return view('customer.register', compact('protected_areas'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|min:6|confirmed',
            'protected_area_id' => 'required|exists:protected_areas,id',
        ]);

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'protected_area_id' => $request->protected_area_id,
        ]);

        Auth::guard('customer')->login($customer);

        return redirect()->route('customer.dashboard');
    }
}
