<?php

namespace App\Http\Controllers\User;

use Illuminate\Auth\MustVerifyEmail\sendEmailVerificationNotification;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
// use App\Mail\kirimEmail;
use App\Models\user;




class SessionController extends Controller
{
    public function index()
    {
       return view('user.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'email'     =>'required|email|unique:users,email',
            'password'  =>'required|min:8',
            'fullname'  =>'required',
            'alamat'    =>'required',
            'nomor_hp'  =>'required|max:16',
            'nomor_sim' =>'required|max:16'
            
        ], [
            'email.required'    => 'Email wajib diisi',
            'password.required' => ' Password wajib diisi',
            'email.unique'      => 'Email sudah terdaftar',
            'fullname.required' => ' Fullname wajib diisi',
            'alamat.required'   => ' Alamat wajib diisi',
            'nomor_sim.required'=> ' Wajib mempunyai dan memiliki SIM',
            'nomor_hp.required' => ' Nomor Hp wajib diisi',
            'password.min'      => ' Password minimal 8 karakter',
            'nomor_sim.max'     => ' Nomor sim Maksimal 16 Karakter',
            'nomor_hp.max'      => ' Nomor Hp Maksimal 16 Karakter',
            'nomor_hp.max'      => 'Nomor Hp Maksimal 16 Karakter'
        ]);

        $data = [
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'fullname'  => $request->fullname,
            'alamat'    => $request->alamat, 
            'nomor_hp'  =>$request->nomor_hp, 
            'nomor_sim' => $request->nomor_sim,
        ]; 

        $user = user::create($data);

        event(new Registered($user));

        Auth::login($user);

        // Mail::to('sriyuniar541@gmail.com')->send(new kirimEmail());
        
        $request->session()->flash('success', 'Register Berhasil, cek email anda dan silahkan verifikasi email..!');

        return redirect ('/login');

      
    }


    public function viewLogin()
    {
       return view('user.login');
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'     => 'required',
            'password'  => 'required'
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
