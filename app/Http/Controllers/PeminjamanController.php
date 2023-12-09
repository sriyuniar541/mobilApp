<?php

namespace App\Http\Controllers;
use App\Models\peminjaman;
use App\Models\mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;




class PeminjamanController extends Controller
{
    public function index (string $id)
    {
        
        $data = mobil::where('id', $id )->first();

        return view('sewa_mobil.peminjaman')->with('data', $data);
        
    }

    public function getPeminjaman (Request $request)
    {        
        $data = peminjaman::with('mobil','users')->get();
        
        return view('sewa_mobil.pengembalian')->with('data', $data);
        
    }


    public function insert(Request $request)
    {   
        // mengambil data user login
        $user = Auth::user();
        $user_id = $user->id;


        $request->validate([
            'tgl_awal_sewa'=>'required',
            'tgl_akhir_sewa'=>'required'
        ], [
            'tgl_awal_sewa.required' => 'Tgl Peminjaman mobil wajib diisi',
            'tgl_akhir_sewa.required' => ' Tgl pengembalian Mobil mobil wajib diisi'
        ]);


        $data = [
            'users_id'=> $user_id,
            'mobil_id'=> $request->id,
            'tgl_awal_sewa'=>$request->tgl_awal_sewa,
            'tgl_akhir_sewa'=>$request->tgl_akhir_sewa,
        ];

        $updateketersediaan = [
            'status' => 1
        ];

        peminjaman::create($data);

        mobil::where('id', $request->id)->update($updateketersediaan);
        
        $request->session()->flash('success', 'Berhasil meminjam mobil');

        return redirect ('/dashboard');
    }

    
    public function update(Request $request , string $id )
    {    
        $dataSewa = peminjaman::where('id', $id )->first();
        $dataMobil = mobil::where('id', $dataSewa->mobil_id )->first();
        $data = peminjaman::all();

        $dateAwal = new DateTime($dataSewa->tgl_awal_sewa);
        $dateAkhir = new DateTime( date('Y-m-d '));

        //ambil format tanggal saja
        $dayAwal = $dateAwal->format('d');
        $dayAkhir = $dateAkhir->format('d');

        //perhitungan lama pinjam
        $lamaSewaMobil = $dayAkhir -  $dayAwal ;
        $totalPrice = $lamaSewaMobil * $dataMobil->sewa_perhari;

        if($totalPrice == 0) {
            $totalPrice = $dataMobil->sewa_perhari;
        } else {
            $totalPrice = $lamaSewaMobil * $dataMobil->sewa_perhari;
        }

        //update total bayar dan hari
        $updatotalBayar = [
            'lama_sewa' => $lamaSewaMobil,
            'total' => $totalPrice,
            'pengembalian' => 1
        ];
       
        //update keterdiaan mobil
        $updateketersediaan = [
            'status' => 0
        ];
        
        mobil::where('id', $dataSewa->mobil_id )->update($updateketersediaan);        
 
        peminjaman::where('id', $id )->update($updatotalBayar);
        
        $request->session()->flash('success', 'Berhasil mengembalikan mobil');

        return redirect ('/dashboard');
    } 

    public function deletePeminjaman(Request $request, string $id)
    {
        peminjaman::where('id', $id)->delete();

        $request->session()->flash('success', 'Delete data Berhasil ');

        return redirect ('/getPeminjaman');
    }

    
    

}
