<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Controlling;
use Illuminate\Http\Request;

class ControllingController extends Controller
{
    public function get_all()
    {
        $query = Controlling::query();
        $query->with(['devices']);
        $results = $query->get();
        return response()->json([
            'data' => $results
        ]);
    }

    public function get_one($id)
    {
        $query = Controlling::query();
        $query->where('id', $id);
        $result = $query->first();
        return response()->json([
            'data' => $result
        ]);
    }
}
