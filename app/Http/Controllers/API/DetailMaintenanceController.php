<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DetailMaintenance;
use Illuminate\Http\Request;

class DetailMaintenanceController extends Controller
{
    public function get_all()
    {
        $query = DetailMaintenance::query();
        $results = $query->get();
        return response()->json([
            'results' => $results
        ]);
    }

    public function get_one($id)
    {
        $query = DetailMaintenance::query();
        $query->where('id', $id);
        $result = $query->first();
        return response()->json([
            'result' => $result
        ]);
    }
}
