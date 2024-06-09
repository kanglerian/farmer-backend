<?php

namespace App\Http\Controllers;

use App\Models\Controlling;
use App\Models\DetailControlling;
use App\Models\DetailRoleDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailRoleDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = DetailRoleDevice::query();
        $query->with(['devices', 'roledevice', 'roledevice.devices', 'roledevice.users']);
        if (Auth::user()->level === 0) {
            $user = Auth::user();
            $query->whereHas('roledevice', function ($queryIsi) use ($user) {
                $queryIsi->where('id_user', $user->id);
            });
        }

        $results = $query->get();

        $detailroledevices = [];
        foreach ($results as $result) {
            $controlling = Controlling::where('id_sub_device', $result->id_sub_device)->orderBy('id','DESC')->first();
            if($controlling){
                $detail_controlling = DetailControlling::where('id_controlling', $controlling->id)->orderBy('id','DESC')->first();
            } else {
                $detail_controlling = null;
            }
            array_push($detailroledevices, [
                "id" => $result->id,
                "id_role" => $result->id_role,
                "id_sub_device" => $result->id_sub_device,
                "status" => $result->status,
                "created_at" => $result->created_at,
                "updated_at" => $result->updated_at,
                "devices" => $result->devices,
                "roledevice" => $result->roledevice,
                "controlling" => $controlling,
                "detail_controlling" => $detail_controlling
            ]);
        }
        return view('detail-role-device.index')->with([
            'detailroledevices' => $detailroledevices
        ]);
        // return response()->json($detailroledevices);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('detail-role-device.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_sub_device' => ['required'],
                'status' => ['required'],
            ]);

            $data = [
                'id_sub_device' => $request->input('id_sub_device'),
                'status' => $request->input('status'),
            ];

            DetailRoleDevice::create($data);

            return redirect()->back()->with('message', 'Berhasil menambahkan data detail role device.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail_role_device = DetailRoleDevice::findOrFail($id);
        return view('detail-role-device.show')->with([
            'detail_role_device' => $detail_role_device
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detail_role_device = DetailRoleDevice::findOrFail($id);
        return view('detail-role-device.edit')->with([
            'detail_role_device' => $detail_role_device
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'id_sub_device' => ['required'],
                'status' => ['required'],
            ]);

            $data = [
                'id_sub_device' => $request->input('id_sub_device'),
                'status' => $request->input('status'),
            ];

            $detail_role_device = DetailRoleDevice::findOrFail($id);

            $detail_role_device->update($data);

            return redirect()->back()->with('message', 'Berhasil memperbarui data detail role device.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $detail_role_device = DetailRoleDevice::findOrFail($id);
            $detail_role_device->delete();
            return response()->json([
                'message' => 'Berhasil menghapus data device'
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function get_all()
    {
        $query = DetailRoleDevice::query();
        $query->with(['devices', 'roledevice', 'roledevice.devices', 'roledevice.users']);
        if (Auth::user()->level === 0) {
            $user = Auth::user();
            $query->whereHas('roledevice', function ($queryIsi) use ($user) {
                $queryIsi->where('id_user', $user->id);
            });
        }
        $results = $query->get();
        return response()->json([
            'data' => $results,
        ]);
    }

    public function get_one($id)
    {
        $query = DetailRoleDevice::query();
        $query->with(['detailroledevice', 'roledevice']);
        if (Auth::user()->level === 0) {
            $user = Auth::user();
            $query->whereHas('roledevice', function ($queryIsi) use ($user) {
                $queryIsi->where('id_user', $user->id);
            });
        }
        $query->where('id', $id);
        $result = $query->first();
        return response()->json([
            'data' => $result
        ]);
    }
}
