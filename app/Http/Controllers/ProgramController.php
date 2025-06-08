<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\ProgramRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ProgramController extends Controller
{
    // Нүүр хуудасны хөтөлбөрүүдийг харуулах
    public function index()
    {
        $programs = Program::with('translations')
            ->where('is_active', 1)
            ->orderBy('order')
            ->paginate(12);

        return view('program.index', compact('programs'));
    }

    // Нэг хөтөлбөр дэлгэрэнгүй харах
    public function view($id)
    {
        $program = Program::with('translations')->findOrFail($id);
        $now = now();

        $registration_status = null;
        if ($program->start_date && $now->lt($program->start_date)) {
            $registration_status = 'not_started';
        } elseif ($program->end_date && $now->gt($program->end_date)) {
            $registration_status = 'ended';
        } else {
            $registration_status = 'open';
        }

        return view('program.view', [
            'program' => $program,
            'registration_status' => $registration_status,
        ]);
    }

    // Бүртгэлийн форм харуулах
    public function showRegistrationForm($id)
    {
        $program = Program::findOrFail($id);

        // Нэвтрэлт шаардлагатай бол
        if ((int)$program->requires_login === 1 && !Auth::guard('customer')->check()) {
            return redirect()->route('customer.signin')->with('error', 'Та нэвтэрч орно уу');
        }

        return view('program._form', compact('program'));
    }

    // Бүртгэлийг хадгалах
    public function submitRegistration(Request $request, $id)
    {
        $program = Program::findOrFail($id);

        if ((int)$program->requires_login === 1 && !Auth::guard('customer')->check()) {
            return redirect()->route('customer.register')->with('error', 'Та нэвтэрч орно уу');
        }

        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'hz' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'gender' => 'nullable|in:male,female',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'answer' => 'nullable|string',
        ]);

        if ($request->hasFile('media')) {
            $validated['media_path'] = $request->file('media')->store('registrations', 'public');
        }

        $registration = ProgramRegistration::create([
            'program_id' => $program->id,
            'customer_id' => Auth::guard('customer')->id(),
            ...$validated,
        ]);

        // Mail::to('info@mongolec.org')->send(new \App\Mail\NewProgramRegistration($registration));

        return redirect()->back()->with('success', 'Бүртгэл амжилттай илгээгдлээ.');
    }
}
