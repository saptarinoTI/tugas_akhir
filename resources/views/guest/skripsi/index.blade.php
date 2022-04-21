<!DOCTYPE html>

<html lang="en">
<head>
  @include('layouts._header')
</head>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar layout-without-menu">
    <div class="layout-container">
      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->

        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img src="{{ asset('assets/img/logo/logo.png') }}">
              </span>
            </a>
            <!-- /Logo -->

            <ul class="navbar-nav flex-row align-items-center ms-auto">
              @auth
              <!-- User -->
              <div class="nav-link">
                <span class="fw-semibold d-block">{!! ucwords(auth()->user()->name) !!}</span>
                <small class="text-muted"> {!! ucwords(Str::substr(auth()->user()->getRoleNames(), 2,
                  -2))!!}</small>
              </div>
              </li>
              <!--/ User -->
              @else
              <a href="{{ route('login') }}" class="btn btn-dark btn-sm">Login</a>
              @endauth
            </ul>
          </div>
        </nav>

        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row row-deck row-cards">
              <div class="col-12">
                <div class="card">
                  <div class="table-responsive text-muted">
                    <table id="skripsi" class="table card-table table-vcenter datatable" style="width: 100%;">
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
          <!-- / Content -->

          <!-- Footer -->
          <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl d-flex flex-wrap justify-content-end py-2 flex-md-row flex-column">
              <div class="mb-2 mb-md-0">
                <small>Manajemen Tugas Akhir <span class="fw-bolder">STITEK Bontang</span></small>
              </div>
            </div>
          </footer>
          <!-- / Footer -->

          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>
  </div>
  <!-- / Layout wrapper -->


  <!-- Core JS -->
  @include('layouts._script')
  <script>
    // Script of DataTables
    $(function() {
      var table = $('#skripsi').DataTable({
        processing: true
        , serverSide: true
        , responsive: true
        , pageLength: 50
        , lengthMenu: [
          [50, -1]
          , [50, "All"]
        ]
        , pagingType: "simple_numbers"
        , ajax: "{{ route('skripsi.getData') }}"
        , columns: [{
          data: 'nim'
          , name: 'nim'
        }, ]
      });
    });

  </script>
</body>
</html>
