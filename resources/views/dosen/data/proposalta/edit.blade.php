  {{-- Modal Edit Ajuan Proposal TA --}}
  <form method="POST" action="{{ route('proposal-mahasiswa.update', $proposal->id) }}">
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
          <div class="col">
              <span>File Ajuan Proposal Tugas Akhir</span>
              <ul class="my-2">
                  <li><a href="storage/{{ $proposal->file_satu }}" target="_blank" rel="noopener noreferrer"
                          class="text-muted-light">File
                          Satu</a></li>
                  @if ($proposal->file_dua != null)
                      <li><a href="storage/{{ $proposal->file_dua }}" target="_blank" rel="noopener noreferrer"
                              class="text-muted-light">File
                              Dua</a></li>
                  @endif
                  @if ($proposal->file_tiga != null)
                      <li><a href="storage/{{ $proposal->file_tiga }}" target="_blank" rel="noopener noreferrer"
                              class="text-muted-light">File
                              Tiga</a></li>
                  @endif
              </ul>
          </div>
      </div>
      <hr class="p-0 my-2" />
      {{-- Status Ajuan Proposal TA --}}
      <div class="mb-3">
          <label class="form-label">Status</label>
          <select type="text" class="form-select" placeholder="Pilih Salah Satu ..." id="status" name="status" />
          <option>Pilih salah satu ....</option>
          <option value="diterima" name="diterima">Diterima</option>
          <option value="ditolak" name="ditolak">Ditolak</option>
          </select>
      </div>
      {{-- Tanggal ACC --}}
      <div class="mb-3" id="tgl_acc">
          <label class="form-label">Tanggal ACC</label>
          <input type="date" class="form-control @error('tgl_acc') is-invalid @enderror" value="{{ old('tgl_acc') }}"
              name="tgl_acc" autocomplete="off" />
          @error('tgl_acc')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
      </div>
      {{-- Judul Tugas Akhir ACC --}}
      <div class="mb-3" id="judul_ta">
          <label class="form-label">Judul Tugas Akhir ACC</label>
          <textarea class="form-control @error('judul_ta') is-invalid @enderror" rows="1" name="judul_ta"
              autocomplete="off"></textarea>
          @error('judul_ta')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
      </div>
      {{-- Catatan --}}
      <div class="mb-3">
          <label class="form-label">Catatan</label>
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

  <script>
      $(function() {
          $('#tgl_acc').hide();
          $('#judul_ta').hide();
          $('#status').change(function() {
              if ($(this).val() == 'diterima') {
                  $('#tgl_acc').show();
                  $('#judul_ta').show();
              } else {
                  $('#tgl_acc').hide();
                  $('#judul_ta').hide();
              }
          });
      });
  </script>
