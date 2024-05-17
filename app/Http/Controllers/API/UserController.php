<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function get()
    {
        $userQuery = User::query();
        $users = $userQuery->get();
        return response()->json([
            'users' => $users
        ]);
    }
}
