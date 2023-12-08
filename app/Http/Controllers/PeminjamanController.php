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
        $data = peminjaman::all();
        foreach ($data as $key => $value) {
            # code...
            $dataMobil = mobil::where('id', $value->mobil_id )->first();
            // return $dataMobil;

            
            return view('sewa_mobil.pengembalian')
            ->with('data', $data)
            ->with('dataMobil', $dataMobil);
        }
        
    }


    public function insert(Request $request)
    {   //ubah tanggal inputan hari ke angka
        $dateAwal = new DateTime($request->tgl_awal_sewa);
        $dateAkhir = new DateTime($request->tgl_akhir_sewa);

        //ambil format tanggal saja
        $dayAwal = $dateAwal->format('d');
        $dayAkhir = $dateAkhir->format('d');

        //perhitungan lama pinjam
        $lamaSewaMobil = $dayAkhir - $dayAwal;
        $totalPrice = $lamaSewaMobil * $request->sewa_perhari;

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
            'lama_sewa'=> $lamaSewaMobil,
            'total' =>$totalPrice
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

        $updateketersediaan = [
            'status' => 0
        ];
        
        $data = peminjaman::all();
        
        foreach ($data as $key => $value) {
            
            $dataMobil = mobil::where('id', $value->mobil_id )->update($updateketersediaan);
            
        }

        peminjaman::where('id', $id)->delete();
        
        $request->session()->flash('success', 'Berhasil mengembalikan mobil');

        return redirect ('/dashboard');
    }

    
    

}
