<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{ route('home') }}" class="app-brand-link">
      <span class="app-brand-logo demo">
        <img src="{{ asset('assets/img/logo/logo.png') }}">
      </span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item mt-3{{ request()->is('home') ? ' active' : '' }}">
      <a href="{{ route('home') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bxs-home-circle"></i>
        <div>Dashboard</div>
      </a>
    </li>

    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Pages</span>
    </li>
    @role('superadmin|admin')
    <!-- Users -->
    <li class="menu-item{{ request()->is('user-login') || request()->is('user-login/*') || request()->is('mahasiswa-api') || request()->is('mahasiswa-api/*') ? ' active open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bxs-user"></i>
        <div>Users</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item{{ request()->is('user-login') || request()->is('user-login/*') ? ' active' : '' }}">
          <a href="{{ route('user-login.index') }}" class="menu-link">
            <div>Users Login</div>
          </a>
        </li>
        <li class="menu-item{{ request()->is('mahasiswa-api') || request()->is('mahasiswa-api/*') ? ' active' : '' }}">
          <a href="{{ route('mahasiswa-api.index') }}" class="menu-link">
            <div>Mahasiswa API</div>
          </a>
        </li>
      </ul>
    </li>
    @endrole

    @role('superadmin|admin|prodi|mahasiswa')
    <!-- Data -->
    <li class="menu-item{{ request()->is('data-dosen') || request()->is('data-dosen/*') || request()->is('data-mahasiswa') || request()->is('data-mahasiswa/*') || request()->is('data-proposal') || request()->is('data-proposal/*') || request()->is('data-seminar') || request()->is('data-seminar/*') || request()->is('data-pendadaran') || request()->is('data-pendadaran/*') || request()->is('data-diri') || request()->is('data-diri/*') || request()->is('proposal') || request()->is('proposal/*') || request()->is('seminar') || request()->is('seminar/*') || request()->is('pendadaran') || request()->is('pendadaran/*') ? ' active open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bxs-data"></i>
        <div>Data</div>
      </a>
      @role('superadmin|admin|prodi')
      <ul class="menu-sub">
        <li class="menu-item{{ request()->is('data-dosen') || request()->is('data-dosen/*') ? ' active' : '' }}">
          <a href="{{ route('data-dosen.index') }}" class="menu-link">
            <div>Dosen</div>
          </a>
        </li>
        <li class="menu-item{{ request()->is('data-mahasiswa') || request()->is('data-mahasiswa/*') ? ' active' : '' }}">
          <a href="{{ route('data-mahasiswa.index') }}" class="menu-link">
            <div>Mahasiswa</div>
          </a>
        </li>
        <li class="menu-item{{ request()->is('data-proposal') || request()->is('data-proposal/*') ? ' active' : '' }}">
          <a href="{{ route('data-proposal.index') }}" class="menu-link">
            <div>Proposal</div>
          </a>
        </li>
        <li class="menu-item{{ request()->is('data-seminar') || request()->is('data-seminar/*') ? ' active' : '' }}">
          <a href="{{ route('data-seminar.index') }}" class="menu-link">
            <div>Seminar Hasil</div>
          </a>
        </li>
        <li class="menu-item{{ request()->is('data-pendadaran') || request()->is('data-pendadaran/*') ? ' active' : '' }}">
          <a href="{{ route('data-pendadaran.index') }}" class="menu-link">
            <div>Pendadaran</div>
          </a>
        </li>
      </ul>
      @endrole
      @role('mahasiswa')
      <ul class="menu-sub">
        <li class="menu-item{{ request()->is('data-diri') || request()->is('data-diri/*') ? ' active' : '' }}">
          <a href="{{ route('data-diri.index') }}" class="menu-link">
            <div>Data Pribadi</div>
          </a>
        </li>
        <li class="menu-item{{ request()->is('proposal') || request()->is('proposal/*') ? ' active' : '' }}">
          <a href="{{ route('proposal.index') }}" class="menu-link">
            <div>Proposal</div>
          </a>
        </li>
        <li class="menu-item{{ request()->is('seminar') || request()->is('seminar/*') ? ' active' : '' }}">
          <a href="{{ route('seminar.index') }}" class="menu-link">
            <div>Seminar Hasil</div>
          </a>
        </li>
        <li class="menu-item{{ request()->is('pendadaran') || request()->is('pendadaran/*') ? ' active' : '' }}">
          <a href="{{ route('pendadaran.index') }}" class="menu-link">
            <div>Pendadaran</div>
          </a>
        </li>
      </ul>
      @endrole
    </li>
    @endrole

    @role('dosen')
    <!-- Bimbingan -->
    <li class="menu-item{{ request()->is('proposal-mahasiswa') || request()->is('proposal-mahasiswa/*') || request()->is('seminar-mahasiswa') || request()->is('seminar-mahasiswa/*') || request()->is('pendadaran-mahasiswa') || request()->is('pendadaran-mahasiswa/*') ? ' active open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bxs-user-check"></i>
        <div>Bimbingan</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item{{ request()->is('proposal-mahasiswa') || request()->is('proposal-mahasiswa/*') ? ' active' : '' }}">
          <a href="{{ route('proposal-mahasiswa.index') }}" class="menu-link">
            <div>Proposal</div>
          </a>
        </li>
        <li class="menu-item{{ request()->is('seminar-mahasiswa') || request()->is('seminar-mahasiswa/*') ? ' active' : '' }}">
          <a href="{{ route('seminar-mahasiswa.index') }}" class="menu-link">
            <div>Seminar Hasil</div>
          </a>
        </li>
        <li class="menu-item{{ request()->is('pendadaran-mahasiswa') || request()->is('pendadaran-mahasiswa/*') ? ' active' : '' }}">
          <a href="{{ route('pendadaran-mahasiswa.index') }}" class="menu-link">
            <div>Pendadaran</div>
          </a>
        </li>
      </ul>
    </li>
    @endrole

    <!-- Lulusan -->
    <li class="menu-item{{ request()->is('mahasiswa-lulusan') || request()->is('mahasiswa-lulusan/*') ? ' active open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bxs-user-detail"></i>
        <div>Lulusan</div>
      </a>
      <ul class="menu-sub">
        @role('superadmin|admin|prodi')
        <li class="menu-item{{ request()->is('mahasiswa-lulusan') || request()->is('mahasiswa-lulusan/*') ? ' active' : '' }}">
          <a href="{{ route('mahasiswa-lulusan.index') }}" class="menu-link">
            <div>Mahasiswa</div>
          </a>
        </li>
        @endrole
        <li class="menu-item">
          <a href="{{ route('skripsi.index') }}" class="menu-link">
            <div>Skripsi</div>
          </a>
        </li>
      </ul>
    </li>
    <li class="menu-item mt-5">
      <a href="{{ route('logout') }}" class="menu-link fw-semibold text-white bg-danger">
        <i class="menu-icon tf-icons bx bx-log-out"></i>
        <span class="small">Keluar</span>
      </a>
    </li>
  </ul>
</aside>
