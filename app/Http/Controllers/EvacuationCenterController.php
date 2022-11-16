<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\EvacuationCenter;
use App\Models\EvacuationCenterType;
use App\Services\EvacuationCenterService;
use Illuminate\Http\Request;

class EvacuationCenterController extends Controller
{
    /**
     * @var EvacuationCenterService
     */
    private $evacuationCenterService;

    /**
     * @param EvacuationCenterService $evacuationCenterService
     */
    public function __construct(EvacuationCenterService $evacuationCenterService)
    {
        $this->evacuationCenterService = $evacuationCenterService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $barangayIds = [];
        $storedBarangay = EvacuationCenter::select('id')->get();
        foreach ($storedBarangay as $brgy) {
            $barangayIds[] = $brgy->id;
        }

        $evacuationCenters = $this->evacuationCenterService->centers();
        $barangays = Barangay::whereNotIn('id', $barangayIds)->get();
        return view('evacuation_center.index', [
            'barangays' => $barangays,
            'evacuation_center_types' => EvacuationCenterType::all(),
            'evacuationCenters' => $evacuationCenters,
        ]);
    }

    public function store(Request $request)
    {
        $response = $this->evacuationCenterService->store($request->all());
        dd($response);
    }
}
