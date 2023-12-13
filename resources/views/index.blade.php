<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Mobil App - @yield('title')</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>
    <body>
        <div class="container">
            @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{Session::get('success')}}
              </div>
            @endif

            <!-- navbar -->
            <div class="row shadow-lg p-3 mb-2 bg-body-tertiary rounded d-flex">
                <ul class="nav">

                    <li class="nav-item">
                        <a
                            class="nav-link active fs-4 border rounded"
                            aria-current="page"
                            href="/dashboard"
                            >DSH</a
                        >
                    </li>
                    
                    @if (Auth::check())

                    <li class="nav-item">
                        <a
                            class="nav-link active"
                            aria-current="page"
                            href="/getPeminjaman"
                            >Peminjaman mobil</a
                        >
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('addMobil') }}"
                            >Tambah data</a
                        >
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('users/profile') }}"
                            >Profile</a
                        >
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/users/logout') }}"
                            >logout</a
                        >
                    </li>
                    
                    <li class="nav-item col-lg-6">
                        <form
                            class="d-flex "
                            role="search"
                            method="GET"
                            action="{{ url('dashboard') }}"
                        >
                            {{-- search --}}
                            <input
                                class="form-control me-2"
                                type="search"
                                placeholder="Search Merek"
                                aria-label="Search"
                                name="katakunci"
                                value="{{Request::get('katakunci')}}"
                            />

                            <input
                                class="form-control me-2"
                                type="search"
                                placeholder="Model"
                                aria-label="Search "
                                name="model"
                                value="{{Request::get('model')}}"
                            />

                            <input
                                class="form-control me-2"
                                type="search"
                                placeholder=" Plat nomor"
                                aria-label="Search "
                                name="nomor_plat"
                                value="{{Request::get('nomor_plat')}}"
                            /> 
                            <button
                                class="btn btn-outline-primary"
                                type="submit"
                            >
                                Search
                            </button>
                        </form>
                        
                        @endif

                    </li>
                </ul>
            </div>
            <!-- akhir navbar -->

            @yield('content')
        </div>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"
        ></script>
    </body>
</html>

