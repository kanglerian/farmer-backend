<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\User;
use Illuminate\Http\Request;

class DeviceController extends Controller
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
        $users = User::where('role','Petugas')->get();
        return view('devices.create')->with([
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
                'name' => ['required', 'string'],
                'location' => ['required', 'string'],
                'id_user' => ['required']
            ]);

            $uniqueID = uniqid('', true);
            $data = [
                'uuid' => explode('.', $uniqueID)[0],
                'name' => $request->input('name'),
                'location' => $request->input('location'),
                'id_user' => $request->input('id_user'),
            ];

            Device::create($data);

            return redirect()->back()->with('message', 'Berhasil menambahkan data perangkat.');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::all();
        $device = Device::findOrFail($id);
        return view('devices.edit')->with([
            'device' => $device,
            'users' => $users
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
        //
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
                'message' => 'Berhasil menghapus perangkat'
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
