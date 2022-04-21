@extends('layouts.apps')
@section('main-content')
<div class="row">
  <div class="col-12">
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <div class="d-flex justify-content-between">
        <h5 class="card-header">Data Diri Mahasiswa</h5>
        @if (!$mahasiswa)
        <h5 class="card-header">
          <a href="{{ route('data-diri.create') }}" class="btn btn-sm btn-primary">Lengkapi Data Diri</a>
        </h5>
        @endif
      </div>
      <div class="table-responsive text-nowrap">
        <table class="table card-table table-center datatable nowrap" id="data-diri-mahasiswa" style="width: 100%">
          <thead>
            @if ($mahasiswa)
            <tr>
              <th>NIM Mhs</th>
              <th>Name Mhs</th>
              <th>Telp.</th>
              <th>Birth</th>
              <th>Address</th>
              <th>Action</th>
            </tr>
            @else
            <tr>
              <th colspan="6" class="text-dark fw-semibold text-center">Mahasiswa belum mendaftarkan data diri.</th>
            </tr>
            @endif
          </thead>
          <tbody class="table-border-bottom-0">
            @if ($mahasiswa)
            <tr>
              <td class="fw-semibold text-dark">{{ $mahasiswa->nim }}</td>
              <td class="fw-semibold text-dark">{{ ucwords($mahasiswa->nama) }}</td>
              @if ($mahasiswa->no_hp != null)
              <td class="fw-semibold text-dark">
                {{ $mahasiswa->no_hp }}
              </td>
              @endif
              <td class="fw-semibold text-dark">
                {{ ucwords($mahasiswa->tpt_lahir) . ', ' . date('d F Y', strtotime($mahasiswa->tgl_lahir)) }}
              </td>
              @if ($mahasiswa->alamat != null)
              <td class="fw-semibold text-dark">
                {{ ucwords($mahasiswa->alamat) }}
              </td>
              @endif
              <td class="fw-semibold text-dark">
                <a href="{{ route('data-diri.edit', $mahasiswa->nim) }}" class="btn btn-dark px-2 py-1 border-0">
                  <span class="small"><i class="bx bx-pencil"></i></span>
                </a>
              </td>
            </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
    <!--/ Basic Bootstrap Table -->
  </div>
</div>

@push('after-script')
<script>
  $(function() {
    var table = $('#data-diri-mahasiswa').DataTable({
      processing: true
      , responsive: true
      , lengthChange: false
      , searching: false
      , "paging": false
      , "info": false
    });
  });

</script>
@endpush
@endsection
