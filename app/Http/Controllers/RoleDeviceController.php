<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\RoleDevice;
use App\Models\User;
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
        return view('roledevice.index');
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
                'id_device_master' => ['required'],
                'id_user' => ['required'],
            ]);

            $data = [
                'id_device_master' => $request->input('id_device_master'),
                'id_user' => $request->input('id_user'),
            ];

            RoleDevice::create($data);

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
        $role_device = RoleDevice::findOrFail($id);
        return view('roledevice.show')->with([
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
        return view('roledevice.edit')->with([
            'role_device' => $role_device
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
                'id_device_master' => ['required'],
                'id_user' => ['required'],
            ]);

            $data = [
                'id_device_master' => $request->input('id_device_master'),
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
