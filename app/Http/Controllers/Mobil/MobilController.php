<?php

namespace App\Http\Controllers\Mobil;
use App\Models\mobil;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class MobilController extends Controller
{
    //view dashboar
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlah = 8;
        

        if(strlen($katakunci)) {
            $data = mobil::where('merek', 'like', "%$katakunci%")
            ->orwhere('model', 'like', "%$katakunci%")
            ->orwhere('merek', 'like', "%$katakunci%")
            ->orwhere('nomor_plat', 'like', "%$katakunci%")
            ->paginate($jumlah);
        } else {
            $data = mobil::orderBy('id', 'desc')->paginate($jumlah);
        }
        
        return view('mobil.dashboard')->with('data', $data);
      
    }


    //view add mobil
    public function AddMobil()
    {
        return view('mobil.AddMobil');
    }

    // function tambah mobil
    public function store(Request $request)
    {   
        $request->validate([
            'merek'=>'required',
            'model'=>'required',
            'nomor_plat'=>'required|unique:mobil,nomor_plat',
            'sewa_perhari'=>'required | numeric'
        ], [
            'merek.required' => 'Merek mobil wajib diisi',
            'model.required' => 'Model mobil wajib diisi',
            'nomor_plat.required' => 'Nomor plat wajib diisi',
            'nomor_plat.unique' => 'Nomor plat sudah pernah ditambahkan',
            'sewa_perhari.required' => 'Harga sewa perhari wajib diisi',
            'sewa_perhari.numeric' => 'Inputan dalam bentuk angka'
        ]);

        $data = [
            'merek'=>$request->merek,
            'model'=>$request->model,
            'nomor_plat'=>$request->nomor_plat,
            'sewa_perhari'=>$request->sewa_perhari
        ];

        mobil::create($data);
        
        $request->session()->flash('success', 'Berhasil menambah data');

        return redirect ('/dashboard');
    }

    //view page edit
    public function edit(string $id)
    {
        $data = mobil::where('id', $id )->first();
        return view('mobil.updateMobil')->with('data', $data);
    }
 

    // update data
    public function update(Request $request, string $id)
    {
        
        $request->validate([
            'merek'=>'required',
            'model'=>'required',
            'nomor_plat'=>'required',
            'sewa_perhari'=>'required | numeric'
        ], [
            'merek.required' => 'Merek mobil wajib diisi',
            'model.required' => 'Model mobil wajib diisi',
            'nomor_plat.required' => 'Nomor plat wajib diisi',
            'sewa_perhari.required' => 'Harga sewa perhari wajib diisi',
            'sewa_perhari.numeric' => 'Inputan dalam bentuk angka'
        ]);

        $data = [
            'merek'=>$request->merek,
            'model'=>$request->model,
            'nomor_plat'=>$request->nomor_plat,
            'sewa_perhari'=>$request->sewa_perhari
        ];

        mobil::where('id', $id)->update($data);
        
        $request->session()->flash('success', 'Berhasil update data');

        return redirect ('/dashboard');

    }

    //delete data
    public function destroy(Request $request, string $id)
    {
        mobil::where('id', $id)->delete();

        $request->session()->flash('success', 'Berhasil delete data');

        return redirect ('/dashboard');
    }
}
