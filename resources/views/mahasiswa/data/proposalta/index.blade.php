@extends('layouts.apps')
@section('main-content')
<div class="row">
  <div class="col-12">
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <div class="d-flex justify-content-between">
        <h5 class="card-header">Data Ajuan Proposal Tugas Akhir</h5>
        @if (!$proposal)
        <h5 class="card-header">
          <a href="{{ route('proposal.create') }}" class="btn btn-sm btn-primary">Ajukan Proposal</a>
        </h5>
        @endif
      </div>
      <div class="table-responsive text-nowrap">
        <table class="table card-table table-center datatable nowrap" id="data-diri-mahasiswa" style="width: 100%">
          <thead>
            @if ($proposal)
            <tr>
              <th class="text-muted col-2">Status</th>
              <th class="text-muted">Desc.</th>
              <th class="text-muted col-2">Action</th>
            </tr>
            @endif
          </thead>
          <tbody>
            <tr>
              @if ($proposal)
              <td class="fw-semibold text-dark">
                @if ($proposal->status == 'diterima')
                <span class="badge bg-dark">Diterima
                  @elseif ($proposal->status == 'ditolak')
                  <span class="badge bg-danger">Ditolak
                    @elseif ($proposal->status == 'selesai')
                    <span class="badge bg-success">Selesai
                      @else
                      <span class="badge bg-info">Dikirim
                        @endif
                      </span>
              </td>
              <td class="fw-semibold text-dark">{{ ucwords($proposal->keterangan) }}</td>
              @if ($proposal->status == 'ditolak' or $proposal->status == 'dikirim')
              <td>
                <a href="{{ route('proposal.edit', $proposal->id) }}" class="btn btn-primary d-block d-sm-inline-block my-1 px-2 border-0">
                  <i class="bx bx-pencil"></i>
                </a>
                <a href="#" class="btn btn-dark px-2 border-0" data-bs-toggle="modal" data-bs-target="#modal-detail" data-remote="{{ route('proposal.show', $proposal->id) }}" data-title="Detail Ajuan Proposal Tugas Akhir Mahasiswa">
                  <i class='bx bx-info-circle'></i>
                </a>
              </td>
              @elseif ($proposal->status == 'selesai' or $proposal->status == 'diterima')
              <td>
                <a href="#" class="btn btn-dark px-2 border-0" data-bs-toggle="modal" data-bs-target="#modal-detail" data-remote="{{ route('proposal.show', $proposal->id) }}" data-title="Detail Ajuan Proposal Tugas Akhir Mahasiswa">
                  <i class='bx bx-info-circle'></i>
                </a>
              </td>
              @endif
              @else
              <td colspan="3" class="text-center">Ajuan Proposal Tugas Akhir Tidak Tersedia</td>
              @endif
            </tr>
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

{{-- Modal Detail Ajuan Proposal TA --}}
<div class="modal modal-blur fade" id="modal-detail" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ajuan Proposal Tugas Akhir</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>
@endpush
@endsection
