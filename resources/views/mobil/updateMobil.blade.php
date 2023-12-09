@extends('index') @section('title', 'Update Data Mobil') @section('content')
{{--
<form action="{{url('/'.$data->id.'/update')}}" method="POST">
    --}}
    <form
        action="{{url('/'.$data->id.'/update')}}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf @method('PUT')

        <h2>UPDATE MOBIL</h2>

        @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $item)
            <p>{{ $item }}</p>
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
                    value="{{$data->merek}}"
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
                    value="{{$data->model}}"
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
                    value="{{$data->nomor_plat}}"
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
                    value="{{$data->sewa_perhari}}"
                />
            </div>
        </div>
        <button class="btn btn-outline-primary">Update</button>
    </form>

    @endsection
</form>
