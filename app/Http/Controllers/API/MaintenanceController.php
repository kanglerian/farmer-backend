<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Maintenance;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function get_all($id)
    {
        $resultQuery = Maintenance::query();
        $resultQuery->where('id_subdevice', $id);
        $resultQuery->with(['subdevice','subdevice.device']);
        $result = $resultQuery->get();
        return response()->json([
            'result' => $result
        ]);
    }

    public function get_one($id)
    {
        $result = Maintenance::with(['subdevice','subdevice.device'])->where('id',$id)->first();
        return response()->json([
            'result' => $result
        ]);
    }
}
