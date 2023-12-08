@extends('index') @section('title', 'Add Mobil') @section('content')

<div class="mt-5 shadow-lg mb-5 bg-body-tertiary rounded">
    <form action="{{ url('insert') }}" method="POST" class="p-5">
        @csrf
        <h5 class="text-secondary text-center pb-5">INSERT MOBIL</h5>

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
            <label for="merek" class="col-sm-2 col-form-label">Merek</label>
            <div class="col-sm-10">
                <input
                    type="text"
                    class="form-control"
                    name="merek"
                    id="merek"
                    value="{{Session::get('merek')}}"
                />
            </div>
        </div>

        <div class="mb-3 row">
            <label for="model" class="col-sm-2 col-form-label">Model</label>
            <div class="col-sm-10">
                <input
                    type="text"
                    class="form-control"
                    name="model"
                    id="model"
                    value="{{Session::get('model')}}"
                />
            </div>
        </div>

        <div class="mb-3 row">
            <label for="nomor_plat" class="col-sm-2 col-form-label"
                >Nomor Plat</label
            >
            <div class="col-sm-10">
                <input
                    type="text"
                    class="form-control"
                    name="nomor_plat"
                    id="nomor_plat"
                    value="{{Session::get('nomor_plat')}}"
                />
            </div>
        </div>

        <div class="mb-3 row">
            <label for="harga" class="col-sm-2 col-form-label"
                >Harga Sewa</label
            >
            <div class="col-sm-10">
                <input
                    type="number"
                    placeholder="Rp........"
                    class="form-control"
                    name="sewa_perhari"
                    id="harga"
                    value="{{Session::get('sewa_perhari')}}"
                />
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button class="btn btn-outline-primary">Simpan</button>
        </div>
    </form>
</div>

@endsection
