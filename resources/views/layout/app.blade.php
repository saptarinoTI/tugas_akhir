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
        <!-- Navbar -->
        @include('layout._navbar')
        <!-- End Navbar -->

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
                                @yield('main-title')
                            </h2>
                        </div>
                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            @yield('main-title2')
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-body">
                <div class="container-xl">
                    <!-- Main Page -->
                    @yield('main-page')
                    <!-- End Main Page -->
                </div>
            </div>

            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <div class="row text-center align-items-center flex-row-reverse">
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item text-muted">
                                    Manajemen Tugas Akhir <strong>STITEK Bontang</strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>


    @include('sweetalert::alert')
    @stack('before-script')
    @include('layout._footer')
    @stack('after-script')
</body>

</html>
