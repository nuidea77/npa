<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProtectedArea;
use App\Models\Stamp;
use App\Models\StampHistory;
use Illuminate\Http\Request;

class StampAddController extends Controller
{
    /**
     * Display a listing of stamp histories
     */
    public function index()
    {
        $stampHistories = StampHistory::with(['protectedArea', 'stamp'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.stamp_add', compact('stampHistories'));
    }

    /**
     * Show the form for creating new stamp assignments
     */
    public function create()
    {
        $protectedAreas = ProtectedArea::orderBy('name')->get();
        $stamps = Stamp::orderBy('name')->get();

        return view('admin.stamp_add_create', compact('protectedAreas', 'stamps'));
    }

    /**
     * Store newly created stamp assignments
     */
    public function store(Request $request)
    {
        $request->validate([
            'protected_area_id' => 'required|array|min:1',
            'protected_area_id.*' => 'exists:protected_areas,id',
            'stamp_id' => 'required|array|min:1',
            'stamp_id.*' => 'exists:stamps,id',
            'assigned_date' => 'required|date|before_or_equal:today',
        ], [
            'protected_area_id.required' => 'Хамгаалалттай газар сонгоно уу',
            'protected_area_id.min' => 'Дор хаяж 1 хамгаалалттай газар сонгоно уу',
            'stamp_id.required' => 'Тамга сонгоно уу',
            'stamp_id.min' => 'Дор хаяж 1 тамга сонгоно уу',
            'assigned_date.required' => 'Огноо оруулна уу',
            'assigned_date.date' => 'Зөв огноо оруулна уу',
            'assigned_date.before_or_equal' => 'Огноо өнөөдрөөс хойш байж болохгүй',
        ]);

        $created = 0;
        $existing = 0;
        $assignedDate = $request->assigned_date;

        foreach ($request->protected_area_id as $protectedAreaId) {
            foreach ($request->stamp_id as $stampId) {
                // Давхар бүртгэл шалгах
                $exists = StampHistory::where('protected_area_id', $protectedAreaId)
                    ->where('stamp_id', $stampId)
                    ->exists();

                if (!$exists) {
                    StampHistory::create([
                        'protected_area_id' => $protectedAreaId,
                        'stamp_id' => $stampId,
                        'assigned_date' => $assignedDate,
                    ]);
                    $created++;
                } else {
                    $existing++;
                }
            }
        }

        $message = '';

        if ($created > 0) {
            $message = "{$created} тамга амжилттай оноогдлоо!";
        }

        if ($existing > 0) {
            $message .= $created > 0 ? " ({$existing} тамга аль хэдийн байсан)" : "Бүх тамга аль хэдийн оноогдсон байна.";
        }

        return redirect()->route('stamp_add.index')->with('success', $message);
    }

    /**
     * Show the form for editing a stamp assignment
     */
 public function edit($protectedAreaId, $stampId)
{
    $stampHistory = StampHistory::where('protected_area_id', $protectedAreaId)
        ->where('stamp_id', $stampId)
        ->with(['protectedArea', 'stamp'])
        ->firstOrFail();

    $protectedAreas = ProtectedArea::orderBy('name')->get();
    $stamps = Stamp::orderBy('name')->get();

    // Энд stamp_add_edit view руу дамжуулж байна
    return view('admin.stamp_add_edit', compact('stampHistory', 'protectedAreas', 'stamps'));
}

    /**
     * Update the specified stamp assignment
     */
    public function update(Request $request, $protectedAreaId, $stampId)
    {
        $request->validate([
            'protected_area_id' => 'required|exists:protected_areas,id',
            'stamp_id' => 'required|exists:stamps,id',
            'assigned_date' => 'required|date|before_or_equal:today',
        ], [
            'protected_area_id.required' => 'Хамгаалалттай газар сонгоно уу',
            'protected_area_id.exists' => 'Сонгосон хамгаалалттай газар олдсонгүй',
            'stamp_id.required' => 'Тамга сонгоно уу',
            'stamp_id.exists' => 'Сонгосон тамга олдсонгүй',
            'assigned_date.required' => 'Огноо оруулна уу',
            'assigned_date.date' => 'Зөв огноо оруулна уу',
            'assigned_date.before_or_equal' => 'Огноо өнөөдрөөс хойш байж болохгүй',
        ]);

        // Хуучин бүртгэл олох
        $stampHistory = StampHistory::where('protected_area_id', $protectedAreaId)
            ->where('stamp_id', $stampId)
            ->firstOrFail();

        // Хэрэв өөрчлөлт хийгдээгүй бол
        if ($protectedAreaId == $request->protected_area_id &&
            $stampId == $request->stamp_id &&
            $stampHistory->assigned_date == $request->assigned_date) {
            return redirect()->route('stamp_add.index')
                ->with('info', 'Өөрчлөлт хийгдсэнгүй');
        }

        // Шинэ утга давхцаж байгаа эсэхийг шалгах
        if ($protectedAreaId != $request->protected_area_id || $stampId != $request->stamp_id) {
            $exists = StampHistory::where('protected_area_id', $request->protected_area_id)
                ->where('stamp_id', $request->stamp_id)
                ->exists();

            if ($exists) {
                return redirect()->back()
                    ->withErrors(['error' => 'Энэ тамга аль хэдийн тухайн газарт олгогдсон байна'])
                    ->withInput();
            }
        }

        // Хуучин бичлэгийг устгаж, шинийг үүсгэх
        $stampHistory->delete();

        StampHistory::create([
            'protected_area_id' => $request->protected_area_id,
            'stamp_id' => $request->stamp_id,
            'assigned_date' => $request->assigned_date,
        ]);

        // Success message with details
        $protectedArea = ProtectedArea::find($request->protected_area_id);
        $stamp = Stamp::find($request->stamp_id);

        $message = "Амжилттай шинэчлэгдлээ! ({$protectedArea->name} - {$stamp->name})";

        return redirect()->route('stamp_add.index')
            ->with('success', $message);
    }

    /**
     * Remove the specified stamp assignment
     */
    public function destroy($protectedAreaId, $stampId)
    {
        $deleted = StampHistory::where('protected_area_id', $protectedAreaId)
            ->where('stamp_id', $stampId)
            ->delete();

        if ($deleted) {
            return redirect()->route('stamp_add.index')
                ->with('success', 'Амжилттай устгагдлаа!');
        }

        return redirect()->route('stamp_add.index')
            ->with('error', 'Устгах явцад алдаа гарлаа');
    }
}
