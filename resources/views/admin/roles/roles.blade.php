@extends('admin.layouts.app')

@section('title', 'Role')
@push('yajra_datatable_css_cdn')
    <!-- DataTables -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('admins/bootstrap/css/style.css') }}">
@endpush

@section('main-content')

@section('heading', 'Roles')
@section('data-target', '#addRoleModal')

{{-- Role's Datatable --}}
<table class="table table-bordered text-center m-5" id="roles-table">
    <span id="RoleStatusMsg" class="z-2"></span>
    <thead>
        <tr>
            <th>Name</th>
            <th>Slug</th>
            <th>Action</th>
        </tr>
    </thead>
  </table>

  {{-- Add Role Modal --}}
  <div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addRoleModalTitle">Add Role</h5>
          <span id="formMsgOnError" class="ml-2"></span>
          <button type="button" class="btn-close btn" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
        <div class="modal-body">
            <form id="addRoleForm" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>
                <div class="mb-3">
                  <label for="name" class="form-label">Guard Name</label>
                  <select name="guard" id="guard">

                  </select>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="closeRoleFormBtn" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  {{-- Edit Role Modal --}}
  <button id="editRoleModalBtn" data-target="#editRoleModal" data-toggle="modal"></button>

  <div class="modal fade" id="editRoleModal" tabindex="-1" aria-labelledby="editRole" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editRoleModalTitle">Edit Role</h5>
          <span id="formMsgOnError" class="ml-2"></span>
          <button type="button" class="btn-close btn" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
        <div class="modal-body">
            <form id="editRoleForm" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="hidden" name="cat_id" id="cat_id">
                    <input type="text" class="form-control" name="name" id="editName">
                </div>
                <div class="mb-3">
                  <label for="name" class="form-label">Slug</label>
                  <input type="text" class="form-control" name="slug" id="editSlug">
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="closeRoleEditFormBtn" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
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

    <script>
        // Request Header
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function index()
        {
            // $("#roles-table").DataTable({
            //     processing: true,
            //     serverSide: true,
            //     ajax: '{{ route('admin.roles.index')}}',
            //     columns: [
            //         // {data: 'id', name: 'id'},
            //         {data: 'name', name: 'name'},
            //         {data: 'slug', name: 'slug'},
            //         {data: 'action', name: 'action', orderable: false},
            //     ],
            //     order: [[0, 'asc']],
            //     paging: true,
            //     searching: true,
            //     destroy: true,
            //     columnDefs: [
            //         { width: 100, targets: 2 },
            //     ],
            // });
        }
        index();

        function getGuards 
        {
            var guards = [];
            $.ajax({
                url: '/admin/guards/show',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                type: 'get',
                dataType: 'json',
                success: function(data){

                }
            });
        }

        $("#addRoleForm").on('submit', function(ev){
          ev.preventDefault();
          var formData = new FormData(this);
          $(this).validate({
            rule: {
              name: 'required',
              slug: 'required'
            },

            messages: {
              name: '<small style="color:red;"><d>Name is required!</d></small>',
              slug: '<small style="color:red;"><d>slug is required!</d></small>'
            }
          });

          $.ajax({
            url: '/admin/roles/store',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){
              if(data.success){
                $('#closeRoleFormBtn').click();
                $("#addRoleForm")[0].reset();
                $("#RoleStatusMsg").text(data.title +' '+data.message);
                setTimeout(() => {
                $("#RoleStatusMsg").text(data.title+' '+data.message).show();
                }, 0);
                setTimeout(() => {
                  $("#RoleStatusMsg").fadeOut();
                }, 3000);
                $("#RoleStatusMsg").addClass('alert alert-success');
                index();
              }
            }
          });
        });

        //Edit Role
        $("#roles-table").on('click', '.edit-Role', function(ev){
            ev.preventDefault();
            var id = $(this).data('cat_id');
            $.ajax({
              url: '/admin/roles/edit/'+id,
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
              type: 'get',
              success: function(data){
                  $("#addRoleForm")[0].reset();
                  $("#editName").val(data.name);
                  $("#editSlug").val(data.slug);
                  $("#cat_id").val(data.id);
                  $("#editRoleModalBtn").click();
              }
            });
          });

          $("#editRoleForm").on('submit', function(ev){
            ev.preventDefault();
            var formData = new FormData(this);
          $(this).validate({
            rule: {
              name: 'required',
              slug: 'required'
            },

            messages: {
              name: '<small style="color:red;"><d>Name is required!</d></small>',
              slug: '<small style="color:red;"><d>slug is required!</d></small>'
            }
          });

          $.ajax({
            url: '/admin/roles/update',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){
              if(data.success){
                $('#closeRoleEditFormBtn').click();
                $("#editRoleForm")[0].reset();
                $("#RoleStatusMsg").text(data.title +' '+data.message);
                setTimeout(() => {
                $("#RoleStatusMsg").text(data.title+' '+data.message).show();
                }, 0);
                setTimeout(() => {
                  $("#RoleStatusMsg").fadeOut();
                }, 3000);
                $("#RoleStatusMsg").addClass('alert alert-success');
                index();
              }
            }
          });
          });

          $("#roles-table").on('click', '.removeRole', function(ev){
            ev.preventDefault();
            var id = $(this).data('cat_id');
            console.log(id);
            $.ajax({
              url: '/admin/roles/destroy/'+id,
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
              type: 'get',
              success: function(data){
                if(data.success){
                  setTimeout(() => {
                  $("#RoleStatusMsg").text(data.title+' '+data.message).show();
                  }, 0);
                  setTimeout(() => {
                  $("#RoleStatusMsg").fadeOut();
                  }, 3000);
                  $("#RoleStatusMsg").addClass('alert alert-success');
                  index();
                }
              }
            });
          })
    </script>
@endpush