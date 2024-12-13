<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeliveryLocations;

class DeliveryController extends Controller
{
    public function viewaddlocation(){
        return view('admin.location');
    }
    public function viewlocation(){
        $locations = DeliveryLocations::all();
        return view('admin.viewlocation', compact('locations'));
    }

    public function storelocation(Request $request)
    {
        $request->validate([
            'location' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
        ]);

        DeliveryLocations::create([
            'location' => $request->location,
            'price' => $request->price,
        ]);

        return redirect()->route('location')->with('success', 'Location added successfully!');
    }
}

