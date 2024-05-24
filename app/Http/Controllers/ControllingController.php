<?php

namespace App\Http\Controllers;

use App\Models\Controlling;
use App\Models\Subdevice;
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
                'duration' => ['required'],
                'status' => ['required'],
            ]);

            $data = [
                'date' => $request->input('date'),
                'id_subdevice' => $request->input('id_subdevice'),
                'duration' => $request->input('duration'),
                'status' => $request->input('status'),
            ];

            Controlling::create($data);

            return redirect()->back()->with('message', 'Berhasil menambahkan pengendalian.');
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
        return view('controlling.show')->with([
            'subdevice' => $subdevice
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
                'duration' => ['required'],
                'status' => ['required'],
            ]);

            $controlling = Controlling::findOrFail($id);

            $data = [
                'date' => $request->input('date'),
                'id_subdevice' => $request->input('id_subdevice'),
                'duration' => $request->input('duration'),
                'status' => $request->input('status'),
            ];

            $controlling->update($data);

            return redirect()->back()->with('message', 'Berhasil mengubah data pengendalian.');
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
        $controlling = Controlling::findOrFail($id);
        $controlling->delete();
        return response()->json([
            'message' => 'Berhasil menghapus data pengendalian.'
        ]);
    }
}
