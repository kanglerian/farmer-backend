<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total_administrator = User::where('level','1')->count();
        $total_petugas = User::where('level','0')->count();
        return view('users.index')->with([
            'total_administrator' => $total_administrator,
            'total_petugas' => $total_petugas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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
                'name' => ['required','string'],
                'email' => ['required','email'],
                'level' => ['required'],
                'password' => ['required', 'confirmed'],
            ]);

            $data = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'level' => $request->input('level'),
                'password' => Hash::make($request->input('password')),
            ];

            User::create($data);

            return redirect()->back()->with('message', 'Berhasil menambahkan data pengguna.');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit')->with([
            'user' => $user
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
                'name' => ['required','string'],
                'email' => ['required','email'],
                'level' => ['required'],
            ]);

            $data = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'level' => $request->input('level'),
            ];

            $user = User::findOrFail($id);
            $user->update($data);

            return redirect()->back()->with('message', 'Berhasil mengubah data pengguna.');
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
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json([
                'message' => 'Berhasil menghapus akun'
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
