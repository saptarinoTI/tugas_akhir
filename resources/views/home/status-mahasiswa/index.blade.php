@extends('layouts.apps')
@section('main-content')
<div class="row">
  <div class="col-12">
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <div class="d-flex justify-content-between">
        <h5 class="card-header">Data Lulusan Mahasiswa Teknik Informatika</h5>
      </div>
      <div class="table-responsive text-nowrap">
        <table class="table card-table table-center datatable nowrap" id="mahasiswa-lulusan" style="width: 100%">
          <thead>
            <tr>
              <th>NIM Mhs</th>
              <th>Name Mhs</th>
              <th>Graduation Year</th>
              <th>Status</th>
              <th>Action</th>
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
  /* Script of DataTables */
  $(function() {
    var table = $('#mahasiswa-lulusan').DataTable({
      processing: true
      , serverSide: true
      , responsive: true
      , pageLength: 25
      , lengthMenu: [
        [25, 50, -1]
        , [25, 50, "All"]
      ]
      , order: [
        [3, "desc"]
      ]
      , pagingType: "simple_numbers"
      , ajax: "{{ route('mahasiswa-lulusan.getData') }}"
      , columns: [{
          data: 'nim'
          , name: 'nim'
        }
        , {
          data: 'nama'
          , name: 'nama'
        }
        , {
          data: 'thn_lulus'
          , name: 'thn_lulus'
        }
        , {
          data: 'status'
          , name: 'status'
        }
        , {
          data: 'aksi'
          , name: 'aksi'
        }
      , ]
    });
  });

  $(document).ready(function($) {
    $("#modal").on("show.bs.modal", function(e) {
      var button = $(e.relatedTarget);
      var modal = $(this);
      modal.find(".modal-body").load(button.data("remote"));
      modal.find(".modal-title").html(button.data("title"));
    });
  });

</script>
<div class="modal modal-blur fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>
@endpush
@endsection
