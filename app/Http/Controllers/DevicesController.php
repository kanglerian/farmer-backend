<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DevicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('devices.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('devices.create');
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
                'name' => ['required'],
                'coordinate_device_x' => ['required'],
                'coordinate_device_y' => ['required'],
                'status' => ['required'],
                'condition' => ['required'],
            ]);

            $data = [
                'name' => $request->input('name'),
                'coordinate_device_x' => $request->input('coordinate_device_x'),
                'coordinate_device_y' => $request->input('coordinate_device_y'),
                'status' => $request->input('status'),
                'condition' => $request->input('condition'),
            ];

            Device::create($data);

            return redirect()->back()->with('message', 'Berhasil menambahkan data device.');
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
        $device = Device::findOrFail($id);
        return view('devices.show')->with([
            'device' => $device
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
        $device = Device::findOrFail($id);
        return view('devices.edit')->with([
            'device' => $device
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
                'name' => ['required'],
                'coordinate_device_x' => ['required'],
                'coordinate_device_y' => ['required'],
                'status' => ['required'],
                'condition' => ['required'],
            ]);

            $data = [
                'name' => $request->input('name'),
                'coordinate_device_x' => $request->input('coordinate_device_x'),
                'coordinate_device_y' => $request->input('coordinate_device_y'),
                'status' => $request->input('status'),
                'condition' => $request->input('condition'),
            ];

            $device = Device::findOrFail($id);

            $device->update($data);

            return redirect()->back()->with('message', 'Berhasil memperbarui data device.');
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
            $device = Device::findOrFail($id);
            $device->delete();
            return response()->json([
                'message' => 'Berhasil menghapus data device'
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
