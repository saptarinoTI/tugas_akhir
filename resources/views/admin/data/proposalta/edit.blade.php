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
      <div class="row">
          <div class="col">
              <span>File Ajuan Proposal Tugas Akhir</span>
              <br />
              <i class="ti ti-checks"></i><a href="storage/{{ $proposal->file_satu }}" target="_blank"
                  rel="noopener noreferrer" class="text-muted"> {{ ucwords($proposal->judul_satu) }}</a>
              <br />
              @if ($proposal->file_dua != null)
                  <i class="ti ti-checks"></i><a href="storage/{{ $proposal->file_dua }}" target="_blank"
                      rel="noopener noreferrer" class="text-muted"> {{ ucwords($proposal->judul_dua) }}</a>
              @endif
              <br />
              @if ($proposal->file_tiga != null)
                  <i class="ti ti-checks"></i><a href="storage/{{ $proposal->file_tiga }}" target="_blank"
                      rel="noopener noreferrer" class="text-muted"> {{ ucwords($proposal->judul_tiga) }}</a>
              @endif

          </div>
      </div>
      <hr class="p-0 my-2" />
      {{-- Status Ajuan Proposal TA --}}
      <div class="mb-3">
          <label class="form-label">Status</label>
          <select class="form-select" placeholder="Pilih Salah Satu ..." id="status" name="status" />
          <option value="">Pilih salah satu ....</option>
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
          <select name="judul_ta" class="form-select">
              <option value="">Silahkan pilih salah satu ... </option>
              <option
                  value="{{ $proposal->judul_satu }}@if ($proposal->judul_dua) , {{ $proposal->judul_dua }} @endif @if ($proposal->judul_tiga) , {{ $proposal->judul_tiga }} @endif">
                  Semua Judul</option>
              <option value="{{ $proposal->judul_satu }}">{{ ucwords($proposal->judul_satu) }}</option>
              @if ($proposal->judul_dua)
                  <option value="{{ $proposal->judul_dua }}">{{ ucwords($proposal->judul_dua) }}</option>
              @endif
              @if ($proposal->judul_tiga)
                  <option value="{{ $proposal->judul_tiga }}">{{ ucwords($proposal->judul_tiga) }}</option>
              @endif
          </select>
          @error('judul_ta')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
      </div>
      {{-- Dosen --}}
      <div class="row" id="dosen">
          <div class="col-md-6">
              <div class="mb-3">
                  <label class="form-label">Dosen Pembimbing Utama</label>
                  <select class="form-select" placeholder="Select a date" name="dosen_id_satu">
                      <option value="">Pilih salah satu dosen pembimbing utama ....</option>
                      @php
                          foreach ($dosens as $item):
                              $proposal = App\Models\ProposalTA::where([['dosen_id_satu', '=', $item->id], ['status', '=', 'diterima']])
                                  ->orWhere([['dosen_id_dua', '=', $item->id], ['status', '=', 'diterima']])
                                  ->count();
                              $seminar = App\Models\SeminarHasil::where('status', 'diterima')
                                  ->whereHas('proposal', function ($query) use ($item) {
                                      $query->where('dosen_id_satu', $item->id)->orWhere('dosen_id_dua', $item->id);
                                  })
                                  ->count();
                              $pendadaran = App\Models\Pendadaran::where('status', 'diterima')
                                  ->whereHas('proposal', function ($query) use ($item) {
                                      $query->where('dosen_id_satu', $item->id)->orWhere('dosen_id_dua', $item->id);
                                  })
                                  ->count();
                              $result = $proposal + $seminar + $pendadaran;
                              echo '<option value="' . $item->id . '">' . ucwords($item->nama) . ' | Mhs. Bimbingan : ' . $result . '</option>';
                          endforeach;
                      @endphp
                      {{-- @foreach ($dosens as $dosen)
                          <option value="{{ $dosen->id }}">{{ ucwords($dosen->nama) }}</option>
                      @endforeach --}}
                  </select>
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
                  <select class="form-select" placeholder="Select a date" name="dosen_id_dua">
                      <option value="">Pilih salah satu dosen pembimbing pendamping ....</option>
                      @php
                          foreach ($dosens as $item):
                              $proposal = App\Models\ProposalTA::where([['dosen_id_satu', '=', $item->id], ['status', '=', 'diterima']])
                                  ->orWhere([['dosen_id_dua', '=', $item->id], ['status', '=', 'diterima']])
                                  ->count();
                              $seminar = App\Models\SeminarHasil::where('status', 'diterima')
                                  ->whereHas('proposal', function ($query) use ($item) {
                                      $query->where('dosen_id_satu', $item->id)->orWhere('dosen_id_dua', $item->id);
                                  })
                                  ->count();
                              $pendadaran = App\Models\Pendadaran::where('status', 'diterima')
                                  ->whereHas('proposal', function ($query) use ($item) {
                                      $query->where('dosen_id_satu', $item->id)->orWhere('dosen_id_dua', $item->id);
                                  })
                                  ->count();
                              $result = $proposal + $seminar + $pendadaran;
                              echo '<option value="' . $item->id . '">' . ucwords($item->nama) . ' | Mhs. Bimbingan : ' . $result . '</option>';
                          endforeach;
                      @endphp
                      {{-- @foreach ($dosens as $dosen)
                          <option value="{{ $dosen->id }}">{{ ucwords($dosen->nama) }}</option>
                      @endforeach --}}
                  </select>
                  @error('dosen_id_dua')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>
          </div>
      </div>
      {{-- Catatan --}}
      <div class="mb-3">
          <label class="form-label">Catatan</label>
          <textarea class="form-control @error('keterangan') is-invalid @enderror" rows="3" name="keterangan"
              autocomplete="off"></textarea>
          <span class="text-muted text-sm">* Silahkan isi catatan jika status ditolak</span>
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
          $('#dosen').hide();
          $('#status').change(function() {
              if ($(this).val() == 'diterima') {
                  $('#tgl_acc').show();
                  $('#judul_ta').show();
                  $('#dosen').show();
              } else {
                  $('#tgl_acc').hide();
                  $('#judul_ta').hide();
                  $('#dosen').hide();
              }
          });
      });
  </script>
