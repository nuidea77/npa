<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\StampHistory;
use App\Models\Lesson;
use App\Models\ProtectedArea;
use App\Models\Customer;

class DashboardController extends Controller
{
    /**
     * Constructor - ensure customer is authenticated for all methods
     */
    public function __construct()
    {
        $this->middleware('auth:customer');
    }

    /**
     * Display feedback form
     */
    public function feedback()
    {
        return view('customer.form');
    }

    /**
     * Display main dashboard (redirect to dashboard method)
     */
    public function index()
    {
        return $this->dashboard();
    }

    /**
     * Display the customer dashboard with stamps and lessons
     */
public function dashboard()
{
    $customer = Auth::guard('customer')->user();

    // Get stamp histories - variable нэр нь stampHistories
    $stampHistories = StampHistory::with(['stamp', 'protectedArea'])
        ->where('protected_area_id', $customer->protected_area_id)
        ->orderBy('assigned_date', 'desc')
        ->get();

    // Get recent lessons
    $lessons = Lesson::orderBy('started_at', 'desc')
        ->limit(10)
        ->get();

    return view('customer.dashboard', compact('customer', 'stampHistories', 'lessons'));
}

    /**
     * Show the edit profile form
     */
    public function edit()
    {
        $customer = Auth::guard('customer')->user();
        $protectedAreas = ProtectedArea::orderBy('name')->get();

        return view('customer.edit-customer', compact('customer', 'protectedAreas'));
    }

    /**
     * Update customer profile
     */
    public function update(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        // Validation rules
        $rules = [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phone' => 'required|digits:8',
            'sex' => 'required|in:1,2',
            'protected_area_id' => 'required|exists:protected_areas,id',
            'position' => 'required|in:1,2,3,4,5',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ];

        // Custom error messages
        $messages = [
            'firstname.required' => 'Нэрээ оруулна уу',
            'lastname.required' => 'Овогоо оруулна уу',
            'email.required' => 'Имэйл хаягаа оруулна уу',
            'email.email' => 'Зөв имэйл хаяг оруулна уу',
            'email.unique' => 'Энэ имэйл аль хэдийн бүртгэлтэй байна',
            'phone.required' => 'Утасны дугаараа оруулна уу',
            'phone.digits' => 'Утасны дугаар 8 оронтой байх ёстой',
            'sex.required' => 'Хүйсээ сонгоно уу',
            'sex.in' => 'Хүйс буруу байна',
            'protected_area_id.required' => 'Хамгаалалттай газраа сонгоно уу',
            'protected_area_id.exists' => 'Сонгосон хамгаалалттай газар олдсонгүй',
            'position.required' => 'Албан тушаалаа сонгоно уу',
            'position.in' => 'Албан тушаал буруу байна',
            'avatar.image' => 'Зураг файл оруулна уу',
            'avatar.mimes' => 'Зураг jpeg, png, jpg форматтай байх ёстой',
            'avatar.max' => 'Зургийн хэмжээ 2MB-аас бага байх ёстой',
            'password.min' => 'Нууц үг 8-аас дээш тэмдэгт байх ёстой',
            'password.confirmed' => 'Нууц үг таарахгүй байна',
        ];

        $request->validate($rules, $messages);

        // Update basic information
        $customer->firstname = $request->firstname;
        $customer->lastname = $request->lastname;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->sex = $request->sex;
        $customer->protected_area_id = $request->protected_area_id;
        $customer->position = $request->position;

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($customer->avatar) {
                Storage::disk('public')->delete($customer->avatar);
            }

            // Store new avatar
            $path = $request->file('avatar')->store('avatars', 'public');
            $customer->avatar = $path;
        }

        // Update password if provided
        if ($request->filled('password')) {
            $customer->password = Hash::make($request->password);
        }

        $customer->save();

        return redirect()->route('customer.dashboard')
            ->with('success', 'Таны мэдээлэл амжилттай шинэчлэгдлээ!');
    }

    /**
     * Display customer profile
     */
    public function profile()
    {
        $customer = Auth::guard('customer')->user();

        return view('customer.profile', compact('customer'));
    }

    /**
     * Display customer stamps with pagination
     */
    public function stamps()
    {
        $customer = Auth::guard('customer')->user();

        $stampHistories = StampHistory::with(['stamp', 'protectedArea'])
            ->where('protected_area_id', $customer->protected_area_id)
            ->orderBy('assigned_date', 'desc')
            ->paginate(12);

        return view('customer.stamps', compact('customer', 'stampHistories'));
    }

    /**
     * Delete avatar
     */
    public function deleteAvatar()
    {
        $customer = Auth::guard('customer')->user();

        if ($customer->avatar) {
            Storage::disk('public')->delete($customer->avatar);
            $customer->avatar = null;
            $customer->save();

            return redirect()->back()->with('success', 'Зураг амжилттай устгагдлаа');
        }

        return redirect()->back()->with('error', 'Зураг олдсонгүй');
    }
}
