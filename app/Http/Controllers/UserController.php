<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
// use Laravel\Lumen\Routing\Controller as BaseController;

use App\Models\Travel;
use App\Models\User;
// use Auth;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
        public function show()
    {
        // $credentials = $request->only(['username', 'password']);
        // $token = auth()->guard('api')->attempt($credentials);
        // $user_id = auth()->user()->nim; 
        // $user_id = Auth::user()->id();
            // $user_id = Auth::user()->id;

        // var_dump ($user_id);
        $user_id = auth('api')->user()->nim;

        // $user_id = auth()->guard('api')->user()->nim;  
        // $user_id = auth()->guard('api')
        $post = DB::select("SELECT * from users where nim=?", [$user_id]);
        
        // $post = DB::select("SELECT travel.id as travel_id, * from travel 
        // join travel_agents on travel.id_travel_agent=travel_agents.id_travel_agent where travel.nim='$user_id'");

    // $post = Travel::where('nim','=',$nim)->get();

    if ($post) {
        return response()->json([
            'success'   => true,
            'message'   => 'Data My Setting!',
            'setting'      => $post
        ], 200);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Post Tidak Ditemukan!',
        ], 404);
    }
    }
}
