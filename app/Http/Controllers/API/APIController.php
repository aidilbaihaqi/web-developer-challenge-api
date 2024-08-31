<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kelas;
use App\Models\CPL;
use App\Models\CPMK;
use App\Models\Course;
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
        $hakAkses = collect(json_decode($user->userRights));
        $kelas = Kelas::where('userID', $user->userID)->first();

        if($hakAkses->contains('inputNilai')) {
            if($request->class == 'list') {
                return response()->json([
                    'class' => json_decode($kelas->kelas)
                ], 200);
            }else {
                return response()->json([
                    'message' => 'Gagal Mengambil Data'
                ], 401);
            }
        }else {
            return response()->json([
                'message' => 'Anda tidak memiliki hak akses untuk fitur ini!'
            ], 401);
        }
        
    }
    
    // CRUD CPL (clear)
    public function listCPL(Request $request) {
        $data = CPL::select('kodecpl', 'deskripsi')->get();
        $user = $request->attributes->get('user');
        $hakAkses = collect(json_decode($user->userRights));

        if($hakAkses->contains('buatCPL') or $hakAkses->contains('editCPL')) {
            if($request->cpl == 'list') {
                return response()->json([
                    'cpl' => $data
                ], 200);
            }else {
                return response()->json([
                    'message' => 'Gagal Mengambil Data'
                ], 401);
            }
        }elseif($hakAkses->contains('cetakLaporan')) {
            if($request->cpl == 'list') {
                return response()->json([
                    'cpl' => $data
                ], 200);
            }else {
                return response()->json([
                    'message' => 'Gagal Mengambil Data'
                ], 401);
            }
        }else {
            return response()->json([
                'message' => 'Anda tidak memiliki hak akses untuk fitur ini!'
            ], 401);
        }

        
    }
    public function addCPL(Request $request) {
        $user = $request->attributes->get('user');
        $hakAkses = collect(json_decode($user->userRights));

        if($hakAkses->contains('buatCPL') or $hakAkses->contains('editCPL')) {
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
    public function updateCPL(Request $request) {
        $user = $request->attributes->get('user');
        $hakAkses = collect(json_decode($user->userRights));

        if($hakAkses->contains('buatCPL') or $hakAkses->contains('editCPL')) {
            $request->validate([
                'kodecpl' => 'required|string',
                'deskripsi' => 'required'
            ]);

            $query = CPL::find($request->kodecpl);
            $query->update([
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
    public function removeCPL(Request $request) {
        $user = $request->attributes->get('user');
        $hakAkses = collect(json_decode($user->userRights));

        if($hakAkses->contains('buatCPL') or $hakAkses->contains('editCPL')) {

            $query = CPL::find($request->kodecpl);
            $query->delete();

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

    // CRUD CPMK (clear)
    public function listCPMK(Request $request) {
        $data = CPMK::select('kodecpl', 'kodecpmk', 'deskripsi')->get();
        $user = $request->attributes->get('user');
        $hakAkses = collect(json_decode($user->userRights));

        if($hakAkses->contains('buatCPL') or $hakAkses->contains('editCPL')) {
            if($request->cpmk == 'list') {
                return response()->json([
                    'cpmk' => $data
                ], 200);
            }else {
                return response()->json([
                    'message' => 'Gagal Mengambil Data'
                ], 401);
            }
        }elseif($hakAkses->contains('cetakLaporan')) {
            if($request->cpmk == 'list') {
                return response()->json([
                    'cpmk' => $data
                ], 200);
            }else {
                return response()->json([
                    'message' => 'Gagal Mengambil Data'
                ], 401);
            }
        } else {
            return response()->json([
                'message' => 'Anda tidak memiliki hak akses untuk fitur ini!'
            ], 401);
        }
    }
    public function addCPMK(Request $request) {
        $user = $request->attributes->get('user');
        $hakAkses = collect(json_decode($user->userRights));

        if($hakAkses->contains('buatCPL') or $hakAkses->contains('editCPL')) {
            $request->validate([
                'kodecpl' => 'required|string',
                'kodecpmk' => 'required|string',
                'deskripsi' => 'required'
            ]);

            $query = CPMK::create([
                'kodecpl' => $request->kodecpl,
                'kodecpmk' => $request->kodecpmk,
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
    public function updateCPMK(Request $request) {
        $user = $request->attributes->get('user');
        $hakAkses = collect(json_decode($user->userRights));

        if($hakAkses->contains('buatCPL') or $hakAkses->contains('editCPL')) {
            $request->validate([
                'kodecpl' => 'required|string',
                'kodecpmk' => 'required|string',
                'deskripsi' => 'required'
            ]);

            $query = CPMK::find($request->kodecpmk);
            $query->update([
                'kodecpl' => $request->kodecpl,
                'kodecpmk' => $request->kodecpmk,
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
    public function removeCPMK(Request $request) {
        $user = $request->attributes->get('user');
        $hakAkses = collect(json_decode($user->userRights));

        if($hakAkses->contains('buatCPL') or $hakAkses->contains('editCPL')) {

            $query = CPMK::find($request->kodecpmk);
            $query->delete();

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

    // CRUD Course note : tinggal kasih hak akses user disini
    public function listCourse(Request $request) {
        $data = Course::select('kodemk', 'namamk', 'sks')->get();
        $user = $request->attributes->get('user');
        $hakAkses = collect(json_decode($user->userRights));

        if($hakAkses->contains('rancangKurikulum') or $hakAkses->contains('editKurikulum')) {
            if($request->mk == 'list') {
                return response()->json([
                    'mk' => $data
                ], 200);
            }else {
                return response()->json([
                    'message' => 'Gagal Mengambil Data'
                ], 401);
            }
        }elseif($hakAkses->contains('cetakLaporan') or $hakAkses->contains('cetakRekap')) {
            if($request->mk == 'list') {
                return response()->json([
                    'mk' => $data
                ], 200);
            }else {
                return response()->json([
                    'message' => 'Gagal Mengambil Data'
                ], 401);
            }
        }else {
            return response()->json([
                'message' => 'Anda tidak memiliki hak akses untuk fitur ini!'
            ], 401);
        }

        
        
    }
    public function addCourse(Request $request) {
        $user = $request->attributes->get('user');
        $hakAkses = collect(json_decode($user->userRights));

        if($hakAkses->contains('rancangKurikulum') or $hakAkses->contains('editKurikulum')) {
            $request->validate([
                'kodemk' => 'required|string',
                'namamk' => 'required|string',
                'sks' => 'required|integer'
            ]);

            $query = Course::create([
                'kodemk' => $request->kodemk,
                'namamk' => $request->namamk,
                'sks' => $request->sks
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
    public function updateCourse(Request $request) {
        $user = $request->attributes->get('user');
        $hakAkses = collect(json_decode($user->userRights));

        if($hakAkses->contains('rancangKurikulum') or $hakAkses->contains('editKurikulum')) {
            $request->validate([
                'kodemk' => 'required|string',
                'namamk' => 'required|string',
                'sks' => 'required|integer'
            ]);

            $query = Course::find($request->kodemk);
            $query->update([
                'kodemk' => $request->kodemk,
                'namamk' => $request->namamk,
                'sks' => $request->sks
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
    public function removeCourse(Request $request) {
        $user = $request->attributes->get('user');
        $hakAkses = collect(json_decode($user->userRights));

        if($hakAkses->contains('rancangKurikulum') or $hakAkses->contains('editKurikulum')) {

            $query = Course::find($request->kodemk);
            $query->delete();

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
