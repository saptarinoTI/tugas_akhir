<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta5
* @link https://tabler.io
* Copyright 2018-2022 The Tabler Authors
* Copyright 2018-2022 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">

<head>
    @include('layout._header')
</head>

<body>
    <div class="wrapper">
        <header class="navbar navbar-expand-md navbar-dark navbar-overlap d-print-none">
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 mx-auto pe-md-3">
                    <img src="{{ asset('img/logo/logo-light.png') }}" width="110" height="32" alt="Tabler"
                        class="navbar-brand-image">
                </h1>
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                        <ul class="navbar-nav ms-md-auto">
                            @auth
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('home') }}">
                                        <span class="nav-link-icon d-lg-inline-block">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-user-circle" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <circle cx="12" cy="12" r="9"></circle>
                                                <circle cx="12" cy="10" r="3"></circle>
                                                <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855">
                                                </path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title fw-bold">
                                            {{ ucwords(auth()->user()->name) }}
                                        </span>
                                    </a>
                                </li>
                            @endauth

                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <span class="nav-link-icon d-lg-inline-block">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-login" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path
                                                    d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2">
                                                </path>
                                                <path d="M20 12h-13l3 -3m0 6l-3 -3"></path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title fw-bold">
                                            Login
                                        </span>
                                    </a>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <div class="page-wrapper">
            <div class="container-xl">
                <!-- Page title -->
                <div class="page-header text-white d-print-none">
                    <div class="row align-items-center">
                        <div class="col">
                            <!-- Page pre-title -->
                            <div class="page-pretitle">
                                Pages
                            </div>
                            <h2 class="page-title">
                                Judul Skripsi Mahasiswa Teknik Informatika STITEK Bontang
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        <div class="col-12">
                            <div class="card">
                                <div class="table-responsive text-muted">
                                    <table id="table_skripsi" class="table card-table table-vcenter datatable"
                                        style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th class="text-muted">Skripsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <div class="row text-center align-items-center flex-row-reverse">
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    Manajemen Tugas Akhir <strong>STITEK Bontang</strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    @include('layout._footer')
    <script>
        // Script of DataTables
        // $(function() {
        //     var table = $('#table_skripsi').DataTable({
        //         processing: true,
        //         serverSide: true,
        //         responsive: true,
        //         pageLength: 10,
        //         lengthMenu: [
        //             [10, 25, 50, -1],
        //             [10, 25, 50, "All"]
        //         ],
        //         order: [
        //             [0, "asc"]
        //         ],
        //         ajax: "{{ route('skripsi.getData') }}",
        //         columns: [{
        //             data: 'daftar_ta',
        //             name: 'daftar_ta'
        //         }, ]
        //     });
        // });
        $(document).ready(function() {
            $('#table_skripsi').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('skripsi.getData') }}",
                "columns": [{
                    data: 'nim',
                    name: 'nim'
                }, ]
            });
        });
    </script>
</body>

</html>
