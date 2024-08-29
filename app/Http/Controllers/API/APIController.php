<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kelas;
use Illuminate\Support\Facades\Hash;

class APIController extends Controller
{
    public function login(Request $request) {
        $request->validate([
            'userID' => 'required|string',
            'pwd' => 'required|string'
        ]);

        $user = User::where('userID', $request->userID)->first();

        if ($user && Hash::check($request->pwd, $user->pwd)) {
            return response()->json([
                'userToken' => $user->userToken,
                'userName' => $user->userName,
                'userPhoto' => $user->userPhoto,
                'userRights' => json_decode($user->userRights)
            ], 200);
        }else {
            return response()->json([
                'message' => 'Login Gagal'
            ], 401);
        }
    }

    public function teachingclass(Request $request) {
        $user = $request->attributes->get('user');
        $kelas = Kelas::where('userID', $user->userID)->first();

        if($request->class == 'list') {
            return response()->json([
                'class' => json_decode($kelas->kelas)
            ], 200);
        }else {
            return response()->json([
                'message' => 'Gagal Mengambil Data'
            ], 401);
        }
    }
}
