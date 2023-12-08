@extends('index')

@section('title', 'pengembalian')

@section('content')


    <h5 class="text-secondary text-center mt-5">Daftar peminjaman mobil</h5>

    @foreach ($data as $item)
    @if ($item->users_id == auth()->user()->id)
      <div class="d-flex justify-content-around">
        <div class="card p-2 my-5 shadow-lg p-3 mb-5 bg-body-tertiary rounded"
        style="width: 18rem">
      <img src='https://i.ytimg.com/vi/rf0awFXvanM/maxresdefault.jpg' class="card-img-top" alt="...">
      <div class="card-body">
    
        {{-- mendapat Id untuk get data --}}
        <input name="mobil_id" value={{$item->mobil_id}} type="hidden">
        <input name="users_id" value={{$item->users_id}} type="hidden">

        <u><h5> {{$dataMobil->merek}}</h5></u>  
        <p><span class="fw-bold">Model mobil  : </span><br/> {{ $dataMobil->model }}</p>
        <p><span class="fw-bold">Nomor plat  : </span><br/> {{ $dataMobil->nomor_plat }}</p>
        <p><span class="fw-bold">Mulai sewa  : </span><br/> {{ $item->tgl_awal_sewa }}</p>
        <p><span class="fw-bold">Rencana pengembalian  : </span><br/> {{ $item->tgl_akhir_sewa }}</p>

        {{-- format harga --}}
        @php
          $integerValue = $dataMobil->sewa_perhari; 
          $formattedValue = number_format($integerValue, 0, ',', '.');

          $total = $item->total ;
          $formatTotal = number_format($total, 0, ',', '.');
        @endphp 

        <p><span class="fw-bold">Harga/Hari  : </span><br/>Rp {{$formattedValue}}</p>
        <p><span class="fw-bold">Rencana Total/hari sewa : </span><br/>Rp {{ $formatTotal}} / {{$item->lama_sewa}} Hari</p>
        <form onsubmit="return confirm('Apakah anda yakin ?')" action="{{url('/'.$item->id.'/pengembalianMobil')}}" method="POST">
          @csrf
          @method('PUT')
          <button class="btn btn-outline-info col-12">Kembalikan mobil</button>
        </form>
      </div> 
    </div>
    @endif    
    @endforeach
    </div>
@endsection


<script>
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







