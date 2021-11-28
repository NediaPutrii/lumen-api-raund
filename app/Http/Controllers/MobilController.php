<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

// use Laravel\Lumen\Routing\Controller as BaseController;

use App\Models\Mobil;


class MobilController extends Controller
{
    public function index()
    {
        $mobil = Mobil::all();

        return response()->json([
            'success' => true,
            'message' =>'List Semua Post',
            'data'    => $mobil
        ], 200);
    }
    
    public function show($id_travel_agent)
    {
    $get = Mobil::where('id_travel_agent',$id_travel_agent)->get();

    if ($get) {
        return response()->json([
            'success'   => true,
            'message'   => 'Detail Post!',
            'data'      => $get
        ], 200);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Post Tidak Ditemukan!',
        ], 404);
    }
    }

    // public function store(Request $request){
    //     $this->validate($request, [
    //         'nama_address' => 'required',
    //         'address' => 'required',
    //         'nim' => 'required'
            
        
    //     ]);
    //     $nama_address = $request->input('nama_address');
    //     $address = $request->input('address');
    //     $nim = $request->input('nim');
     
    //     $savedaddress = SavedAddress::create([
    //         'nama_address' => $nama_address,
    //         'address' => $address,
    //         'nim' => $nim
           
    
    //     ]);
    // }
}
