@extends('admin.layouts.app')

@section('title', 'Category')
@push('yajra_datatable_css_cdn')
    <!-- DataTables -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('admins/bootstrap/css/style.css') }}">
@endpush

@section('main-content')

@section('heading', 'Categories')
@section('data-target', '#addCategoryModal')

{{-- Category's Datatable --}}
<table class="table table-bordered text-center m-5" id="categories-table">
    <span id="categoryStatusMsg" class="z-2"></span>
    <thead>
        <tr>
            <th>Name</th>
            <th>Slug</th>
            <th>Action</th>
        </tr>
    </thead>
  </table>

  {{-- Add Category Modal --}}
  <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addCategoryModalTitle">Add Category</h5>
          <span id="formMsgOnError" class="ml-2"></span>
          <button type="button" class="btn-close btn" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
        <div class="modal-body">
            <form id="addCategoryForm" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>
                <div class="mb-3">
                  <label for="name" class="form-label">Slug</label>
                  <input type="text" class="form-control" name="slug" id="slug">
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="closeCategoryFormBtn" class="btn btn-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-light">Add</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  {{-- Edit Category Modal --}}
  <button id="editCategoryModalBtn" data-target="#editCategoryModal" data-toggle="modal"></button>

  <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategory" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editCategoryModalTitle">Edit Category</h5>
          <span id="formMsgOnError" class="ml-2"></span>
          <button type="button" class="btn-close btn" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
        <div class="modal-body">
            <form id="editCategoryForm" method="POST">
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
                <button type="button" id="closeCategoryEditFormBtn" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
            let dataTable = $("#categories-table").DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.categories.index')}}',
                columns: [
                    // {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'slug', name: 'slug'},
                    {data: 'action', name: 'action', orderable: false},
                ],
                order: [[0, 'asc']],
                paging: true,
                searching: true,
                destroy: true,
                columnDefs: [
                    { width: 100, targets: 2 },
                ],
            });
        }
        index();

        $("#addCategoryForm").on('submit', function(ev){
          ev.preventDefault();
          var formData = new FormData(this);
          $(this).validate({
            rules: {
              name: 'required',
              slug: 'required'
            },

            messages: {
              name: '<small style="color:red;"><d>Name is required!</d></small>',
              slug: '<small style="color:red;"><d>slug is required!</d></small>'
            }
          });

          $.ajax({
            url: '/admin/categories/store',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){
              if(data.success){
                $('#closeCategoryFormBtn').click();
                $("#addCategoryForm")[0].reset();
                $("#categoryStatusMsg").text(data.title +' '+data.message);
                setTimeout(() => {
                $("#categoryStatusMsg").text(data.title+' '+data.message).show();
                }, 0);
                setTimeout(() => {
                  $("#categoryStatusMsg").fadeOut();
                }, 3000);
                $("#categoryStatusMsg").addClass('alert alert-success');
                index();
              }
            }
          });
        });

        //Edit Category
        $("#categories-table").on('click', '.edit-category', function(ev){
            ev.preventDefault();
            var id = $(this).data('cat_id');
            $.ajax({
              url: '/admin/categories/edit/'+id,
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
              type: 'get',
              success: function(data){
                  $("#addCategoryForm")[0].reset();
                  $("#editName").val(data.name);
                  $("#editSlug").val(data.slug);
                  $("#cat_id").val(data.id);
                  $("#editCategoryModalBtn").click();
              }
            });
          });

          $("#editCategoryForm").on('submit', function(ev){
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
            url: '/admin/categories/update',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){
              if(data.success){
                $('#closeCategoryEditFormBtn').click();
                $("#editCategoryForm")[0].reset();
                $("#categoryStatusMsg").text(data.title +' '+data.message);
                setTimeout(() => {
                $("#categoryStatusMsg").text(data.title+' '+data.message).show();
                }, 0);
                setTimeout(() => {
                  $("#categoryStatusMsg").fadeOut();
                }, 3000);
                $("#categoryStatusMsg").addClass('alert alert-success');
                index();
              }
            }
          });
          });

          $("#categories-table").on('click', '.removeCategory', function(ev){
            ev.preventDefault();
            var id = $(this).data('cat_id');
            console.log(id);
            $.ajax({
              url: '/admin/categories/destroy/'+id,
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
              type: 'get',
              success: function(data){
                if(data.success){
                  setTimeout(() => {
                  $("#categoryStatusMsg").text(data.title+' '+data.message).show();
                  }, 0);
                  setTimeout(() => {
                  $("#categoryStatusMsg").fadeOut();
                  }, 3000);
                  $("#categoryStatusMsg").addClass('alert alert-success');
                  index();
                }
              }
            });
          })
    </script>
@endpush