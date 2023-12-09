@extends('index')

@section('title', 'pengembalian')

@section('content')


<h5 class="text-secondary text-center mt-5">Daftar peminjaman mobil</h5>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $item)
          <div class="alert alert-danger" role="alert">
            {{ $item }}
          </div>
       @endforeach
    </ul>
@endif

<div class="row">
<div class="row justify-content-around ">
    @foreach ($data as $item)
      @if ($item->users_id  == auth()->user()->id)
        <div  class="bg-warning card p-2 my-5 shadow-lg p-3 mb-5 bg-body-tertiary rounded"
            style="width: 18rem">
            <img src='https://i.ytimg.com/vi/rf0awFXvanM/maxresdefault.jpg' class="card-img-top" alt="...">
            <div class="card-body">
            <u><h5> {{$item->mobil->merek}}</h5></u>  
            <p><span class="fw-bold">Model mobil  : </span><br/> {{ $item->mobil->model }}</p>
            <p><span class="fw-bold">Nomor plat  : </span><br/> {{ $item->mobil->nomor_plat }}</p>
            <p><span class="fw-bold">Mulai sewa  : </span><br/> {{ $item->tgl_awal_sewa }}</p>
            <p><span class="fw-bold">Rencana pengembalian  : </span><br/> {{ $item->tgl_akhir_sewa }}</p>

            {{-- format harga --}}
            @php
              $integerValue = $item->mobil->sewa_perhari; 
              $formatPerhari = number_format($integerValue, 0, ',', '.');
            @endphp 

            <p><span class="fw-bold">Harga/Hari  : </span><br/>Rp {{$formatPerhari}}</p>

            <!-- Modal -->
            @if ($item->pengembalian == 1) 
              <button type="button" class="btn btn-outline-success col-12">
                <a href="/dashboard" class="text-success ">Pinjam Lagi</a> 
              </button> 

              {{-- delete peminjaman --}}
              <form
                  onsubmit="return confirm('Apakah anda yakin akan menghapus data ini ?')"
                  action="{{url('/'.$item->id.'/deletePeminjaman')}}"
                  method="POST"
              >
                  @csrf @method('Delete')
                  <button class="submit btn btn-outline-danger mt-2 col-12">Delete</button>
              </form> 
            @else
                <button type="button" class="btn btn-outline-info col-12" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$item->id}}" >
                  Kembalikan
              </button> 
            @endif
          </div> 
        </div>
      @endif  
    @endforeach  

    @foreach ($data as $dataMobil)
      <form action="{{url('/'.$dataMobil->id.'/pengembalianMobil')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- Button trigger modal -->
        <div class="modal fade" id="exampleModal-{{$dataMobil->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Deskripsi peminjaman</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p><span class="fw-bold">Merek  : </span><br/> {{ $dataMobil->mobil->merek }}</p>
                <p><span class="fw-bold">Mulai sewa  : </span><br/> {{ $dataMobil->tgl_awal_sewa }}</p>
                <p class="fw-bold">Waktu Sekarang  : <span  id= 'real-time-clock'></span><br/></p>

                {{-- perhitungan total --}}
                @php

                    $dateAwal = new DateTime($dataMobil->tgl_awal_sewa);
                    $dateAkhir = new DateTime( date('Y-m-d '));

                    //ambil format tanggal saja
                    $dayAwal = $dateAwal->format('d');
                    $dayAkhir = $dateAkhir->format('d');

                    //perhitungan lama pinjam
                    $lamaSewaMobil = $dayAkhir -  $dayAwal ;
                    $totalPrice = $lamaSewaMobil * $dataMobil->mobil->sewa_perhari;

                    if($totalPrice == 0) {
                        $totalPrice = $dataMobil->mobil->sewa_perhari;
                    } else {
                        $totalPrice = $lamaSewaMobil * $dataMobil->mobil->sewa_perhari;
                    }

                    //format rupiah
                    $formatTotalPrice = number_format($totalPrice, 0, ',', '.');
                @endphp

                <p><span class="fw-bold">Lama Hari sewa  :  </span><br/>{{ $lamaSewaMobil }} Hari</p>
                <p><span class="fw-bold">Total bayar  :  </span><br/>Rp {{ $formatTotalPrice }}</p>

                {{-- memastikan data mobil sesuai dengan yg dipinjam --}}
                <p class="text-danger">* Silahkan input nomor plat mobil</p>
                <input class="form-control" type="text" name="input_platNomor" required>

              </div>     
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="submit">Bayar</button>
              </div>
            </div>
          </div>
        </div>
    </form>
  @endforeach
  {{-- akhir modal --}}
</div>
</div>
@endsection


<script>
  // mendapat jam realtime
  function updateRealTimeClock() {
      var now = new Date();
      var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit', timeZoneName: 'short' };
      var formattedDateTime = now.toLocaleDateString('id-ID', options);

      document.getElementById('real-time-clock').innerText = formattedDateTime;
  }

  // Perulangan untuk memanggil fungsi updateRealTimeClock setiap detik
  setInterval(updateRealTimeClock, 1000);

  // Panggil fungsi secara langsung untuk menampilkan waktu awal
  updateRealTimeClock();
  
</script>







