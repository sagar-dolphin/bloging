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
    <span id="roleStatusMsg" class="z-2"></span>
    <thead>
        <tr>
            <th>Name</th>
            <th>Guard Name</th>
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
              <div class="modal-footer">
                  <button type="button" id="closeRoleFormBtn" class="btn btn-light" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-light">Add</button>
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
          $("#roles-table").DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.roles.index')}}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'guard_name', name: 'guard_name'},
                ],
                order: [[0, 'asc']],
                paging: true,
                searching: true,
                destroy: true,
            });
        }
        index();
        
        $("#addRoleForm").on('submit', function(ev){
          ev.preventDefault();
          var formData = new FormData(this);
          $(this).validate({
            rules: {
              name: 'required',
            }
          });
          if($(this).valid()){
            console.log('valid');
          }
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
                $("#roleStatusMsg").text(data.title +' '+data.message);
                setTimeout(() => {
                $("#roleStatusMsg").text(data.title+' '+data.message).show();
                }, 0);
                setTimeout(() => {
                  $("#roleStatusMsg").fadeOut();
                }, 3000);
                $("#roleStatusMsg").addClass('alert alert-success');
                index();
              }
            } 
          });
        });

        
    </script>
@endpush