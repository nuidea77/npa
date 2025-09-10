<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Stamp;
use App\Models\StampHistory;
use Illuminate\Http\Request;

class StampAddController extends Controller
{
    public function index()
    {
        $stampHistories = StampHistory::with(['customer', 'stamp'])->get();
        return view('Admin.stamp_add', compact('stampHistories'));
    }

    public function create()
    {
        $customers = Customer::all();
        $stamps = Stamp::all();
        return view('Admin.stamp_add_create', compact('customers', 'stamps'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|array',
            'customer_id.*' => 'exists:customers,id',
            'stamp_id' => 'required|array',
            'stamp_id.*' => 'exists:stamps,id',
        ]);

        foreach ($request->customer_id as $customer_id) {
            foreach ($request->stamp_id as $stamp_id) {
                StampHistory::firstOrCreate([
                    'customer_id' => $customer_id,
                    'stamp_id' => $stamp_id,
                ]);
            }
        }

        return redirect()->route('stamp_add.index')->with('success', 'Тамгууд амжилттай холбогдлоо!');
    }

    public function edit($customer_id, $stamp_id)
    {
        $stampHistory = StampHistory::where('customer_id', $customer_id)
                                    ->where('stamp_id', $stamp_id)
                                    ->firstOrFail();

        $customers = Customer::all();
        $stamps = Stamp::all();
        return view('Admin.stamp_add_edit', compact('stampHistory', 'customers', 'stamps'));
    }

    public function update(Request $request, $customer_id, $stamp_id)
    {
        $request->validate([
            'customer_id' => 'required|array',
            'stamp_id' => 'required|array',
        ]);

        // Хуучин записи-г устгах
        StampHistory::where('customer_id', $customer_id)
                    ->where('stamp_id', $stamp_id)
                    ->delete();

        // Шинэ записи-г үүсгэх
        foreach ($request->customer_id as $newCustomerId) {
            foreach ($request->stamp_id as $newStampId) {
                StampHistory::firstOrCreate([
                    'customer_id' => $newCustomerId,
                    'stamp_id' => $newStampId,
                ]);
            }
        }

        return redirect()->route('stamp_add.index')->with('success', 'Шинэчлэгдлээ!');
    }

    public function destroy($customer_id, $stamp_id)
    {
        StampHistory::where('customer_id', $customer_id)
                    ->where('stamp_id', $stamp_id)
                    ->delete();

        return redirect()->route('stamp_add.index')->with('success', 'Амжилттай устгагдлаа!');
    }
}
