<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DetailRoleDevice;
use Illuminate\Http\Request;

class DetailRoleDeviceController extends Controller
{
    public function get_all()
    {
        $query = DetailRoleDevice::query();
        $query->with(['devices','roledevice','roledevice.devices','roledevice.users']);
        $results = $query->get();
        return response()->json([
            'results' => $results
        ]);
    }

    public function get_one($id)
    {
        $query = DetailRoleDevice::query();
        $query->with(['detailroledevice','roledevice']);
        $query->where('id', $id);
        $result = $query->first();
        return response()->json([
            'result' => $result
        ]);
    }
}
