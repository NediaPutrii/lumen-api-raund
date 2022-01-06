<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
// use Laravel\Lumen\Routing\Controller as BaseController;

use App\Models\Travel;
use App\Models\User;
// use Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TravelController extends Controller
{
    public function tambahtravel(Request $request){

        function generateRandomString($length = 5)
        {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
        }

        $user_id = auth('api')->user()->nim;

        $user = User::where('nim',[$user_id])->first();


        $travel = new Travel;

        $travel->id = generateRandomString();
        $travel->current_loc = $request->current_loc;
        $travel->destination = $request->destination;
        $travel->jumlah_passanger = $request->jumlah_passanger;
        $travel->total = $request->total;
        $travel->nim = $user_id;
        $travel->id_mobil = $request->id_mobil;
        // $travel->id_travel = $request->id_travel;
        $travel->id_travel_agent = $request->id_travel_agent;
        $travel->status = 1;
        $travel->departure = $request->departure;
        $travel->arrive = $request->arrive;
        $travel->jam_departure = $request->jam_departure;
        $travel->jam_arrive = $request->jam_arrive;
        $travel->jenis = 1;
        $travel->current_lat = $request->current_lat;
        $travel->current_long = $request->current_long;
        $travel->destination_lat = $request->destination_lat;
        $travel->destination_long = $request->destination_long;
        
        $travel->save();

        if ($travel) {
            return response()->json($travel);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal Menambahkan Transaksi Travel!',
            ], 404);
        }
    }
}

?>