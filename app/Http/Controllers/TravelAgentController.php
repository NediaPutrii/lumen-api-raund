<?php

namespace App\Http\Controllers;

use App\Models\TravelAgent;
// use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use DB;
use Carbon\Carbon;

class TravelAgentController extends Controller
{

    public function index()
    {
        $travellist = DB::select("SELECT mobils.id as id_mobil , * from mobils join travel_agents on mobils.id_travel_agent=travel_agents.id_travel_agent");
        $response = new \stdClass();
        $response->tanggal = Carbon::now()->toDateString();
        $response->jumlah_data = 0;
        $response->travellist = $travellist;
        return response()->json($response);
    }

    public function store(Request $request){
        $this->validate($request, [
            'id_travel_agent' => 'required|unique:travel_agents',
            'nama_travel' => 'required',
            'gambar' => 'required'
        ]);
        $id_travel_agent = $request->input('id_travel_agent');
        $nama_travel = $request->input('nama_travel');
        $gambar = $request->input('gambar'); 

        $travel_agent = TravelAgent::create([
            '$id_travel_agent' => $id_travel_agent,
            'nama_travel' => $nama_travel,
            'gambar' => $gambar

        ]);

        return response()->json(['message' => 'Pendaftaran pengguna berhasil dilaksanakan']);
    }
}
