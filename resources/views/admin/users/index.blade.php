@extends('admin.layouts.app')

@section('title', 'Users')
@push('yajra_datatable_css_cdn')
    <!-- DataTables -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('admins/bootstrap/css/style.css') }}">
@endpush
@section('main-content')

<!-- Content Header (Page header) -->
@section('heading', 'Users')

  {{-- User's Datatable --}}
  <table class="table table-bordered text-center m-5" id="users-table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Action</th>
        </tr>
    </thead>
  </table>

  {{-- Add User Modal --}}
  <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addUserModal">Add User</h5>
          <button type="button" class="btn-close btn" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
        <div class="modal-body">
            <form id="addUserForm" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name">
                  </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                  <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Password</label>
                  <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                </div>
                <div class="mb-3 form-check">
                  <input type="checkbox" class="form-check-input" name="check_me_out" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>
      </div>
    </div>
  </div>

@endsection

@push('scripts')

    {{-- Yajra Datatable --}}
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

    {{-- Custom script --}}
    <script>

        // Request Header
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function(){
            function index()
            {
                $('#users-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('admin.users.index')}}',
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'email', name: 'email'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'updated_at', name: 'updated_at'},
                        {data: 'action', name: 'action', orderable: false},
                    ],
                    order: [[0, 'asc']]
                });
            }
            index();

            $("#addUserForm").on('submit', function(event){
                event.preventDefault();
                var form = $("#addUserForm")[0];
                var formData = new FormData(form);
                $.ajax({
                    url: '/admin/users/store',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data){

                    }
                })
            });
        });
    </script>
@endpush

