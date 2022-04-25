@extends('layouts.apps')
@section('main-content')
<div class="row">
  <div class="col-12">
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <div class="d-flex justify-content-between">
        <h5 class="card-header">Data Dosen</h5>
        <h5 class="card-header">
          <a href="{{ route('data-dosen.create') }}" class="btn btn-sm btn-primary">Tambah Data</a>
        </h5>
      </div>
      <div class="table-responsive text-nowrap">
        <table class="table card-table table-center datatable nowrap" id="data-dosen" style="width: 100%">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nama</th>
              <th>Proposal</th>
              <th>Seminar</th>
              <th>Pendadaran</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @foreach ($dosens as $dosen)
            <tr>
              <td>{{ $dosen->id }}</td>
              <td>{{ ucwords($dosen->nama) }}</td>
              @php
              $proposalProgres = App\Models\ProposalTA::where([['dosen_id_satu', '=', $dosen->id],['status', '=', 'diterima'],])->orWhere([['dosen_id_dua', '=', $dosen->id],['status', '=', 'diterima'],])->get();
              $semhasProgres = App\Models\SeminarHasil::where('status', 'diterima')->whereHas('proposal', function ($query) {$query->where('dosen_id_satu', auth()->user()->id)->orWhere('dosen_id_dua', auth()->user()->id);})->get();
              $pendadaranProgres = App\Models\Pendadaran::where('status', 'diterima')->whereHas('proposal', function ($query) {$query->where('dosen_id_satu', auth()->user()->id)->orWhere('dosen_id_dua', auth()->user()->id);})->get();
              @endphp
              <td>{{ count($proposalProgres) }} Mhs</td>
              <td>{{ count($semhasProgres) }} Mhs</td>
              <td>{{ count($pendadaranProgres) }} Mhs</td>
              <td>
                <a href="{{ route('data-dosen.edit', [$dosen->id]) }}" class="btn btn-dark border-0 d-block d-sm-inline-block my-1 py-1 px-2 btn-edit">
                  <i class="bx bx-pencil"></i>
                </a>
                <a href="data-dosen/{{ $dosen->id }}" class="btn btn-delete border-0 py-1 px-2 btn-danger">
                  <i class="bx bx-trash"></i>
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <!--/ Basic Bootstrap Table -->
  </div>
</div>

@push('after-script')
<script>
  $('#data-dosen').on('click', '.btn-delete', function(e) {
    e.preventDefault();
    var me = $(this)
      , url = me.attr('href')
      , csrf_token = $('meta[name="csrf-token"]').attr('content');
    swal({
        title: "Hapus Data ?"
        , icon: "warning"
        , buttons: true
        , dangerMode: true
      , })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            type: "POST"
            , url: url
            , data: {
              '_method': 'DELETE'
              , '_token': csrf_token
            }
            , success: function(response) {
              swal({
                text: "Data berhasil dihapus!"
                , icon: "success"
              , });
              location.reload();
            }
          });
        }
      });
  });

  // Script of DataTables
  $(function() {
    var table = $('#data-dosen').DataTable({
      processing: true,
      // serverSide: true,
      responsive: true
      , pageLength: 10
      , lengthMenu: [
        [10, 25, 50, -1]
        , [10, 25, 50, "All"]
      ]
      , lengthChange: false
      , order: [
        [0, "asc"]
      ]
    , });
  });

</script>
@endpush

@endsection
