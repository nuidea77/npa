<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Slider;
use App\Models\Post;
use App\Models\City;
use App\Models\Place;

class HomeController extends Controller
{
    public function index() {
        $program = Program::with('translations')->orderBy('order', 'asc')->paginate(4);
        $slider = Slider::orderBy('order', 'asc')->get();
        $post = Post::with('translations')->where([['status', '=','PUBLISHED']])->orderBy('created_at', 'desc')->paginate(4);
        // Fetch all cities for the province dropdown
        $cities = City::all();

        // Fetch all places for the name dropdown
        $placesOptions = Place::all();


        return view('welcome', compact('cities', 'placesOptions'))
        ->with('program', $program)
        ->with('slider', $slider)
        ->with('post', $post);

    }
}
