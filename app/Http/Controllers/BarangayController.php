<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use Illuminate\Http\Request;

class BarangayController extends Controller
{
    public function __construct()
    {
    }

    public function fetchLocations()
    {
        $locations = Barangay::addSelect(['name', 'lat', 'long'])->get();
        return response()->json($locations);
    }
}
