<?php

namespace App\Http\Controllers;

use App\Models\DetailMaintenance;
use App\Models\Maintenance;
use Illuminate\Http\Request;

class DetailMaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('detail-maintenances.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $maintenances = Maintenance::with('users')->get();
        return view('detail-maintenances.create')->with([
            'maintenances' => $maintenances
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
                'cost' => ['required'],
                'detail' => ['required'],
                'id_maintenance' => ['required'],
            ]);

            $data = [
                'cost' => $request->input('cost'),
                'detail' => $request->input('detail'),
                'id_maintenance' => $request->input('id_maintenance'),
            ];

            DetailMaintenance::create($data);

            return redirect()->back()->with('message', 'Berhasil menambahkan data detail maintenance.');
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
        $detail_maintenance = DetailMaintenance::findOrFail($id);
        return view('detail-maintenances.show')->with([
            'detail_maintenance' => $detail_maintenance
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
        $detail_maintenance = DetailMaintenance::findOrFail($id);
        return view('detail-maintenances.edit')->with([
            'detail_maintenance' => $detail_maintenance
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
                'cost' => ['required'],
                'detail' => ['required'],
                'id_maintenance' => ['required'],
            ]);

            $data = [
                'cost' => $request->input('cost'),
                'detail' => $request->input('detail'),
                'id_maintenance' => $request->input('id_maintenance'),
            ];

            $detail_maintenance = DetailMaintenance::findOrFail($id);

            $detail_maintenance->update($data);

            return redirect()->back()->with('message', 'Berhasil memperbarui data detail maintenance.');
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
            $detail_maintenance = DetailMaintenance::findOrFail($id);
            $detail_maintenance->delete();
            return response()->json([
                'message' => 'Berhasil menghapus data detail maintenance'
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
