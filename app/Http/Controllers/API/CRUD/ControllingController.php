<?php

namespace App\Http\Controllers\API\CRUD;

use App\Http\Controllers\Controller;
use App\Models\Controlling;
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
        $results = Controlling::with(['devices','detailcontrolling'])->get();
        return response()->json([
            'data' => $results
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
            'date' => $request->input('date'),
            'duration' => $request->input('duration'),
            'status' => $request->input('status'),
            'id_sub_device' => $request->input('id_sub_device'),

        ];
        Controlling::create($data);
        return response()->json([
            'message' => 'Controlling berhasil ditambahkan.'
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
        $result = Controlling::where('id', $id)->with(['devices','detailcontrolling'])->first();
        return response()->json([
            'data' => $result
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
