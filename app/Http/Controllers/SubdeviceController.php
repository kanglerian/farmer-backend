<?php

namespace App\Http\Controllers;

use App\Models\Controlling;
use App\Models\Subdevice;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubdeviceController extends Controller
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
                'name' => ['required', 'string'],
                'location' => ['required', 'string'],
                'id_device' => ['required'],
            ]);

            $uniqueID = uniqid('', true);
            $data = [
                'uuid' => explode('.', $uniqueID)[0],
                'name' => $request->input('name'),
                'location' => $request->input('location'),
                'id_device' => $request->input('id_device'),
                'condition' => $request->input('condition'),
            ];

            $subdevice = Subdevice::create($data);

            $data_controlling = [
                'date' => Carbon::now(),
                'id_subdevice' => $subdevice->id,
                'duration' => 0,
                'status' => 1
            ];

            Controlling::create($data_controlling);

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
        $subdevice = Subdevice::findOrFail($id);
        return view('subdevice.show')->with([
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
                'name' => ['required', 'string'],
                'location' => ['required', 'string'],
            ]);

            $data = [
                'name' => $request->input('name'),
                'location' => $request->input('location'),
                'condition' => $request->input('condition'),
            ];

            $subdevice = Subdevice::findOrFail($id);
            $subdevice->update($data);

            return redirect()->back()->with('message', 'Berhasil diubah data perangkat.');
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
            $subdevice = Subdevice::findOrFail($id);
            $subdevice->delete();
            return redirect()->back()->with('message', 'Berhasil menghapus data sub perangkat!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
