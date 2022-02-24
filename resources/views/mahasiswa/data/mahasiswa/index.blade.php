@extends('layout.app')
@section('main-title', 'Data Mahasiswa')
@section('main-title2')
    @if (!$mahasiswa)
        <a href="#" class="btn btn-primary d-block d-sm-inline-block my-1 py-1 px-2" data-bs-toggle="modal"
            data-bs-target="#modal-tambah">
            <span class="small">Tambah Data</span>
        </a>
    @endif
@endsection
@section('main-page')
    <div class="row row-deck row-cards">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table id="table_data_mahasiswa" class="table card-table table-vcenter datatable nowrap"
                        style="width: 100%;">
                        <thead>
                            @if ($mahasiswa != null)
                                <tr>
                                    <th class="text-muted">NIM</th>
                                    <th class="text-muted">Nama</th>
                                    <th class="text-muted">No. Hp</th>
                                    <th class="text-muted">TTL</th>
                                    <th class="text-muted">Alamat</th>
                                    <th class="text-muted">Aksi</th>
                                </tr>
                            @else
                                <tr>
                                    <td colspan="6" class="text-dark fw-semibold text-center">Mahasiswa belum mendaftarkan
                                        diri.
                                    </td>
                                </tr>
                            @endif
                        </thead>
                        <tbody>
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
                                        <a href="#" class="btn btn-dark px-2 border-0" data-bs-toggle="modal"
                                            data-bs-target="#modal-edit">
                                            <span class="small"><i class="ti ti-pencil"></i></span>
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('before-script')
        {{-- Modal Tambah --}}
        <div class="modal modal-blur fade" id="modal-tambah" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Data Diri Mahasiswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('mahasiswa.store') }}">
                            @csrf
                            {{-- NIM Mahasiswa --}}
                            <div class="mb-3">
                                <label class="form-label">NIM Mahasiswa</label>
                                <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim"
                                    value="{{ ucwords($nim) }}" readonly>
                                @error('nim')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- Nama Mahasiswa --}}
                            <div class="mb-3">
                                <label class="form-label">Nama Mahasiswa</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" required
                                    autocomplete="off">
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- Nomor Hp --}}
                            <div class="mb-3">
                                <label class="form-label">Nomor Hp</label>
                                <input type="number" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp"
                                    required autocomplete="off">
                                @error('no_hp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-lg-5">
                                    {{-- Tempat Lahir --}}
                                    <div class="mb-3">
                                        <label class="form-label">Tempat Lahir</label>
                                        <input type="text" class="form-control @error('tpt_lahir') is-invalid @enderror"
                                            name="tpt_lahir" required autocomplete="off">
                                        @error('tpt_lahir')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="mb-3">
                                        {{-- Tanggal Lahir --}}
                                        <label class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror"
                                            name="tgl_lahir" required autocomplete="off">
                                        @error('tgl_lahir')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- Alamat Lengkap --}}
                            <div class="mb-3">
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" rows="2" name="alamat"
                                    required autocomplete="off"></textarea>
                                @error('alamat')
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

        @if ($mahasiswa != null)
            {{-- Modal Edit --}}
            <div class="modal modal-blur fade" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Data Diri Mahasiswa</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('mahasiswa.update', $mahasiswa->nim) }}">
                                @csrf
                                @method('PATCH')
                                {{-- NIM Mahasiswa --}}
                                <div class="mb-3">
                                    <label class="form-label">NIM Mahasiswa</label>
                                    <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim"
                                        value="{{ ucwords($nim) }}" readonly>
                                    @error('nim')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                {{-- Nama Mahasiswa --}}
                                <div class="mb-3">
                                    <label class="form-label">Nama Mahasiswa</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                        required autocomplete="off" value="{{ $mahasiswa->nama }}">
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                {{-- Nomor Hp --}}
                                <div class="mb-3">
                                    <label class="form-label">Nomor Hp</label>
                                    <input type="number" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp"
                                        required autocomplete="off" value="{{ $mahasiswa->no_hp }}">
                                    @error('no_hp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-lg-5">
                                        {{-- Tempat Lahir --}}
                                        <div class="mb-3">
                                            <label class="form-label">Tempat Lahir</label>
                                            <input type="text" class="form-control @error('tpt_lahir') is-invalid @enderror"
                                                name="tpt_lahir" required autocomplete="off"
                                                value="{{ $mahasiswa->tpt_lahir }}">
                                            @error('tpt_lahir')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="mb-3">
                                            {{-- Tanggal Lahir --}}
                                            <label class="form-label">Tanggal Lahir</label>
                                            <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror"
                                                name="tgl_lahir" required autocomplete="off"
                                                value="{{ $mahasiswa->tgl_lahir }}">
                                            @error('tgl_lahir')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                {{-- Alamat Lengkap --}}
                                <div class="mb-3">
                                    <label class="form-label">Alamat Lengkap</label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" rows="2" name="alamat"
                                        required autocomplete="off">{{ $mahasiswa->alamat }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="w-100 text-end">
                                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                                        Cancel
                                    </a>
                                    <button type="submit" class="btn btn-sm py-1 btn-info rounded-2">
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
            $(function() {
                var table = $('#table_data_mahasiswa').DataTable({
                    processing: true,
                    responsive: true,
                    lengthChange: false,
                    searching: false,
                    "paging": false,
                    "info": false
                });
            });
        </script>
    @endpush
@endsection
