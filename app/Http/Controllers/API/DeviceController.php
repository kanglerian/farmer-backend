<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function get()
    {
        $deviceQuery = Device::query();
        $deviceQuery->with(['petugas']);
        $devices = $deviceQuery->get();
        return response()->json([
            'devices' => $devices
        ]);
    }
}
