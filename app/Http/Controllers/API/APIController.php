<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kelas;
use App\Models\CPL;
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

    public function listCPL(Request $request) {
        $data = CPL::select('kodecpl', 'deskripsi')->get();

        if($request->cpl == 'list') {
            return response()->json([
                'cpl' => $data
            ], 200);
        }else {
            return response()->json([
                'message' => 'Gagal Mengambil Data'
            ], 401);
        }
    }

    public function addCPL(Request $request) {
        $user = $request->attributes->get('user');
        $hakAkses = collect(json_decode($user->userRights));

        if($hakAkses->contains('buatCPL')) {
            $request->validate([
                'kodecpl' => 'required|string',
                'deskripsi' => 'required'
            ]);

            $query = CPL::create([
                'kodecpl' => $request->kodecpl,
                'deskripsi' => $request->deskripsi
            ]);

            if($query) {
                return response()->json([
                    'status' => 'OK'
                ], 200);
            }else {
                return response()->json([
                    'status' => 'Gagal'
                ], 401);
            }

            
        }else {
            return response()->json([
                'message' => 'Anda tidak memiliki hak akses untuk fitur ini!'
            ], 401);
        }

        
        
    }
}
