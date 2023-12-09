<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Foundation\Auth\User as Authenticatable;


class SessionController extends Controller
{
    public function index()
    {
       return view('user.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8',
            'fullname'=>'required',
            'nomor_sim'=>'max:16',
            'nomor_hp'=>'max:16',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => ' Password wajib diisi',
            'password.min' => ' Password minimal 8 karakter',
            'fullname.required' => ' Fullname wajib diisi',
            'nomor_sim.required' => ' Wajib mempunyai dan memiliki SIM',
            'nomor_sim.max' => ' Nomor sim Maksimal 16 Karakter',
            'nomor_hp.max' => ' Nomor Hp Maksimal 16 Karakter',
            'nomor_hp.max' => 'Nomor Hp Maksimal 16 Karakter'
        ]);

        $data = [
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
            'fullname'=> $request->fullname,
            'alamat' => $request->alamat, 
            'nomor_hp'=>$request->nomor_hp, 
            'nomor_sim'=> $request->nomor_sim,
        ];

        user::create($data);
        
        $request->session()->flash('success', 'Register Berhasil');

        return redirect ('/login');

      
    }

    public function viewLogin()
    {
       return view('user.login');
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);


        if(Auth::attempt($credentials)) {

            $request->session()->regenerate();
            return redirect('/dashboard');
        }

        return back()->withErrors([' email' => 'Password atau email salah']);
    }

    public function logout()
    {
      Auth::logout();
      return redirect('/login')->with('success', 'Berhasil logout'); 
    }

    public function profile()
    {
        return view('user.profile');
    }


    
}
