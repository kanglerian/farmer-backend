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

    public function get_by_id_sub_device($id)
    {
        $query = Controlling::query();
        $query->where('id_sub_device', $id);
        $query->where('status', 'Belum dieksekusi');
        $results = $query->get();
        if ($results->isEmpty()) {
            echo "0";
        } else {
            foreach ($results as $result) {
                echo $result->id . "-" . $result->duration;
            }
        }
    }
}
