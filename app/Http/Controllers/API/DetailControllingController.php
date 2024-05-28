<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Controlling;
use App\Models\DetailControlling;
use Illuminate\Http\Request;

class DetailControllingController extends Controller
{
    public function get_all($id)
    {
        $resultQuery = DetailControlling::query();
        $resultQuery->where('id_controlling', $id);
        $resultQuery->with(['controlling','controlling.subdevice','controlling.subdevice.device']);
        $result = $resultQuery->get();
        return response()->json([
            'result' => $result
        ]);
    }

    public function get_one($id)
    {
        $result = DetailControlling::with(['controlling','controlling.subdevice','controlling.subdevice.device'])->where('id',$id)->first();
        return response()->json([
            'result' => $result
        ]);
    }
}
