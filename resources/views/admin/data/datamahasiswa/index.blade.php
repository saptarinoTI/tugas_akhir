@extends('layouts.apps')
@section('main-content')
<div class="row">
  <div class="col-12">
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <div class="d-flex justify-content-between">
        <h5 class="card-header">Data Mahasiswa</h5>
      </div>
      <div class="table-responsive text-nowrap">
        <table class="table card-table table-center datatable nowrap" id="data-mahasiswa" style="width: 100%">
          <thead>
            <tr>
              <th>NIM</th>
              <th>Name</th>
              <th>Birth</th>
              <th>Telp</th>
              <th>Address</th>
              <th>Submit</th>
              <th>Update</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
          </tbody>
        </table>
      </div>
    </div>
    <!--/ Basic Bootstrap Table -->
  </div>
</div>
@push('after-script')
<script>
  $(function() {
    var table = $('#data-mahasiswa').DataTable({
      processing: true
      , serverSide: true
      , responsive: true
      , pageLength: 25
      , lengthMenu: [
        [25, 50, -1]
        , [25, 50, "All"]
      ]
      , order: [
        [3, "asc"]
      ]
      , ajax: "{{ route('data-mahasiswa.getData') }}"
      , columns: [{
        data: 'nim'
        , name: 'nim'
      }, {
        data: 'nama'
        , name: 'nama'
      }, {
        data: 'ttl'
        , name: 'ttl'
      }, {
        data: 'nohp'
        , name: 'nohp'
      }, {
        data: 'alamat'
        , name: 'alamat'
      }, {
        data: 'tgl_add'
        , name: 'tgl_add'
      }, {
        data: 'tgl_update'
        , name: 'tgl_update'
      }, ]
    });
  });

</script>
@endpush
@endsection
