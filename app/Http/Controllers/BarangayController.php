<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use Illuminate\Http\Request;

class BarangayController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchLocations()
    {
        $locations = Barangay::with([
            'evacuationCenter',
            'evacuationCenter.evacuationCenterType',
            'evacuationCenter.evacuee',
            'evacuationCenter.files',
            ])
            ->get();
        return response()->json($locations);
    }
}
