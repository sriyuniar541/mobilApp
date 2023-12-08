@extends('index') @section('title', 'Register') @section('content') 

<div class="row shadow-lg p-3 mb-2 bg-body-tertiary rounded d-flex mt-5">
    <div class="border rounded p-2">
        <h2 class="text-secondary text-center pb-5"><u>Data Diri</u> </h2>
        <p><span class="fw-bold">Nama Lengkap   : </span> {{auth()->user()->fullname}}</p>
        <p><span class="fw-bold">Alamat Email  : </span> {{auth()->user()->email}}</p>
        <p><span class="fw-bold">Nomor HP  : </span> {{auth()->user()->nomor_hp}}</p>
        <p><span class="fw-bold">Nomor SIM  : </span> {{auth()->user()->nomor_sim}}</p>
        <p><span class="fw-bold">Tanggal Bergabung  : </span> {{auth()->user()->created_at}}</p>
    </div>
</div>

@endsection