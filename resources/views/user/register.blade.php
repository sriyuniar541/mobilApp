@extends('index') @section('title', 'Register') @section('content')
<div class="mt-5 shadow-lg mb-5 bg-body-tertiary rounded p-5">
    <form action="{{ url('users/register') }}" method="POST">
        @csrf
        <h2 class="text-secondary text-center pb-5">Register</h2>

        @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $item)
            <div class="alert alert-danger" role="alert">
                {{ $item }}
            </div>
            @endforeach
        </ul>
        @endif

        <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input
                    type="email"
                    class="form-control"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                />
            </div>
        </div>

        <div class="mb-3 row">
            <label for="password" class="col-sm-2 col-form-label"
                >Password</label
            >
            <div class="col-sm-10">
                <input
                    type="password"
                    class="form-control"
                    name="password"
                    id="password"
                />
            </div>
        </div>

        <div class="mb-3 row">
            <label for="fullname" class="col-sm-2 col-form-label"
                >Fullname</label
            >
            <div class="col-sm-10">
                <input
                    type="text"
                    class="form-control"
                    name="fullname"
                    id="fullname"
                    value="{{ old('fullname') }}"
                />
            </div>
        </div>

        <div class="mb-3 row">
            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
                <input
                    type="text"
                    class="form-control"
                    name="alamat"
                    id="alamat"
                    value="{{ old('alamat') }}"
                />
            </div>
        </div>

        <div class="mb-3 row">
            <label for="nomor_sim" class="col-sm-2 col-form-label"
                >Nomor SIM</label
            >
            <div class="col-sm-10">
                <input
                    type="number"
                    class="form-control"
                    name="nomor_sim"
                    id="nomor_sim"
                    value="{{ old('nomor_sim') }}"
                />
            </div>
        </div>

        <div class="mb-3 row">
            <label for="nomor_hp" class="col-sm-2 col-form-label"
                >Nomor HP</label
            >
            <div class="col-sm-10">
                <input
                    type="number"
                    class="form-control"
                    name="nomor_hp"
                    id="nomor_hp"
                    value="{{ old('nomor_hp') }}"
                />
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <button class="btn btn-outline-primary">Register</button> 
            <p>Sudah punya akun ?<a href="/login">Login</a></p>
         </div>
    </form>
</div>
@endsection
