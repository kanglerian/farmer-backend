<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Maintenance;
use Illuminate\Http\Request;

class MaintenancesController extends Controller
{
    public function get_all()
    {
        $query = Maintenance::query();
        $results = $query->get();
        return response()->json([
            'results' => $results
        ]);
    }

    public function get_one($id)
    {
        $query = Maintenance::query();
        $query->where('id', $id);
        $result = $query->first();
        return response()->json([
            'result' => $result
        ]);
    }
}
