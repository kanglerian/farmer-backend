<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Controlling;
use Illuminate\Http\Request;

class ControllingController extends Controller
{
    public function get()
    {
        $resultQuery = Controlling::query();
        $resultQuery->with(['subdevice', 'subdevice.device']);
        $result = $resultQuery->get();
        return response()->json([
            'result' => $result
        ]);
    }
    public function get_all($id)
    {
        $resultQuery = Controlling::query();
        $resultQuery->where('id_subdevice', $id);
        $resultQuery->with(['subdevice', 'subdevice.device']);
        $result = $resultQuery->get();
        return response()->json([
            'result' => $result
        ]);
    }

    public function get_one($id)
    {
        $result = Controlling::with(['subdevice', 'subdevice.device'])->where('id', $id)->first();
        return response()->json([
            'result' => $result
        ]);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request)
    {
        $controlling = Controlling::findOrFail($request->id);
        $data = [
            'status' => !$controlling->status
        ];
        $controlling->update($data);
        return response()->json([
            'message' => 'Status sudah diubah!',
        ]);
    }
}
