@extends('index') @section('title', 'Peminjaman') @section('content')

@if ($errors->any())
<ul>
    @foreach ($errors->all() as $item)
        <div class="alert alert-danger" role="alert">
            {{ $item }}
        </div>
    @endforeach
</ul>
@endif

<div class="mt-5 shadow-lg mb-5 bg-body-tertiary rounded p-5">
    <h5 class="text-secondary text-center pb-5">Peminjaman</h5>
    <p><span class="fw-bold">Merek mobil  : </span> {{$data->merek}}_({{$data->id}})</p>
    <p><span class="fw-bold">Model mobil  : </span> {{$data->model}}</p>
    <p><span class="fw-bold">Nomor Plat   : </span> {{$data->nomor_plat}}</p>
    {{-- konfersi ke rupiah --}}
    @php
        $integerValue = $data->sewa_perhari; 
        $formattedValue = number_format($integerValue, 0, ',', '.');
    @endphp 
    <p><span class="fw-bold">Harga Sewa/hari  : </span>Rp {{$formattedValue}}</p>
<form
    action="{{ url('peminjaman') }}"
    method="POST"
    enctype="multipart/form-data"
>
    @csrf @method('POST')

    <input
        type="hidden"
        class="form-control"
        id="exampleFormControlInput1"
        value="{{$data->id}}"
        name="id"
    />
    <input
        type="hidden"
        class="form-control"
        id="exampleFormControlInput1"
        value="{{$data->sewa_perhari}}"
        name="sewa_perhari"
    />

    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label"
            >Tanggal Peminjaman</label
        >
        <input
            type="date"
            class="form-control"
            id="exampleFormControlInput1"
            name="tgl_awal_sewa"
        />
    </div>

    <div class="mb-3">
        <label for="exampleFormControlInput2" class="form-label"
            >Rencana Tanggal pengembalian</label
        >
        <input
            type="date"
            class="form-control"
            id="exampleFormControlInput2"
            name="tgl_akhir_sewa"
        />
    </div>

    <div class="d-flex justify-content-end">
        <button class="btn btn-outline-primary">Pinjam</button>
    </div>
</form>
</div>
@endsection
