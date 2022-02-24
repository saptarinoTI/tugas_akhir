{{-- Modal Edit Ajuan Proposal TA --}}
<form method="POST" action="{{ route('data-proposal.dosen.update', $proposal->id) }}">
    @csrf
    @method('PATCH')
    <div class="row">
        {{-- NIM Mahasiswa --}}
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">NIM Mahasiswa</label>
                <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" id="nim"
                    value="{{ $proposal->mahasiswa->nim }}" readonly />
                @error('nim')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        {{-- Nama Mahasiswa --}}
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Nama Mahasiswa</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama"
                    value="{{ ucwords($proposal->mahasiswa->nama) }}" readonly />
                @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Dosen Pembimbing Utama</label>
                <input type="text" class="form-control @error('dosen_id_satu') is-invalid @enderror"
                    name="dosen_id_satu" id="dosen_id_satu" value="{{ ucwords($proposal->dosen_satu->nama) }}"
                    readonly />
                @error('dosen_id_satu')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Dosen Pembimbing Pendamping</label>
                <select type="text" class="form-select" placeholder="Select a date" name="dosen_id_dua">
                    <option>Pilih salah satu dosen pembimbing pendamping ....</option>
                    @foreach ($dosens as $dosen)
                        <option value="{{ $dosen->id }}">{{ ucwords($dosen->nama) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    {{-- Judul Tugas Akhir ACC --}}
    <div class="mb-3" id="judul_ta">
        <label class="form-label">Judul Proposal Tugas Akhir ACC</label>
        <textarea class="form-control @error('judul_ta') is-invalid @enderror" rows="2" name="judul_ta" required
            autocomplete="off" readonly>{{ $proposal->judul_ta }}</textarea>
        @error('judul_ta')
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
