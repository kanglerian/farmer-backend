<?php

namespace App\Http\Controllers;

use App\Models\DetailRoleDevice;
use Illuminate\Http\Request;

class DetailRoleDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total = DetailRoleDevice::count();
        return view('detail-role-device.index')->with([
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
}
