@if ($seminar->status == 'dikirim')
    <form method="POST" action="{{ route('data-seminar-hasil.update', $seminar->id) }}">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">NIM Mahasiswa</label>
                    <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" id="nim"
                        value="{{ $seminar->mahasiswa->nim }}" readonly />
                    @error('nim')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Nama Mahasiswa</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama"
                        value="{{ ucwords($seminar->mahasiswa->nama) }}" readonly />
                    @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        <hr class="p-0 my-2" />
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select type="text" class="form-select" placeholder="Select a date" id="status" name="status">
                <option>Pilih Status ...</option>
                <option value="diterima">Diterima</option>
                <option value="ditolak">Ditolak</option>
            </select>
        </div>
        <div class="mb-3" id="keterangan">
            <label class="form-label">Keterangan</label>
            <textarea class="form-control @error('keterangan') is-invalid @enderror" rows="3" name="keterangan"
                autocomplete="off"></textarea>
            @error('keterangan')
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
@else
    <form method="POST" action="{{ route('data-seminar-hasil.status', $seminar->id) }}">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">NIM Mahasiswa</label>
                    <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" id="nim"
                        value="{{ $seminar->mahasiswa->nim }}" readonly />
                    @error('nim')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Nama Mahasiswa</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama"
                        value="{{ ucwords($seminar->mahasiswa->nama) }}" readonly />
                    @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        <hr class="p-0 my-2" />
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select type="text" class="form-select" placeholder="Select a date" id="status" name="status">
                <option>Pilih Status ...</option>
                <option value="selesai">Selesai</option>
            </select>
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
@endif

<script>
    $(function() {
        $('#keterangan').hide();
        $('#status').change(function() {
            if ($(this).val() == 'ditolak') {
                $('#keterangan').show();
            } else {
                $('#keterangan').hide();
            }
        });
    });
</script>
