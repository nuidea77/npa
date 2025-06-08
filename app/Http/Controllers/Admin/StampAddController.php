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
    return view('admin.stamp_add', compact('stampHistories'));
}



public function store(Request $request)
{
    $request->validate([
        'customer_id' => 'required|array',
        'customer_id.*' => 'exists:customers,id',
        'stamp_id' => 'required|array',
        'stamp_id.*' => 'exists:stamps,id',
        'created_at' => 'nullable|date',
    ]);

    $customerIds = $request->customer_id;
    $stampIds = $request->stamp_id;
    $created_at = $request->created_at;
    foreach ($customerIds as $customerId) {
        $customer = Customer::find($customerId);

        // Тамгуудыг тухайн хэрэглэгчид нэмэх
        $customer->stamps()->syncWithoutDetaching($stampIds);
    }

    return redirect()->route('stamp_add.index')->with('success', 'Тамгууд амжилттай холбогдлоо!');
}



    public function destroy($id)
    {
        $stampHistory = StampHistory::findOrFail($id);
        $stampHistory->delete();

        return redirect()->back()->with('success', 'Stamp history deleted successfully!');
    }

public function update(Request $request, $id)
{
    $request->validate([
        'customer_id' => 'required|array',
        'stamp_id' => 'required|array',
        'created_at' => 'required|date',
    ]);

    // Хуучин stampHistory-г устгана
    StampHistory::findOrFail($id)->delete();

    // Олон хэрэглэгч ба олон тамга бүртгэнэ
    foreach ($request->customer_id as $customer_id) {
        foreach ($request->stamp_id as $stamp_id) {
            StampHistory::create([
                'customer_id' => $customer_id,
                'stamp_id' => $stamp_id,
                'created_at' => $request->created_at,
            ]);
        }
    }

    return redirect()->route('stamp_add.index')->with('success', 'Шинэчлэгдлээ');
}


    public function create()
{
    $customers = Customer::all();
    $stamps = Stamp::all();
    return view('admin.stamp_add_create', compact('customers', 'stamps'));
}

public function edit($id)
{
    $stampHistory = StampHistory::findOrFail($id);
    $customers = Customer::all();
    $stamps = Stamp::all();
    return view('admin.stamp_add_edit', compact('stampHistory', 'customers', 'stamps'));
}

}
