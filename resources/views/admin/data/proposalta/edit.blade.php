  {{-- Modal Edit Ajuan Proposal TA --}}
  <form method="POST" action="{{ route('data-proposal.update', $proposal->id) }}">
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
      <hr class="p-0 my-2" />
      {{-- Status Ajuan Proposal TA --}}
      <div class="mb-3">
          <label class="form-label">Penguji Proposal Tugas Akhir</label>
          <select type="text" class="form-select" placeholder="Select a date" id="select-tags" name="penguji_prota">
              @if ($proposal->dosen_id_satu == null)
                  <option>Pilih salah satu dosen penguji ....</option>
                  @foreach ($dosens as $dosen)
                      <option value="{{ $dosen->id }}">{{ ucwords($dosen->nama) }}</option>
                  @endforeach
              @else
                  <option value="{{ $proposal->dosen_id_satu }}">{{ ucwords($proposal->dosen_satu->nama) }}</option>
                  @foreach ($dosens as $dosen)
                      @if ($dosen->id != $proposal->dosen_id_satu)
                          <option value="{{ $dosen->id }}">{{ ucwords($dosen->nama) }}</option>
                      @endif
                  @endforeach
              @endif
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
