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
        $query->with(['users','devices']);
        $results = $query->get();
        return response()->json([
            'data' => $results
        ]);
    }

    public function get_one($id)
    {
        $query = Maintenance::query();
        $query->with(['users','devices']);
        $query->where('id', $id);
        $result = $query->first();
        return response()->json([
            'data' => $result
        ]);
    }
}
