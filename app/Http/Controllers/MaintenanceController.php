<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Subdevice;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        try {
            $request->validate([
                'date' => ['required'],
                'id_subdevice' => ['required'],
                'problem' => ['required'],
                'cost' => ['required'],
            ]);

            $data = [
                'date' => $request->input('date'),
                'id_subdevice' => $request->input('id_subdevice'),
                'problem' => $request->input('problem'),
                'cost' => $request->input('cost'),
            ];

            Maintenance::create($data);

            return redirect()->back()->with('message', 'Berhasil menambahkan perawatan.');
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
        $subdevice = Subdevice::findOrFail($id);
        $total_maintenance = Maintenance::where('id_subdevice', $id)->count();
        return view('maintenances.show')->with([
            'subdevice' => $subdevice,
            'total_maintenance' => $total_maintenance
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
        try {
            $request->validate([
                'date' => ['required'],
                'id_subdevice' => ['required'],
                'problem' => ['required'],
                'cost' => ['required'],
            ]);

            $maintenance = Maintenance::findOrFail($id);

            $data = [
                'date' => $request->input('date'),
                'id_subdevice' => $request->input('id_subdevice'),
                'problem' => $request->input('problem'),
                'cost' => $request->input('cost'),
            ];

            $maintenance->update($data);

            return redirect()->back()->with('message', 'Berhasil mengubah data perawatan.');
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
        $maintenance = Maintenance::findOrFail($id);
        $maintenance->delete();
        return response()->json('message', 'Berhasil menghapus data perawatan.');
    }
}
