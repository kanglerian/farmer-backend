<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Subdevice;
use Illuminate\Http\Request;

class SubdeviceController extends Controller
{
    public function get_all($uuid)
    {
        $subDeviceQuery = Subdevice::query();
        $subDeviceQuery->where('id_device', $uuid);
        $subDeviceQuery->with(['device']);
        $subDevices = $subDeviceQuery->get();
        return response()->json([
            'subDevices' => $subDevices
        ]);
    }

    public function get_one($id)
    {
        $subdevice = Subdevice::findOrFail($id);
        return response()->json([
            'subdevice' => $subdevice,
        ]);
    }
}
