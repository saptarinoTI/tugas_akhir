@extends('layout.app')
@section('main-title', 'Proposal Tugas Akhir')
@section('main-title2')
    @if (!$proposal)
        <a href="#" class="btn btn-primary d-block d-sm-inline-block my-1 py-1 px-2" data-bs-toggle="modal"
            data-bs-target="#modal-ajuan">
            <span class="small">Ajukan Proposal</span>
        </a>
    @endif
@endsection
@section('main-page')
    <div class="row row-deck row-cards">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive text-muted">
                    <table id="table_proposal_ta" class="table card-table table-vcenter datatable nowrap"
                        style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-muted col-2">Status</th>
                                <th class="text-muted">Catatan</th>
                                <th class="text-muted col-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($proposal)
                                <td class="fw-semibold text-dark">
                                    @if ($proposal->status == 'diterima')
                                        <span class="badge bg-success">Diterima
                                        @elseif ($proposal->status == 'ditolak')
                                            <span class="badge bg-danger">Ditolak
                                            @elseif ($proposal->status == 'diproses')
                                                <span class="badge bg-dark">Diproses
                                                @elseif ($proposal->status == 'diperiksa')
                                                    <span class="badge bg-warning">Diperiksa
                                                    @else
                                                        <span class="badge bg-info">Dikirim
                                    @endif
                                    </span>
                                </td>
                                <td class="fw-semibold text-dark">{{ ucwords($proposal->keterangan) }}</td>
                                @if ($proposal->status == 'ditolak' or $proposal->status == 'dikirim')
                                    <td>
                                        <a href="#" class="btn btn-primary d-block d-sm-inline-block my-1 py-1 px-2"
                                            data-bs-toggle="modal" data-bs-target="#modal-edit">
                                            <span class="small"><i class="ti ti-pencil"></i></span>
                                        </a>
                                        <a href="#" class="btn btn-dark px-2 border-0" data-bs-toggle="modal"
                                            data-bs-target="#modal-detail"
                                            data-remote="{{ route('proposal.show', $proposal->id) }}"
                                            data-title="Detail Ajuan Proposal Tugas Akhir Mahasiswa">
                                            <span class="small"><i class="ti ti-eye"></i></span>
                                        </a>
                                    </td>
                                @elseif ($proposal->status == 'diproses' or $proposal->status == 'diterima' or $proposal->status == 'diperiksa')
                                    <td>
                                        <a href="#" class="btn btn-dark px-2 border-0" data-bs-toggle="modal"
                                            data-bs-target="#modal-detail"
                                            data-remote="{{ route('proposal.show', $proposal->id) }}"
                                            data-title="Detail Ajuan Proposal Tugas Akhir Mahasiswa">
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

    @push('before-script')
        {{-- Modal Ajuan Proposal TA --}}
        <div class="modal modal-blur fade" id="modal-ajuan" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-full-width modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ajuan Proposal Tugas Akhir</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('proposal.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                {{-- No Ajuan Proposal --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">No Ajuan Proposal</label>
                                        <input type="text" class="form-control @error('id') is-invalid @enderror" name="id"
                                            value="{{ date('Y') . $mahasiswa->nim }}" readonly />
                                        @error('id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- NIM Mahasiswa --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">NIM Mahasiswa</label>
                                        <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim"
                                            value="{{ $mahasiswa->nim }}" readonly />
                                        @error('nim')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr class="p-0 my-2" />
                            <p class="fw-semibold text-muted">Silahkan upload proposal tugas akhir. Maksimal mengajukan 3 judul
                                untuk proposal tugas akhir.
                            </p>
                            {{-- Proposal Satu --}}
                            <div class="mb-2">
                                <label class="form-label">Proposal Satu</label>
                                <input type="file" class="form-control @error('file_satu') is-invalid @enderror"
                                    name="file_satu" required />
                                <span class="small text-muted-light fw-semibold">* Upload file PDF maksimal 1 MB.</span>
                                @error('file_satu')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Judul Proposal Satu</label>
                                <input type="text" class="form-control @error('judul_satu') is-invalid @enderror"
                                    name="judul_satu" required autocomplete="off" />
                                @error('judul_satu')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- Proposal Dua --}}
                            <div class="mb-2">
                                <label class="form-label">Proposal Dua</label>
                                <input type="file" class="form-control @error('file_dua') is-invalid @enderror"
                                    name="file_dua" />
                                <span class="small text-muted-light fw-semibold">* Upload file PDF maksimal 1 MB.</span>
                                @error('file_dua')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Judul Proposal Dua</label>
                                <input type="text" class="form-control @error('judul_dua') is-invalid @enderror"
                                    name="judul_dua" autocomplete="off" />
                                @error('judul_dua')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- Proposal Tiga --}}
                            <div class="mb-2">
                                <label class="form-label">Proposal Tiga</label>
                                <input type="file" class="form-control @error('file_tiga') is-invalid @enderror"
                                    name="file_tiga" />
                                <span class="small text-muted-light fw-semibold">* Upload file PDF maksimal 1 MB.</span>
                                @error('file_tiga')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Judul Proposal Tiga</label>
                                <input type="text" class="form-control @error('judul_tiga') is-invalid @enderror"
                                    name="judul_tiga" autocomplete="off" />
                                @error('judul_tiga')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="w-100 text-end">
                                <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-sm py-1 btn-primary rounded-2">
                                    Simpan Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if ($proposal != null)
            {{-- Modal Edit Ajuan Proposal TA --}}
            <div class="modal modal-blur fade" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Rubah Ajuan Proposal Tugas Akhir</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('proposal.update', $proposal->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    {{-- No Ajuan Proposal --}}
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">No Ajuan Proposal</label>
                                            <input type="text" class="form-control @error('id') is-invalid @enderror" name="id"
                                                value="{{ $proposal->id }}" readonly />
                                            @error('id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- NIM Mahasiswa --}}
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">NIM Mahasiswa</label>
                                            <input type="text" class="form-control @error('nim') is-invalid @enderror"
                                                name="nim" value="{{ $mahasiswa->nim }}" readonly />
                                            @error('nim')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <hr class="p-0 my-2" />
                                <p class="fw-semibold text-muted">Silahkan upload proposal tugas akhir. Maksimal mengajukan 3
                                    judul
                                    untuk proposal tugas akhir.
                                </p>
                                {{-- Proposal Satu --}}
                                <div class="mb-2">
                                    <label class="form-label">Proposal Satu</label>
                                    @if ($proposal->file_satu != null)
                                        <p class="mb-1"><i class="ti ti-checks"></i>
                                            {{ ucwords($proposal->judul_satu) }}
                                            - <a href="storage/{{ $proposal->file_satu }}" target="_blank"
                                                rel="noopener noreferrer" class="text-info fw-semibold"><i
                                                    class="ti ti-download"></i></a>
                                        </p>
                                    @endif
                                    </p>
                                    <input type="file" class="form-control @error('file_satu') is-invalid @enderror"
                                        name="file_satu" />
                                    <span class="small text-muted-light fw-semibold">* Upload file PDF maksimal 1 MB.</span>
                                    @error('file_satu')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Judul Proposal Satu</label>
                                    <input type="text" class="form-control @error('judul_satu') is-invalid @enderror"
                                        name="judul_satu" autocomplete="off" />
                                    @error('judul_satu')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                {{-- Proposal Dua --}}
                                <div class="mb-2">
                                    <label class="form-label">Proposal Dua</label>
                                    @if ($proposal->file_dua != null)
                                        <p class="mb-1"><i class="ti ti-checks"></i>
                                            {{ ucwords($proposal->judul_dua) }} - <a
                                                href="storage/{{ $proposal->file_dua }}" target="_blank"
                                                rel="noopener noreferrer" class="text-info fw-semibold"><i
                                                    class="ti ti-download"></i></a>
                                        </p>
                                    @endif
                                    <input type="file" class="form-control @error('file_dua') is-invalid @enderror"
                                        name="file_dua" />
                                    <span class="small text-muted-light fw-semibold">* Upload file PDF maksimal 1 MB.</span>
                                    @error('file_dua')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Judul Proposal Dua</label>
                                    <input type="text" class="form-control @error('judul_dua') is-invalid @enderror"
                                        name="judul_dua" autocomplete="off" />
                                    @error('judul_dua')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                {{-- Proposal Tiga --}}
                                <div class="mb-2">
                                    <label class="form-label">Proposal Tiga</label>
                                    @if ($proposal->file_tiga != null)
                                        <p class="mb-1"><i class="ti ti-checks"></i>
                                            {{ ucwords($proposal->judul_tiga) }} - <a
                                                href="storage/{{ $proposal->file_tiga }}" target="_blank"
                                                rel="noopener noreferrer" class="text-info fw-semibold"><i
                                                    class="ti ti-download"></i></a></p>
                                    @endif
                                    <input type="file" class="form-control @error('file_tiga') is-invalid @enderror"
                                        name="file_tiga" />
                                    <span class="small text-muted-light fw-semibold">* Upload file PDF maksimal 1 MB.</span>
                                    @error('file_tiga')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Judul Proposal Tiga</label>
                                    <input type="text" class="form-control @error('judul_tiga') is-invalid @enderror"
                                        name="judul_tiga" autocomplete="off" />
                                    @error('judul_tiga')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="w-100 text-end">
                                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                                        Cancel
                                    </a>
                                    <button type="submit" class="btn btn-sm py-1 btn-primary rounded-2">
                                        Simpan Data
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endpush
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
            <div class="modal-dialog modal-dialog-centered modal-full-width modal-dialog-scrollable" role="document">
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
