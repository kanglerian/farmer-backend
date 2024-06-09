<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function get_all()
    {
        $query = User::query();
        $results = $query->get();
        return response()->json([
            'data' => $results
        ]);
    }

    public function get_one($id)
    {
        $query = User::query();
        $query->where('id', $id);
        $result = $query->first();
        return response()->json([
            'data' => $result
        ]);
    }
}
