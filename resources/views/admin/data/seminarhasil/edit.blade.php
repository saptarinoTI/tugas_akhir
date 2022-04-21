@extends('layouts.apps')
@section('main-content')
<div class="row">
  <div class="col-xl">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Update Data Seminar Hasil Tugas Akhir</h5>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('data-seminar.update', $seminar->id) }}">
          @csrf
          @method('put')
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">NIM Mahasiswa</label>
                <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" id="nim" value="{{ $seminar->mahasiswa->nim }}" readonly />
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
                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ ucwords($seminar->mahasiswa->nama) }}" readonly />
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
            <select type="text" class="form-select @error('status') is-invalid @enderror" placeholder="Select a date" id="status" name="status">
              <option>Pilih Status ...</option>
              <option value="diterima">Diterima</option>
              <option value="ditolak">Ditolak</option>
            </select>
            @error('status')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="mb-3" id="keterangan">
            <label class="form-label">Keterangan</label>
            <textarea class="form-control @error('keterangan') is-invalid @enderror" rows="3" name="keterangan" autocomplete="off"></textarea>
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
              Save
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@push('after-script')
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
@endpush
@endsection
