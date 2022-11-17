<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\EvacuationCenter;
use App\Models\EvacuationCenterType;
use App\Models\Evacuee;
use App\Models\File;
use App\Services\EvacuationCenterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $barangays = Barangay::whereNotIn('id', $barangayIds)->orderBy('name', 'asc')->get();
        return view('pages.evacuation_center.index', [
            'barangays' => $barangays,
            'evacuation_center_types' => EvacuationCenterType::all(),
            'evacuationCenters' => $evacuationCenters,
            'allBarangay' => Barangay::orderBy('name', 'asc')->get(),
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $evacuationCenter = $this->evacuationCenterService->store($request->all());
            if($request->hasFile('files')) {
                $allowedfileExtension = ['pdf', 'jpg', 'png', 'jpeg'];
                $files = $request->file('files');
                foreach ($files as $file) {
                    $filename = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $check = in_array($extension, $allowedfileExtension);

                    $filePath = $file->storePubliclyAs('public_uploads', $filename, 'public');
                    $evacuationCenter->files()->create([
                        'name' => $filename,
                        'path' => $filePath,
                    ]);
                }
            }
        } catch (\Exception $exception) {
            return redirect()->back()->with('msg', 'Error when saving. Please try again or contact administrator.');
        }
        return redirect()->back()->with('msg', 'Evacuation Center is added!');
    }

    /**
     * @param EvacuationCenter $bdrrmo
     * @return JsonResponse
     */
    public function getCenter(EvacuationCenter $bdrrmo): JsonResponse
    {
        $data = [
            'max_capacity' => $bdrrmo->max_capacity,
            'barangay' => $bdrrmo->barangay_id,
            'center_type' => $bdrrmo->evacuation_center_type_id,
            'evacuee' => $bdrrmo->evacuee,
            'files' => $bdrrmo->files,
        ];
        return response()->json($data);
    }

    /**
     * @param EvacuationCenter $bdrrmo
     * @param Request $request
     * @return void
     */
    public function update(EvacuationCenter $bdrrmo, Request $request)
    {
        $evacuees = $request->only([
            'family_count',
            'male_count',
            'female_count',
            'pwd_count',
        ]);

        if ($bdrrmo->evacuee()->count() > 0) {
            $bdrrmo->evacuee()->update($evacuees);
        } else {
            Evacuee::create([
                'evacuation_center_id' => $bdrrmo->id,
                'family_count' => $evacuees['family_count'],
                'male_count' => $evacuees['male_count'],
                'female_count' => $evacuees['female_count'],
                'pwd_count' => $evacuees['pwd_count'],
            ]);
        }

        return redirect()->back()->with('msg', 'Evacuation Center is modified!');

//        if($request->hasFile('files')) {
//            $allowedfileExtension = ['pdf', 'jpg', 'png', 'jpeg'];
//            $files = $request->file('files');
//            foreach ($files as $file) {
//                $filename = $file->getClientOriginalName();
//                $extension = $file->getClientOriginalExtension();
//                $check = in_array($extension, $allowedfileExtension);
//
//                $filePath = $file->storePubliclyAs('public_uploads', $filename, 'public');
//                $evacuationCenter->files()->create([
//                    'name' => $filename,
//                    'path' => $filePath,
//                ]);
//            }
//        }
    }
}
