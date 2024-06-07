<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DetailControlling;
use Illuminate\Http\Request;

class DetailControllingController extends Controller
{
    public function get_all()
    {
        $query = DetailControlling::query();
        $results = $query->get();
        return response()->json([
            'results' => $results
        ]);
    }

    public function get_one($id)
    {
        $query = DetailControlling::query();
        $query->where('id_controlling', $id);
        $results = $query->get();
        return response()->json([
            'results' => $results
        ]);
    }
}
