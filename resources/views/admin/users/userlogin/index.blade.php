@extends('layouts.apps')
@section('main-content')
<div class="row">
  <div class="col-12">
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <div class="d-flex justify-content-between">
        <h5 class="card-header">Data Users</h5>
        <h5 class="card-header">
          <a href="{{ route('user-login.create') }}" class="btn btn-sm btn-primary">Tambah Data</a>
        </h5>
      </div>
      <div class="table-responsive text-nowrap">
        <table class="table card-table table-center datatable nowrap" id="user-login" style="width: 100%">
          <thead>
            <tr>
              <th>Username</th>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
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
  // button destroy
  $('#user-login').on('click', '.btn-delete', function(e) {
    e.preventDefault();
    var me = $(this)
      , url = me.attr('href')
      , csrf_token = $('meta[name="csrf-token"]').attr('content');
    swal({
        title: "Hapus Data ?"
        , icon: "warning"
        , buttons: true
        , dangerMode: true
      , })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            type: "POST"
            , url: url
            , data: {
              '_method': 'DELETE'
              , '_token': csrf_token
            }
            , success: function(response) {
              $('#user-login').DataTable().ajax.reload();
              swal({
                text: "Data berhasil dihapus!"
                , icon: "success"
              , });
            }
          });
        }
      });
  });

  // Script of DataTables
  $(function() {
    var table = $('#user-login').DataTable({
      processing: true
      , serverSide: true
      , responsive: true
      , pageLength: 50
      , lengthMenu: [
        [50, -1]
        , [50, "All"]
      ]
      , pagingType: "first_last_numbers", // lengthChange: false,
      order: [
        [0, "asc"]
      ]
      , ajax: "{{ route('user-login.getdata') }}"
      , columns: [{
          data: 'id'
          , name: 'id'
        }
        , {
          data: 'name'
          , name: 'name'
        }
        , {
          data: 'email'
          , name: 'email'
        }, {
          data: 'role'
          , name: 'role'
        }, {
          data: 'btn'
          , name: 'btn'
        }
      , ]
    });
  });

</script>
@endpush
@endsection
