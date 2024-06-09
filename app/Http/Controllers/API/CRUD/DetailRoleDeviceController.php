<?php

namespace App\Http\Controllers\API\CRUD;

use App\Http\Controllers\Controller;
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
        $results = DetailRoleDevice::with(['devices','roledevice','roledevice.users','roledevice.devices'])->get();
        return response()->json([
            'results' => $results
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'id_role' => $request->input('id_role'),
            'id_sub_device' => $request->input('id_sub_device'),
            'status' => $request->input('status'),

        ];
        DetailRoleDevice::create($data);
        return response()->json([
            'message' => 'Detail role device berhasil ditambahkan.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = DetailRoleDevice::where('id', $id)->with(['devices','roledevice','roledevice.users','roledevice.devices'])->first();
        return response()->json([
            'result' => $result
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
        //
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
        //
    }
}
