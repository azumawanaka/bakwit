<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\EvacuationCenter;
use App\Models\EvacuationCenterType;
use App\Services\EvacuationCenterService;
use Illuminate\Http\Request;

class MdrrmoController extends Controller
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
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $barangayIds = [];
        $storedBarangay = EvacuationCenter::select('barangay_id')->get();
        foreach ($storedBarangay as $brgy) {
            $barangayIds[] = $brgy->barangay_id;
        }

        $evacuationCenters = $this->evacuationCenterService->centers($request);
        $barangays = Barangay::whereNotIn('id', $barangayIds)->orderBy('name', 'asc')->get();
        return view('pages.mdrrmo.index', [
            'barangays' => $barangays,
            'evacuation_center_types' => EvacuationCenterType::all(),
            'evacuationCenters' => $evacuationCenters,
            'allBarangay' => Barangay::orderBy('name', 'asc')->get(),
        ]);
    }
}
