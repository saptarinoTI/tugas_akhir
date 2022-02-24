@extends('layout.app')
@section('main-title', 'Data Dosen Pembimbing')
@section('main-title2')
    <a href="#" class="btn btn-primary d-block d-sm-inline-block my-1 py-1 px-2" data-bs-toggle="modal"
        data-bs-target="#modal-tambah">
        <span class="small">Tambah Data</span>
    </a>
    {{-- <a href="#" class="btn btn-light d-block d-sm-inline-block my-1 py-1 px-2" data-bs-toggle="modal"
        data-bs-target="#modal-import">
        <span class="small">Import Data Dosen.</span>
    </a> --}}
@endsection
@section('main-page')
    <div class="row row-deck row-cards">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive text-muted">
                    <table id="data_dosen" class="table card-table table-vcenter datatable nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-muted">ID Dosen</th>
                                <th class="text-muted">Nama Dosen</th>
                                <th class="text-muted col-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dosens as $dosen)
                                <tr>
                                    <td>{{ $dosen->id }}</td>
                                    <td>{{ ucwords($dosen->nama) }}</td>
                                    <td>
                                        <a href="#"
                                            class="btn btn-dark border-0 d-block d-sm-inline-block my-1 py-1 px-2 btn-edit"
                                            data-bs-toggle="modal" data-id="{{ $dosen->id }}"
                                            data-name="{{ $dosen->nama }}" data-bs-target="#modal-edit">
                                            <i class="ti ti-pencil"></i>
                                        </a>
                                        <a href="data-dosen/{{ $dosen->id }}"
                                            class="btn btn-delete border-0 px-2 btn-danger">
                                            <i class="ti ti-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('before-script')
        {{-- Modal Tambah --}}
        <div class="modal modal-blur fade" id="modal-tambah" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data Dosen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('data-dosen.store') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">ID Dosen</label>
                                <input type="text" class="form-control @error('id_dosen') is-invalid @enderror"
                                    value="{{ old('id_dosen') }}" name="id_dosen" placeholder="Input id dosen"
                                    autocomplete="off" />
                                <span class="medium text-dark">* Silahkan input id dosen hanya angka saja.</span>
                                @error('id_dosen')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    value="{{ old('nama') }}" name="nama" placeholder="Input name" autocomplete="off" />
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                                <span class="small">Simpan Data</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Modal Edit --}}
        <div class="modal modal-blur fade" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Rubah Data Dosen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" id="form-edit" action=".">
                        @csrf
                        @method('PATCH')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">ID Dosen</label>
                                <input type="text" class="form-control @error('id_dosen') is-invalid @enderror"
                                    value="{{ old('id_dosen') }}" name="id_dosen" id="id_dosen" placeholder="Input id dosen"
                                    autocomplete="off" readonly />
                                <span class="medium text-dark">* Silahkan input id dosen hanya angka saja.</span>
                                @error('id_dosen')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    value="{{ old('nama') }}" name="nama" id="nama_dosen" placeholder="Input name"
                                    autocomplete="off" />
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                                <span class="small">Simpan Data</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Modal Import --}}
        {{-- <div class="modal modal-blur fade" id="modal-import" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Import Data Dosen Pembimbing</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" enctype="multipart/form-data" action="{{ route('data-dosen.import') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Import Excel</label>
                                <input type="file" class="form-control text-muted @error('importexcel') is-invalid @enderror"
                                    name="importexcel" />
                                <span class="medium text-dark">* Silahkan upload file excel data dosen.</span>
                                @error('importexcel')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="text-center">
                                <p class="text-left text-dark my-2">** Contoh data dosen seperti gambar dibawah.</p>
                                <a href="{{ asset('img/import/dosen.png') }}" target="_blank">
                                    <img src="{{ asset('img/import/dosen.png') }}" width="300px"
                                        alt="Import Data Login Dosen">
                                </a>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                                <span class="small">Simpan Data</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}
    @endpush

    @push('after-script')
        <script>
            /* BTN Edit */
            $(".btn-edit").click(function() {
                var id = $(this).attr('data-id');
                var nama_dosen = $(this).attr('data-name');
                $("#form-edit").prop("action", "data-dosen/" + id);
                $("#id_dosen").val(id);
                $("#nama_dosen").val(nama_dosen);
                $("#modal-edit").modal('show');
            });

            // button destroy
            $('#data_dosen').on('click', '.btn-delete', function(e) {
                e.preventDefault();
                var me = $(this),
                    url = me.attr('href'),
                    csrf_token = $('meta[name="csrf-token"]').attr('content');
                swal({
                        title: "Hapus Data ?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                type: "POST",
                                url: url,
                                data: {
                                    '_method': 'DELETE',
                                    '_token': csrf_token
                                },
                                success: function(response) {
                                    swal({
                                        text: "Data berhasil dihapus!",
                                        icon: "success",
                                    });
                                    location.reload();
                                }
                            });
                        }
                    });
            });

            $(function() {
                var table = $('#data_dosen').DataTable({
                    processing: true,
                    // serverSide: true,
                    responsive: true,
                    pageLength: 10,
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    lengthChange: false,
                    order: [
                        [0, "asc"]
                    ],
                });
            });
        </script>
    @endpush
@endsection
