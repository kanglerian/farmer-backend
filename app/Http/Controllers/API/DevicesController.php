<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

class DevicesController extends Controller
{
    public function get_all()
    {
        $query = Device::query();
        $results = $query->get();
        return response()->json([
            'data' => $results
        ]);
    }

    public function get_one($id)
    {
        $query = Device::query();
        $query->where('id', $id);
        $result = $query->first();
        return response()->json([
            'data' => $result
        ]);
    }
}
