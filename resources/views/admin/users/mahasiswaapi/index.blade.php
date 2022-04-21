@extends('layouts.apps')
@section('main-content')
<div class="row">
  <div class="col-12">
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <div class="d-flex justify-content-between">
        <h5 class="card-header">Mahasiswa From API</h5>
      </div>
      <div class="table-responsive text-nowrap">
        <table class="table card-table table-center datatable nowrap" id="mahasiswa-api" style="width: 100%">
          <thead>
            <tr>
              <th>NIM</th>
              <th>Name</th>
              <th>Birth</th>
              <th>Year</th>
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
  // Script of DataTables
  $(function() {
    var table = $('#mahasiswa-api').DataTable({
      processing: true
      , serverSide: true
      , responsive: true
      , pageLength: 50
      , lengthChange: false
      , order: [
        [3, 'asc']
      ]
      , ajax: "{{ route('mahasiswa-api.getData') }}"
      , columns: [{
          data: 'mhs_no'
          , name: 'mhs_no'
        }
        , {
          data: 'mhs_nama'
          , name: 'mhs_nama'
        }
        , {
          data: 'ttl'
          , name: 'ttl'
        }
        , {
          data: 'ta_id'
          , name: 'ta_id'
        }
      , ]
    });
  });

</script>
@endpush

@endsection
