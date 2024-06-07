<?php

namespace App\Http\Controllers;

use App\Models\Controlling;
use App\Models\DetailControlling;
use Illuminate\Http\Request;

class DetailControllingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('detail-controlling.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $controlling = Controlling::with('devices')->get();
        return view('detail-controlling.create')->with([
            'controlling' => $controlling
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
                'id_controlling' => ['required'],
                'temperature' => ['required'],
                'watt' => ['required'],
            ]);

            $data = [
                'id_controlling' => $request->input('id_controlling'),
                'temperature' => $request->input('temperature'),
                'watt' => $request->input('watt'),
            ];

            DetailControlling::create($data);

            return redirect()->back()->with('message', 'Berhasil menambahkan data detail controlling.');
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
        $detail_controlling = DetailControlling::findOrFail($id);
        return view('detail-controlling.show')->with([
            'detail_controlling' => $detail_controlling
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
        $detail_controlling = DetailControlling::findOrFail($id);
        return view('detail-controlling.edit')->with([
            'detail_controlling' => $detail_controlling
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
                'id_controlling' => ['required'],
                'temperature' => ['required'],
                'watt' => ['required'],
            ]);

            $data = [
                'id_controlling' => $request->input('id_controlling'),
                'temperature' => $request->input('temperature'),
                'watt' => $request->input('watt'),
            ];

            $detail_controlling = DetailControlling::findOrFail($id);

            $detail_controlling->update($data);

            return redirect()->back()->with('message', 'Berhasil memperbarui data detail controlling.');
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
            $detail_controlling = DetailControlling::findOrFail($id);
            $detail_controlling->delete();
            return response()->json([
                'message' => 'Berhasil menghapus data detail controlling'
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
