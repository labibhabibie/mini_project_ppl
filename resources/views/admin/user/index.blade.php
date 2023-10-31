@extends('layout.backend.app',[
'title' => 'Manage User',
'pageTitle' =>'Manage User',
])

@push('css')
<link href="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')

@if(session()->get('message'))

  @php 
   $status = session()->get('message')['status'];
   $message = session()->get('message')['message'];
  @endphp
  
  @push('js')
  <script>
    $(document).ready(function () {
      console.log()
      showToastr((`{{ $status }}` === 'true'), `{{ $message }}`)
    })
  </script>
  @endpush
@endif

<div class="card">
  <div class="card-header">

    <a href="{{ route('user.create') }}" class="btn btn-md btn-success mb-3 float-right">Tambah Data</a>

  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered data-table">
        <thead>
          <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
</div>


<!-- Destroy Modal -->
<div class="modal fade" id="destroy-modal" tabindex="-1" role="dialog" aria-labelledby="destroy-modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="destroy-modalLabel">Yakin Hapus ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger btn-destroy">Hapus</button>
      </div>
    </div>
  </div>
</div>
<!-- Destroy Modal -->

@stop

@push('js')
<script src="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('template/backend/sb-admin-2') }}/js/demo/datatables-demo.js"></script>

<script type="text/javascript">
  $(function() {

    var table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('user.index') }}",
      columns: [{
          data: 'DT_RowIndex',
          name: 'id'
        },
        {
          data: 'name',
          name: 'name'
        },
        {
          data: 'email',
          name: 'email'
        },
        {
          data: 'role',
          name: 'role'
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: true
        },
      ]
    });
  });


  $('body').on("click", ".btn-delete", function() {
    var id = $(this).attr("id")
    $(".btn-destroy").attr("id", id)
    $("#destroy-modal").modal("show")
  });

  $(".btn-destroy").on("click", function() {
    var id = $(this).attr("id")

    $.ajax({
      url: "/admin/user/" + id,
      method: "DELETE",
      success: function() {
        $("#destroy-modal").modal("hide")
        $('.data-table').DataTable().ajax.reload();
        flash('success', 'Data berhasil dihapus')
      },
      error : function(xhr, status, error) {
        
      }
    });
  })

  function flash(type, message) {
    $(".notify").html(`<div class="alert alert-` + type + ` alert-dismissible fade show" role="alert">
                              ` + message + `
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>`)
  }
</script>
@endpush