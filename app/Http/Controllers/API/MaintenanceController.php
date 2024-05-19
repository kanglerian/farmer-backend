<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Maintenance;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function get_all($id)
    {
        $maintenanceQuery = Maintenance::query();
        $maintenanceQuery->where('id_subdevice', $id);
        $maintenanceQuery->with(['subdevice','subdevice.device']);
        $maintenances = $maintenanceQuery->get();
        return response()->json([
            'maintenances' => $maintenances
        ]);
    }
}
