<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'comment' => 'required|string|max:1000',
        ]);

        Feedback::create([
            'email' => $request->email,
            'phone' => $request->phone,
            'comment' => $request->comment,
        ]);

        try {
           Feedback::create($request->all());
            return redirect()->back()->with('success', __('texts.your-comment'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('texts.error'));
        }
    }
}
