<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class DapoController extends Controller
{
    
    public function index()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer nNmfsD5yMKriNyR',
            ])->get("http://192.168.10.74:5774/WebService/getPesertaDidik", [
            'npsn' => '20209201'
            ]);

        $json = $response->json();

        // Ambil hanya bagian "rows" yang berisi array data siswa
        $data = $json['rows'];
        return view('dapo', compact('data'));
        // foreach($data as $d){
        //     echo $d['rombongan_belajar_id']." - ".$d['nama']."<br>";
        // }
        // dd($data);
    }

}
