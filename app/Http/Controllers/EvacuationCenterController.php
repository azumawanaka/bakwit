<?php

namespace App\Http\Controllers;

use App\Modules\Clients\Client;
use App\Services\EvacuationCenterService;

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

    public function index()
    {
        return view('evacuation_center.index');
    }
}
