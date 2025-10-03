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

public function markAsRead(Request $request)
{
    $notification = auth()->user()->notifications()->find($request->id);

    if ($notification && !$notification->read_at) {
        // Зөвхөн уншаагүй бол л unш гэж тэмдэглэх
        $notification->markAsRead();

        return response()->json([
            'success' => true,
            'message' => 'Notification marked as read',
            'unread_count' => auth()->user()->unreadNotifications->count()
        ]);
    }

    if ($notification && $notification->read_at) {
        // Аль хэдийн уншсан бол
        return response()->json([
            'success' => true,
            'message' => 'Already read',
            'unread_count' => auth()->user()->unreadNotifications->count()
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'Notification not found'
    ], 404);
}


}
