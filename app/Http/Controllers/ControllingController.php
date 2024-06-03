<?php

namespace App\Http\Controllers;

use App\Models\Controlling;
use App\Models\DetailRoleDevice;
use App\Models\Device;
use App\Models\RoleDevice;
use Illuminate\Http\Request;

class ControllingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('controlling.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('controlling.create');
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
                'date' => ['required'],
                'duration' => ['required'],
                'status' => ['required'],
                'id_sub_device' => ['required'],
            ]);

            $data = [
                'date' => $request->input('date'),
                'duration' => $request->input('duration'),
                'status' => $request->input('status'),
                'id_sub_device' => $request->input('id_sub_device'),
            ];

            Controlling::create($data);

            return redirect()->back()->with('message', 'Berhasil menambahkan data controlling.');
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
        $detailroledevice = DetailRoleDevice::with('devices')->where('id_sub_device', $id)->first();
        $controlling = Controlling::where('id_sub_device', $id)->first();
        return view('controlling.show')->with([
            'detailroledevice' => $detailroledevice,
            'controlling' => $controlling
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
        $controlling = Controlling::findOrFail($id);
        return view('controlling.edit')->with([
            'controlling' => $controlling
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
                'date' => ['required'],
                'duration' => ['required'],
                'status' => ['required'],
                'id_sub_device' => ['required'],
            ]);

            $data = [
                'date' => $request->input('date'),
                'duration' => $request->input('duration'),
                'status' => $request->input('status'),
                'id_sub_device' => $request->input('id_sub_device'),
            ];

            $controlling = Controlling::findOrFail($id);

            $controlling->update($data);

            return redirect()->back()->with('message', 'Berhasil memperbarui data controlling.');
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
            $controlling = Controlling::findOrFail($id);
            $controlling->delete();
            return response()->json([
                'message' => 'Berhasil menghapus data detail controlling'
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
