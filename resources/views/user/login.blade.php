@extends('index') @section('title', 'Login') @section('content')
<div class="mt-5 shadow-lg mb-5 bg-body-tertiary rounded p-5">
    <form action="{{ url('users/login') }}" method="POST">
        @csrf
        <h2 class="text-secondary text-center pb-5">Login</h2>

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
        <div class="d-flex justify-content-between">
           <button class="btn btn-outline-primary">Login</button> 
           <p>Belum punya akun ?<a href="/register">Register</a></p>
        </div>
    </form>
</div>
@endsection
