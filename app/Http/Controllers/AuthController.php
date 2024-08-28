<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request) {
        $validated = $request->validate([
            'userID' => 'required',
            'pwd' => 'required'
        ]);
        $user = User::where('userID', $validated['userID'])->first();

        if($user && Hash::check($validated['pwd'], $user->pwd)) {
            // Buat AUTH TOKEN user
            $userToken = Str::random(50);
            $user->userToken = $userToken;
            $user->save();

            return response()->json([
                'userToken' => $user->userToken,
                'userName' => $user->userName,
                'userPhoto' => $user->userPhoto,
                'userRights' => $user->userRights,
            ]);
        }else {
            return response()->json(['message' => 'Login Gagal']);
        }
    }
}
