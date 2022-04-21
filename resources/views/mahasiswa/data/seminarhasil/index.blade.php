@extends('layouts.apps')
@section('main-content')
<div class="row">
  <div class="col-12">
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <div class="d-flex justify-content-between">
        <h5 class="card-header">Data Seminar Hasil Tugas Akhir</h5>
        @if (!$seminar)
        <h5 class="card-header">
          <a href="{{ route('seminar.create') }}" class="btn btn-sm btn-primary">Ajukan Seminar</a>
        </h5>
        @endif
      </div>
      <div class="table-responsive text-muted">
        <table id="seminar-hasil" class="table card-table table-vcenter datatable nowrap" style="width: 100%;">
          <thead>
            <tr>
              <th class="text-muted col-2">Status</th>
              <th class="text-muted">Desc.</th>
              <th class="text-muted col-2">Action</th>
            </tr>
          </thead>
          <tbody>
            @if ($seminar)
            <tr>
              <td class="fw-semibold text-dark">
                @if ($seminar->status == 'diterima')
                <span class="badge bg-dark">Diterima
                  @elseif ($seminar->status == 'ditolak')
                  <span class="badge bg-danger">Ditolak
                    @elseif ($seminar->status == 'selesai')
                    <span class="badge bg-success">Selesai
                      @else
                      <span class="badge bg-info">Dikirim
                        @endif
                      </span>
              </td>
              <td class="fw-semibold text-dark">{{ ucwords($seminar->keterangan) }}</td>
              @if ($seminar->status == 'ditolak' or $seminar->status == 'dikirim')
              <td>
                <a href="{{ route('seminar.edit', $seminar->id) }}" class="btn btn-primary d-block d-sm-inline-block border-0 px-2">
                  <i class="bx bx-pencil"></i>
                </a>
                <a href="#" class="btn btn-dark px-2 border-0" data-bs-toggle="modal" data-bs-target="#modal-detail" data-remote="{{ route('seminar.show', $seminar->id) }}" data-title="Detail Pendaftaran Seminar Hasil Tugas Akhir">
                  <i class='bx bx-info-circle'></i>
                </a>
              </td>
              @else
              <td>
                <a href="#" class="btn btn-dark px-2 border-0" data-bs-toggle="modal" data-bs-target="#modal-detail" data-remote="{{ route('seminar.show', $seminar->id) }}" data-title="Detail Pendaftaran Seminar Hasil Tugas Akhir">
                  <i class='bx bx-info-circle'></i>
                </a>
              </td>
              @endif
            </tr>
            @else
            <tr>
              <td colspan="3" class="text-center">Data Seminar Hasil Tugas Akhir Tidak Tersedia</td>
            </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@push('after-script')
<script>
  $(document).ready(function($) {
    // Modal
    $("#modal-detail").on("show.bs.modal", function(e) {
      var button = $(e.relatedTarget);
      var modal = $(this);
      modal.find(".modal-body").load(button.data("remote"));
      modal.find(".modal-title").html(button.data("title"));
    });
  });

</script>

{{-- Modal Detail Pendaftaran Seminar Hasil Tugas Akhir --}}
<div class="modal modal-blur fade" id="modal-detail" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pendaftaran Seminar Hasil Tugas Akhir</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>
@endpush
@endsection
