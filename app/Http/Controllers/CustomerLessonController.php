<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class CustomerLessonController extends Controller
{
    public function view($id)
    {
        // Fetch the lesson with translations using only the necessary fields for optimization
        $lesson = Lesson::with('translations')->findOrFail($id);

        // Current time
        $now = now();

        // Check if lesson has started and if it has finished
        $startedNotYet = $lesson->started_at && $now->lt($lesson->started_at);
        $finishedPassed = $lesson->finished_at && $now->gt($lesson->finished_at);

        // Check if user is authenticated
        $isAuthenticated = Auth::guard('customer')->check();


        // Determine modal status and message based on conditions
        $modalStatus = $this->determineModalStatus($lesson, $isAuthenticated, $startedNotYet, $finishedPassed);

        return view('customer.lesson' , [
            'lesson' => $lesson,
            'startedNotYet' => $startedNotYet,
            'finishedPassed' => $finishedPassed,
            'isAuthenticated' => $isAuthenticated,
            'modalStatus' => $modalStatus,
        ]);
    }

    private function determineModalStatus($lesson, $isAuthenticated, $startedNotYet, $finishedPassed)
    {
        // If the lesson requires authentication (type 1)
        if ($lesson->type == 1 && !$isAuthenticated) {
            return $this->modalResponse('login', 'Та хичээлийг үзэхийн тулд нэвтрэх шаардлагатай');
        }

        // If the lesson has not started yet
        if ($startedNotYet) {
            return $this->modalResponse('not_started', 'Хичээл эхлэх хугацаа болоогүй байна', $lesson->started_at);
        }

        // If the lesson has finished
        if ($finishedPassed) {
            return $this->modalResponse('finished', 'Хичээл дууссан байна', $lesson->finished_at);
        }

        // No modal
        return $this->modalResponse();
    }

    /**
     * Generate a modal response.
     *
     * @param string|null $type
     * @param string|null $message
     * @param string|null $time
     * @return array
     */
    private function modalResponse($type = null, $message = null, $time = null)
    {
        return [
            'show' => $type !== null,
            'type' => $type,
            'message' => $message,
            'startTime' => $time ? Carbon::parse($time)->format('Y-m-d H:i:s') : null,
            'endTime' => $time ? Carbon::parse($time)->format('Y-m-d H:i:s') : null,
        ];
    }
}
