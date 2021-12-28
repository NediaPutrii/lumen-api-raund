<?php

namespace App\Http\Controllers;

use App\Models\User;
// use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
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

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();
        if (!$user) {
            return response()->json(['message' => 'Login failed'], 401);
        }

        $isValidPassword = Hash::check($password, $user->password);
        if (!$isValidPassword) {
            return response()->json(['message' => 'Login failed'], 401);
        }

        $credentials = $request->only(['email', 'password']);

        if(!$token = Auth::attempt($credentials)){
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // $generateToken = bin2hex(random_bytes(40));
        $user->update([
            'token' => $token
        ]);
        // return response()->json($user);
        return response()->json([
            'data' => $user,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ],200);
        
    }

    public function logout(){
        $user = \Auth::user();
        $user->token = null;
        $user->save();

        return response()->json(['message' => 'Pengguna telah logout']);
    }
}
