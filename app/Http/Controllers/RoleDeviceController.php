<?php

namespace App\Http\Controllers;

use App\Models\Controlling;
use App\Models\DetailRoleDevice;
use App\Models\Device;
use App\Models\RoleDevice;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RoleDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total = RoleDevice::count();
        return view('roledevice.index')->with([
            'total' => $total
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $devices_master = Device::where('status', 'Master')->get();
        $devices = Device::where('status', 'Pompa')->get();
        $users = User::where('level', '0')->get();
        return view('roledevice.create')->with([
            'devices_master' => $devices_master,
            'devices' => $devices,
            'users' => $users
        ]);
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
                'id_device' => ['required'],
                'id_user' => ['required'],
                'id_sub_device' => ['required'],
                'status' => ['required'],
            ]);

            $data = [
                'id_device_master' => $request->input('id_device'),
                'id_user' => $request->input('id_user'),
            ];

            $role_device = RoleDevice::create($data);

            $count = $request->input('status');

            $data_detail = [];

            for ($i = 0; $i < count($count); $i++) {
                array_push($data_detail, [
                    'id_role' => $role_device->id,
                    'id_sub_device' => $request->input('id_sub_device')[$i],
                    'status' => $request->input('status')[$i],
                    'created_at' => Carbon::now()->setTimezone('Asia/Jakarta'),
                    'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta'),
                ]);
            }


            DetailRoleDevice::insert($data_detail);

            return redirect()->back()->with('message', 'Berhasil menambahkan data role device.');
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
        $total = DetailRoleDevice::where('id_role', $id)->count();
        $role_device = RoleDevice::findOrFail($id);
        return view('roledevice.show')->with([
            'total' => $total,
            'role_device' => $role_device
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
        $role_device = RoleDevice::findOrFail($id);
        $users = User::where('level', '0')->get();
        return view('roledevice.edit')->with([
            'role_device' => $role_device,
            'users' => $users,
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
                'id_user' => ['required'],
            ]);

            $data = [
                'id_user' => $request->input('id_user'),
            ];

            $role_device = RoleDevice::findOrFail($id);

            $role_device->update($data);

            return redirect()->back()->with('message', 'Berhasil memperbarui data role device.');
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
            $role_device = RoleDevice::findOrFail($id);
            $role_device->delete();
            return response()->json([
                'message' => 'Berhasil menghapus data role device.'
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
