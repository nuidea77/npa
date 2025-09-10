<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Notification list page
    public function index()
    {
        $notifications = Auth::user()->notifications()->paginate(10);
        return view('vendor.voyager.notifications.index', compact('notifications'));
    }

    // AJAX: notification уншсан гэж тэмдэглэх
    public function markAsRead(Request $request)
    {
        $notification = Auth::user()->notifications()->find($request->id);
        if($notification){
            $notification->markAsRead();
        }
        return response()->json(['success' => true]);
    }
}
