<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\RoleDevice;
use Illuminate\Http\Request;

class RoleDeviceController extends Controller
{
    public function get_all()
    {
        $query = RoleDevice::query();
        $results = $query->get();
        return response()->json([
            'results' => $results
        ]);
    }

    public function get_one($id)
    {
        $query = RoleDevice::query();
        $query->where('id', $id);
        $result = $query->first();
        return response()->json([
            'result' => $result
        ]);
    }
}
