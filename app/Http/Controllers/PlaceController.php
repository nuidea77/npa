<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\City;
class PlaceController extends Controller
{
    public function index(Request $request)
    {
        // Query places with their associated city
        $query = Place::with('city');

        // Filter by province (city_id)
        if ($request->filled('city_id')) {
            $query->where('province', $request->city_id); // province is the foreign key referencing city->id
        }

        // Filter by place name (place_id)
        if ($request->filled('place_id')) {
            $query->where('id', $request->place_id);
        }

        // Paginated results
        $places = $query->orderBy('created_at', 'asc')->paginate(12);

        // Fetch all cities for the province dropdown
        $cities = City::all();

        // Fetch all places for the name dropdown
        $placesOptions = Place::with('translations')->get();


        return view('place.index', compact('places', 'cities', 'placesOptions'));
    }
    public function view($slug)   {
        $data = Place::with('translations')->with('city')->where('slug',  $slug)->first();
        return view('place.view')
        ->with('data', $data);
    }
}
