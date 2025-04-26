<?php
namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomPageController extends Controller
{
    /**
     * Display the custom page with customer verification requests.
     */
    public function index(Request $request)
    {
        $query = Customer::query();

        // Apply status filter if provided
        if ($request->has('status') && $request->status !== 'all') {
            if ($request->status === 'null') {
                $query->whereNull('verify_status'); // Pending
            } else {
                $query->where('verify_status', $request->status); // Approved (1) or Rejected (0)
            }
        }

        // Fetch filtered customers
        $pendingRequests = $query->get();

        return view('admin.custom-page', compact('pendingRequests'));
    }

    /**
     * Update the verify_status of a customer.
     *
     * @param int $id
     * @param int $status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateVerifyStatus($id, $status)
    {
        $customer = Customer::findOrFail($id);

        // Update the customer's verification status
        $customer->verify_status = $status;
        $customer->save();

        // Redirect back with a success message
        $message = $status === 1
            ? 'Customer approved successfully!'
            : ($status === 0 ? 'Customer rejected successfully!' : 'Customer status updated successfully!');

        return redirect()->route('admin.custom.page')->with('success', $message);
    }
}
