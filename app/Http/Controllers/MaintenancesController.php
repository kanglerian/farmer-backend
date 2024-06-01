<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\User;
use Illuminate\Http\Request;

class MaintenancesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('maintenances.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('maintenances.create')->with([
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
                'date' => ['required'],
                'maintenance' => ['required'],
                'cost' => ['required'],
                'id_user' => ['required'],
            ]);

            $data = [
                'date' => $request->input('date'),
                'maintenance' => $request->input('maintenance'),
                'cost' => $request->input('cost'),
                'id_user' => $request->input('id_user'),
            ];

            Maintenance::create($data);

            return redirect()->back()->with('message', 'Berhasil menambahkan data maintenance.');
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
        $maintenance = Maintenance::findOrFail($id);
        return view('maintenances.show')->with([
            'maintenance' => $maintenance
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
        $maintenance = Maintenance::findOrFail($id);
        return view('maintenances.edit')->with([
            'maintenance' => $maintenance
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
                'maintenance' => ['required'],
                'cost' => ['required'],
                'id_user' => ['required'],
            ]);

            $data = [
                'date' => $request->input('date'),
                'maintenance' => $request->input('maintenance'),
                'cost' => $request->input('cost'),
                'id_user' => $request->input('id_user'),
            ];

            $maintenance = Maintenance::findOrFail($id);

            $maintenance->update($data);

            return redirect()->back()->with('message', 'Berhasil memperbarui data maintenance.');
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
            $maintenance = Maintenance::findOrFail($id);
            $maintenance->delete();
            return response()->json([
                'message' => 'Berhasil menghapus data maintenance.'
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
