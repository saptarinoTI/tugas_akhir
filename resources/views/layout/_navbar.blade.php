<header class="navbar navbar-expand-md navbar-dark navbar-overlap d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="{{ route('home') }}">
                <img src="{{ asset('img/logo/logo-light.png') }}" width="100" height="30" alt="Tabler"
                    class="navbar-brand-image">
            </a>
        </h1>
        <div class="navbar-nav flex-row order-md-last">
            <div class="ms-2 nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                    aria-label="Open user menu">
                    <div class="d-none d-sm-inline-block ps-2">
                        <div class="fw-bold small">{{ ucwords(auth()->user()->name) }} </div>
                        <div class="mt-1 medium text-muted">
                            {{ ucwords(
                                Str::substr(
                                    auth()->user()->getRoleNames(),
                                    2,
                                    -2,
                                ),
                            ) }}
                        </div>
                    </div>
                    <div class="d-inline-block d-sm-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <circle cx="12" cy="12" r="9"></circle>
                            <circle cx="12" cy="10" r="3"></circle>
                            <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"></path>
                        </svg>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="{{ route('password-change.get') }}" class="dropdown-item small fw-semibold">Change
                        Password</a>
                    <div class="dropdown-divider"></div>
                    <div class="dropdown-item p-0 m-0">
                        <form action="{{ route('logout') }}" method="post" class="p-0 m-0">
                            @csrf
                            <button type="submit" class="btn btn-logout border-0 px-5 py-1">
                                <span class="text-danger fw-bold bg-transparent small">Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-layout-2"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <rect x="4" y="4" width="6" height="5" rx="2"></rect>
                                    <rect x="4" y="13" width="6" height="7" rx="2"></rect>
                                    <rect x="14" y="4" width="6" height="7" rx="2"></rect>
                                    <rect x="14" y="15" width="6" height="5" rx="2"></rect>
                                </svg>
                            </span>
                            <span class="nav-link-title fw-semibold">
                                Dashboard
                            </span>
                        </a>
                    </li>
                    @role('superadmin|admin')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                                data-bs-auto-close="outside" role="button" aria-expanded="false">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/package -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                    </svg>
                                </span>
                                <span class="nav-link-title fw-semibold">
                                    Users
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropdown-menu-columns">
                                    <div class="dropdown-menu-column">
                                        <a class="dropdown-item" href="{{ route('user-login.index') }}">
                                            User Login
                                        </a>
                                        @role('superadmin')
                                            <a class="dropdown-item" href="{{ route('mahasiswa-api.index') }}">
                                                Mahasiswa API
                                            </a>
                                        @endrole
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endrole
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-database"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <ellipse cx="12" cy="6" rx="8" ry="3"></ellipse>
                                    <path d="M4 6v6a8 3 0 0 0 16 0v-6"></path>
                                    <path d="M4 12v6a8 3 0 0 0 16 0v-6"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title fw-semibold">
                                Data
                            </span>
                        </a>
                        @role('superadmin|admin|prodi')
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('data-dosen.index') }}">
                                    Data Dosen
                                </a>
                                <a class="dropdown-item" href="{{ route('data-mahasiswa.index') }}">
                                    Data Mahasiswa
                                </a>
                                <a class="dropdown-item" href="{{ route('data-proposal.index') }}">
                                    Proposal TA
                                </a>
                                <a class="dropdown-item" href="{{ route('data-seminar-hasil.index') }}">
                                    Seminar Hasil
                                </a>
                                <a class="dropdown-item" href="{{ route('data-pendadaran.index') }}">
                                    Pendadaran
                                </a>
                            </div>
                        @endrole

                        @role('dosen')
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('mahasiswa-bimbingan.index') }}">
                                    Mhs. Bimbingan
                                </a>
                                {{-- <a class="dropdown-item" href="{{ route('proposal-mahasiswa.index') }}">
                                    Proposal TA
                                </a> --}}
                            </div>
                        @endrole

                        @role('mahasiswa')
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('mahasiswa.index') }}">
                                    Data Mahasiswa
                                </a>
                                <a class="dropdown-item" href="{{ route('proposal.index') }}">
                                    Proposal TA
                                </a>
                                <a class="dropdown-item" href="{{ route('seminar-hasil.index') }}">
                                    Seminar Hasil
                                </a>
                                <a class="dropdown-item" href="{{ route('pendadaran.index') }}">
                                    Pendadaran
                                </a>
                            </div>
                        @endrole
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('mahasiswa-lulus.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <!-- Download SVG icon from http://tabler-icons.io/i/file-text -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                    </path>
                                </svg>
                            </span>
                            <span class="nav-link-title fw-semibold">
                                Status Mhs
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('skripsi.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <!-- Download SVG icon from http://tabler-icons.io/i/file-text -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-book"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0"></path>
                                    <path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0"></path>
                                    <line x1="3" y1="6" x2="3" y2="19"></line>
                                    <line x1="12" y1="6" x2="12" y2="19"></line>
                                    <line x1="21" y1="6" x2="21" y2="19"></line>
                                </svg>
                            </span>
                            <span class="nav-link-title fw-semibold">
                                Jdl. Skripsi
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
