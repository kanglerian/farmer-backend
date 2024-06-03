<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DetailRoleDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailRoleDeviceController extends Controller
{
    public function get_all()
    {
        $query = DetailRoleDevice::query();
        $query->with(['devices','roledevice','roledevice.devices','roledevice.users']);
        if (Auth::user()->level === 0) {
            $user = Auth::user();
            $query->whereHas('roledevice', function($queryIsi) use ($user) {
                $queryIsi->where('id_user', $user->id);
            });
        }
        $results = $query->get();
        return response()->json([
            'results' => $results,
            'id' => Auth::user(),
        ]);
    }

    public function get_one($id)
    {
        $query = DetailRoleDevice::query();
        $query->with(['detailroledevice','roledevice']);
        $query->where('id', $id);
        $result = $query->first();
        return response()->json([
            'result' => $result
        ]);
    }
}
