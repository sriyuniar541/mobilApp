@extends('index') @section('title', 'Dashboard') @section('content')


<div class="row justify-content-around ">


    <!-- card -->
    @forelse ($data as $item)
    <div
        class=" card p-2 my-5 shadow-lg p-3 mb-5 bg-body-tertiary rounded"
        style="width: 18rem"
    >
        <img
            src="https://i.ytimg.com/vi/rf0awFXvanM/maxresdefault.jpg"
            class="card-img-top"
            alt="..."
        />
        <div class="card-body">
            @if ($item->status == 0)
            <p class="p-1 border text-info">Tersedia</p>
            @else
            <p class="p-1 border text-danger">Tidak tersedia</p>
            @endif
            <h5>{{$item->merek}}_({{$item->id}})</h5>
            <p><span class="fw-bold text-secondary">Model mobil  : </span><br/> {{ $item->model }}</p>
            <p><span class="fw-bold text-secondary">Nomor plat  : </span><br/> {{ $item->nomor_plat }}</p>
            {{-- format ke rupiah --}}
            @php
                $integerValue = $item->sewa_perhari; 
                $formattedValue = number_format($integerValue, 0, ',', '.');
            @endphp 
            <p><span class="fw-bold text-secondary">Harga Sewa/hari  : </span><br/>Rp {{ $formattedValue}}</p>
            <div class="row bg-white">
                    @if ($item->status == 0)
                    <a
                        class="btn border-info text-border"
                        href="{{url('/'.$item->id.'/sewaMobil')}}"
                        >Sewa</a
                    >
                    <a
                        class="btn border-info text-border my-2"
                        href="{{url('/'.$item->id.'/edit')}}"
                        >Update</a
                    >
                    <form class="btn border-info text-border p-1 y-1"
                        onsubmit="return confirm('Apakah anda yakin akan menghapus data ini ?')"
                        action="{{url('/'.$item->id.'/delete')}}"
                        method="POST"
                    >
                        @csrf @method('Delete')
                        <button class="submit btn btn-white p-1 y-1 text-danger">Delete</button>
                    @else
                    <a class="btn border-info text-border">Mobil sedang di pinjam</a>
                    @endif
                    </form>
            </div>
        </div>
    </div>
    @empty
    <p>data belum tersedia</p>
    @endforelse
    {{ $data->withQueryString()->links()}}
</div>
@endsection
