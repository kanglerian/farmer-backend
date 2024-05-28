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
                'id_controlling' => ['required'],
                'time' => ['required'],
                'temperature' => ['required'],
                'voltage' => ['required']
            ]);

            $data = [
                'id_controlling' => $request->input('id_controlling'),
                'time' => $request->input('time'),
                'temperature' => $request->input('temperature'),
                'voltage' => $request->input('voltage'),
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
        $controlling = Controlling::with(['subdevice'])->where('id', $id)->first();
        return view('detail-controlling.show')->with([
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
                'id_controlling' => ['required'],
                'time' => ['required'],
                'temperature' => ['required'],
                'voltage' => ['required']
            ]);

            $detail_controlling = DetailControlling::findOrFail($id);

            $data = [
                'id_controlling' => $request->input('id_controlling'),
                'time' => $request->input('time'),
                'temperature' => $request->input('temperature'),
                'voltage' => $request->input('voltage'),
            ];

            $detail_controlling->update($data);

            return redirect()->back()->with('message', 'Berhasil mengubah data detail pengendalian.');
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
        $detail_controlling = DetailControlling::findOrFail($id);
        $detail_controlling->delete();
        return response()->json([
            'message' => 'Berhasil menghapus data detail pengendalian.'
        ]);
    }
}
