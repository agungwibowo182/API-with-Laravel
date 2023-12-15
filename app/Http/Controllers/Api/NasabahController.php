<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNasabahRequest;
use App\Http\Resources\NasabahResource;
use App\Models\Nasabah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NasabahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nasabah = Nasabah::all();
        return new NasabahResource(true, 'Data Nasabah !', $nasabah);
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kartu' => 'required',
            'nomor_kartu' => 'required',
            'cabang' => 'required',
            'saldo' => 'required',
            'nomor_rekening' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        }else{
            $nasabah = Nasabah::create([
            'name' => $request->name,
            'email' => $request->email,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kartu' => $request->jenis_kartu,
            'nomor_kartu' => $request->nomor_kartu,
            'cabang' => $request->cabang,
            'saldo' => $request->saldo,
            'nomor_rekening' => $request->nomor_rekening,
            ]);

            return new NasabahResource(true, 'Data Berhasil tersimpan !', $nasabah);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $nasabah = Nasabah::find($id);

        if($nasabah) {
            return new NasabahResource(true, 'Data Ditemukan !', $nasabah);
        } else {
            return response()->json([
                'message' => 'Data not found !'
            ], 422);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kartu' => 'required',
            'nomor_kartu' => 'required',
            'cabang' => 'required',
            'saldo' => 'required',
            'nomor_rekening' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        }else{
            $nasabah = Nasabah::find($id);

            if($nasabah){
               $nasabah->name = $request->name;
               $nasabah->email = $request->email;
               $nasabah->tanggal_lahir = $request->tanggal_lahir;
               $nasabah->jenis_kartu = $request->jenis_kartu;
               $nasabah->nomor_kartu = $request->nomor_kartu;
               $nasabah->cabang = $request->cabang;
               $nasabah->saldo = $request->saldo;
               $nasabah->nomor_rekening = $request->nomor_rekening;
               $nasabah-> save();

               return new NasabahResource(true, 'Data Berhasil di-Update !', $nasabah);
            }else{
                return response()->json([
                    'message' => 'Data not Found !'
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $nasabah = Nasabah::find($id);

        if($nasabah){
           $nasabah->delete();

           return new NasabahResource(true, 'Data Berhasil di-Hapus !', '');
        }else{
            return response()->json([
                'message' => 'Data not Found !'
            ]);
        }
    }
}
