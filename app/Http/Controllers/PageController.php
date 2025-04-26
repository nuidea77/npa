<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Faq;
class PageController extends Controller
{
    public function about(){
        $teams = Team::orderBy('order', 'asc')->get();

        return view('pages.about')
        ->with('teams', $teams);
    }

    public function faq(){
        $faqs = Faq::orderBy('order', 'asc')->get();

        return view('pages.faq')
        ->with('faqs', $faqs);
    }
}
