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
@section('data-target', '#addUserModal')

  {{-- User's Datatable --}}
  <table class="table table-bordered text-center m-5" id="users-table">
    <span id="userStatusMsg" class="z-2"></span>
    <thead>
        <tr>
            {{-- <th>Id</th> --}}
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
          <span id="formMsgOnError" class="ml-2"></span>
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
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="mb-3 form-check">
                  <input type="checkbox" class="form-check-input" name="check_me_out" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="closeUserFormBtn" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>
      </div>
    </div>
  </div>


  {{-- Edit User Modal --}}
  <button class="" data-target="#editUserModal" data-toggle="modal" id="editUserModalBtn"></button>

  <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="">Edit User</h5>
          <span id="editFormMsgOnError" class="ml-2"></span>
          <button type="button" class="btn-close btn" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
        <div class="modal-body">
            <form id="editUserForm" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="hidden" id="user_id" name="user_id">
                    <input type="text" class="form-control" name="name" id="editName">
                  </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" name="email" id="editEmail" aria-describedby="emailHelp">
                </div>
                {{-- <div class="mb-3">
                  <label for="password" class="form-label">New Password</label> 
                  <input type="password" class="form-control" name="password" id="NewPassword">
                </div> --}}
            </div>
            <div class="modal-footer">
                <button type="button" id="closeUserEditFormBtn" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
      </div>
    </div>
  </div>

@endsection

@push('scripts')

    {{-- Yajra Datatable --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
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

            //Show Users to Admin
            function index()
            {
                $('#users-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('admin.users.index')}}',
                    columns: [
                        // {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'email', name: 'email'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'updated_at', name: 'updated_at'},
                        {data: 'action', name: 'action', orderable: false},
                    ],
                    order: [[0, 'asc']],
                    paging: true,
                    searching: true,
                    destroy: true
                });
            }
            index();

            //Create New User
            $("#addUserForm").on('submit', function(ev){
                ev.preventDefault();
                $(this).validate({
                  rules: {
                    name: "required",
                    email: {
                      required: true,
                      email: true
                    },
                    password: {
                      required: true,
                      minlength: 8
                    },
                  },

                  // Specify validation error messages
                  messages: {
                    name: "<small style='color:red;'><b>Name is required!</b></small>",
                    password: {
                      required: "<small style='color:red;'><b>Password is required!</b></small>",
                      minlength: "<small style='color:red;'><b>Password must be at least 8 characters long!</b></small>"
                    },
                    email: {
                        required : "<small style='color:red;'><b>Email is required!</b></small>",
                        email : "<small style='color:red;'><b>Invalid email!</b></small>",
                    },
                  },
                });
                if($("#addUserForm").valid()){
                  // var form = $("#addUserForm")[0];
                  var formData = new FormData(this);
                  console.log(formData);
                  $.ajax({
                      url: '/admin/users/store',
                      headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                      type: 'post',
                      data: formData,
                      contentType: false,
                      processData: false,
                      success: function(data){
                        console.log(data);
                        if(data.success){
                          $("#closeUserFormBtn").click();
                          $("#addUserForm")[0].reset();
                          $("#userStatusMsg").text(data.message);
                          setTimeout(() => {
                            $("#userStatusMsg").fadeOut();
                          }, 3000);
                          $("#userStatusMsg").addClass('alert alert-success');
                          index();
                        }else{
                          $("#addUserForm")[0].reset();
                          $("#formMsgOnError").addClass('alert alert-danger');
                          $("#formMsgOnError").text('Something went wrong, try again!');
                        }
                      },
                      error: function(error){
                        console.log(error);
                      }
                  });
                }
            });

            //Edit User
            $("#users-table").on('click', '.user', function(ev){
              ev.preventDefault();
              var id = $(this).data('id');
              $.ajax({
                url: '/admin/users/edit/'+id,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                type: 'get',
                success: function(data){
                  console.log(data);
                  $("#user_id").val(data.id);
                  $("#editName").val(data.name);
                  $("#editEmail").val(data.email);
                  $("#editUserModalBtn").click();
                }
              });
            });

            //Update User
            $("#editUserForm").on('submit', function(ev){
                ev.preventDefault();
                $(this).validate({
                  rules: {
                    editName: "required",
                    editEmail: {
                      required: true,
                      email: true
                    },
                    NewPassword: {
                      required: true,
                      minlength: 8
                    },
                  },

                  // Specify validation error messages
                  messages: {
                    editName: "<small style='color:red;'><b>Name is required!</b></small>",
                    NewPassword: {
                      required: "<small style='color:red;'><b>Password is required!</b></small>",
                      minlength: "<small style='color:red;'><b>Password must be at least 8 characters long!</b></small>"
                    },
                    editEmail: {
                        required : "<small style='color:red;'><b>Email is required!</b></small>",
                        email : "<small style='color:red;'><b>Invalid email!</b></small>",
                    },
                  },
                });
                if($("#editUserForm").valid()){
                  // var form = $("#addUserForm")[0];
                  var formData = new FormData(this);
                  console.log(formData);
                  $.ajax({
                      url: '/admin/users/update',
                      headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                      type: 'post',
                      data: formData,
                      contentType: false,
                      processData: false,
                      success: function(data){
                        console.log(data);
                        if(data.success){
                          $("#closeUserEditFormBtn").click();
                          $("#editUserForm")[0].reset();
                          // $("#userStatusMsg").text(data.message);
                          setTimeout(() => {
                            $("#userStatusMsg").text(data.title+' '+data.message).show();
                          }, 0);
                          setTimeout(() => {
                            $("#userStatusMsg").fadeOut();
                          }, 3000);
                          $("#userStatusMsg").addClass('alert alert-success');
                          index();
                        }else{
                          
                        }
                      },
                  });
                }
            });

            //Destroy User
            $("#users-table").on('click', '.removeUser', function(ev){
              ev.preventDefault();
              var id = $(this).data('id');
              $.ajax({
                url: '/admin/users/destroy/'+id,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                type: 'get',
                success: function(data){
                  if(data.success){
                    setTimeout(() => {
                      $("#userStatusMsg").text(data.title+' '+data.message).show();
                    }, 0);
                    setTimeout(() => {
                      $("#userStatusMsg").fadeOut();
                    }, 3000);
                    $("#userStatusMsg").addClass('alert alert-danger');
                    index();
                  }
                }
              });
            });
        });
    </script>
@endpush

