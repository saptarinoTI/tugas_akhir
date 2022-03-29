@extends('layout.app')
@section('main-title', 'Pendaftaran Pendadaran')
@section('main-title2')
    @if (!$pendadaran)
        <a href="#" class="btn btn-primary d-block d-sm-inline-block my-1 py-1 px-2" data-bs-toggle="modal"
            data-bs-target="#modal-pendadaran" data-remote="{{ route('pendadaran.create') }}"
            data-title="Rubah Data Pendaftaran Pendadaran Tugas Akhir">
            <span class="small">Pendaftaran Pendadaran</i></span>
        </a>
    @endif
@endsection
@section('main-page')
    <div class="row row-deck row-cards">
        <span class="mt-0 pt-0 text-muted-light text-medium">Untuk ketentuan Pendadaran / Ujian Sidang Tugas Akhir silahkan
            lihat buku panduan TA
            yang
            bisa didapatkan dibagian Prodi.</span>
        <div class="col-12">
            <div class="card">
                <div class="table-responsive text-muted">
                    <table id="table_seminar_hasil" class="table card-table table-vcenter datatable nowrap"
                        style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-muted col-2">Status</th>
                                <th class="text-muted">Catatan</th>
                                <th class="text-muted col-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($pendadaran)
                                <td class="fw-semibold text-dark">
                                    @if ($pendadaran->status == 'diterima')
                                        <span class="badge bg-dark">Diterima
                                        @elseif ($pendadaran->status == 'ditolak')
                                            <span class="badge bg-warning">Ditolak
                                            @elseif ($pendadaran->status == 'lulus')
                                                <span class="badge bg-success">Lulus
                                                @elseif ($pendadaran->status == 'tidak_lulus')
                                                    <span class="badge bg-danger">Tidak Lulus
                                                    @else
                                                        <span class="badge bg-info">Dikirim
                                    @endif
                                    </span>
                                </td>
                                <td class="fw-semibold text-dark">{{ ucwords($pendadaran->keterangan) }}</td>
                                @if ($pendadaran->status == 'ditolak' or $pendadaran->status == 'dikirim')
                                    <td>
                                        <a href="#" class="btn btn-dark d-block d-sm-inline-block my-1 py-1 px-2"
                                            data-bs-toggle="modal" data-bs-target="#modal-pendadaran"
                                            data-remote="{{ route('pendadaran.edit', $pendadaran->id) }}"
                                            data-title="Rubah Data Pendaftaran Pendadaran Tugas Akhir">
                                            <span class="small"><i class="ti ti-pencil"></i></span>
                                        </a>
                                        <a href="#" class="btn btn-info px-2 border-0" data-bs-toggle="modal"
                                            data-bs-target="#modal-pendadaran"
                                            data-remote="{{ route('pendadaran.show', $pendadaran->id) }}"
                                            data-title="Detail Pendaftaran Pendadaran Tugas Akhir">
                                            <span class="small"><i class="ti ti-eye"></i></span>
                                        </a>
                                    </td>
                                @else
                                    <td>
                                        <a href="#" class="btn btn-dark px-2 border-0" data-bs-toggle="modal"
                                            data-bs-target="#modal-pendadaran"
                                            data-remote="{{ route('pendadaran.show', $pendadaran->id) }}"
                                            data-title="Detail Pendaftaran Pendadaran Tugas Akhir">
                                            <span class="small"><i class="ti ti-eye"></i></span>
                                        </a>
                                    </td>
                                @endif
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
                /* Modal Pengajuan */
                $("#modal-pendadaran").on("show.bs.modal", function(e) {
                    var button = $(e.relatedTarget);
                    var modal = $(this);
                    modal.find(".modal-body").load(button.data("remote"));
                    modal.find(".modal-title").html(button.data("title"));
                });
            });
        </script>

        <!-- Modal Pengajuan Pendaftaran Pendadaran Tugas Akhir -->
        <div class="modal modal-blur fade" id="modal-pendadaran" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-full-width modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    </div>
                </div>
            </div>
        </div>
    @endpush
@endsection
