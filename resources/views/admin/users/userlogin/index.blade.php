@extends('layout.app')
@section('main-title', 'User Login')
@section('main-title2')
    <a href="#" class="btn btn-primary d-block d-sm-inline-block my-1 py-1 px-2" data-bs-toggle="modal"
        data-bs-target="#modal-tambah">
        <span class="small">Tambah Data</span>
    </a>
    <a href="#" class="btn btn-light d-block d-sm-inline-block my-1 py-1 px-2" data-bs-toggle="modal"
        data-bs-target="#modal-import">
        <span class="small">Import Data Mhs.</span>
    </a>
@endsection

@section('main-page')
    <div class="row row-deck row-cards">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive text-muted">
                    <table id="table-users" class="table card-table table-vcenter datatable nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-muted">Username</th>
                                <th class="text-muted">Name</th>
                                <th class="text-muted">Email</th>
                                <th class="text-muted">Role</th>
                                <th class="text-muted">Thn. Ajaran</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    @push('before-script')
        <div class="modal modal-blur fade" id="modal-tambah" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('user-login.store') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    value="{{ old('username') }}" name="username" placeholder="Input Username"
                                    autocomplete="off" />
                                <span class="medium text-dark">* Silahkan input username hanya angka saja.</span>
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}" name="name" placeholder="Input name" autocomplete="off" />
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-0">
                                <label class="form-label">Role</label>
                                <select class="form-select @error('role') is-invalid @enderror" id="basicSelect" name="role">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ ucwords($role->name) }}</option>
                                    @endforeach
                                </select>
                                @error('role')
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

        <div class="modal modal-blur fade" id="modal-import" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Import Data Login Mahasiswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" enctype="multipart/form-data" action="{{ route('user-login.import') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Import Excel</label>
                                <input type="file" class="form-control text-muted @error('importexcel') is-invalid @enderror"
                                    name="importexcel" />
                                <span class="medium text-dark">* Silahkan upload file excel data mahasiswa.</span>
                                @error('importexcel')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="text-center">
                                <p class="text-left text-dark my-2">** Contoh data mahasiswa seperti gambar dibawah.</p>
                                <a href="{{ asset('img/import/mahasiswa.png') }}" target="_blank">
                                    <img src="{{ asset('img/import/mahasiswa.png') }}" width="300px"
                                        alt="Import Data Login Mahasiswa">
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
        </div>
    @endpush

    @push('after-script')
        <script>
            // button destroy
            $('#table-users').on('click', '.btn-delete', function(e) {
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
                                    $('#table-users').DataTable().ajax.reload();
                                    swal({
                                        text: "Data berhasil dihapus!",
                                        icon: "success",
                                    });
                                }
                            });
                        }
                    });
            });

            // Script of DataTables
            $(function() {
                var table = $('#table-users').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    pageLength: 10,
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    // lengthChange: false,
                    order: [
                        [0, "asc"]
                    ],
                    ajax: "{{ route('user-login.get') }}",
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        }, {
                            data: 'role',
                            name: 'role'
                        }, {
                            data: 'btn',
                            name: 'btn'
                        },
                    ]
                });
            });
        </script>
    @endpush

@endsection
