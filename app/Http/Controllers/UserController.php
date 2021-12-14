<?php

namespace App\Http\Controllers;

use App\Models\User;
// use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request){
        $this->validate($request, [
            'nim' => 'required|unique:users',
            'nama' => 'required',
            'email' => 'required|unique:users|email',
            'no_telepon' => 'required',
            'password' => 'required|min:6'
        ]);
        $nim = $request->input('nim');
        $nama = $request->input('nama');
        $email = $request->input('email');
        $no_telepon = $request->input('no_telepon');
        $password = Hash::make($request->input('password'));

        $user = User::create([
            'nim' => $nim,
            'nama' => $nama,
            'email' => $email,
            'no_telepon' => $no_telepon,
            'password' => $password
            
        ]);

        return response()->json(['message' => 'Pendaftaran pengguna berhasil dilaksanakan',
        'data' => $user]);
        // return response()->json(['data' => $user]);

    }
}
