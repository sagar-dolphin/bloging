@extends('admin.layouts.app')

@section('title', 'Posts')
@push('yajra_datatable_css_cdn')
    <!-- DataTables -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('admins/bootstrap/css/style.css') }}">
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    
@endpush

@section('main-content')

@section('heading', 'Posts')
@section('data-target', '#addPostModal')

{{-- post's Datatable --}}
<table class="table table-bordered text-center m-5" id="posts-table">
    <span id="postStatusMsg" class="z-2"></span>
    <thead>
        <tr>
            <th>Title</th>
            <th>Subtitle</th>
            <th>Slug</th>
            <th>Description</th>
            <th>Posted_by</th>
            <th>Status</th>
            <th>Image</th>
            <th>Like</th>
            <th>Dislike</th>
            <th>Action</th>
        </tr>
    </thead>
  </table>

  {{-- Add post Modal --}}
  <div class="modal fade" id="addPostModal" tabindex="-1" aria-labelledby="addpostModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title mr-auto" id="addpostModal">Add post</h5>
          <span id="formMsgOnError" class="ml-2"></span>
          <button type="button" class="btn-close btn" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
        <div class="modal-body">
            <form id="addPostForm" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Title <b class="text-danger">*</b></label>
                    <input type="text" class="form-control" name="title" id="title">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Subtitle <b class="text-danger">*</b></label>
                    <input type="text" class="form-control" name="subtitle" id="subtitle">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Slug <b class="text-danger">*</b></label>
                    <input type="text" class="form-control" name="slug" id="slug">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Image</label>
                    <input type="file" name="image" id="image">
                </div>
                <div class="mb-3">
                    <label id="description-msg" for="name" class="form-label">Description <b class="text-danger">*</b></label>
                    <textarea id="summernote" name="description"></textarea>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Status</label><br>
                    <input type="radio" name="status" id="status1"> Enable
                    <input type="radio" name="status" id="status2"> Disable
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="closePostFormBtn" class="btn btn-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-light">Add</button>
            </div>
        </form>
      </div>
    </div>
  </div>

    
@endsection

@push('scripts')
    {{-- Yajra Datatable --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

    <script>

        //description plugin
        $('#summernote').summernote();

        // Request Header
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // function index()
        // {
        //     $("#posts-table").DataTable({
        //         processing: true,
        //         serverSide: true,
        //         ajax: '{{ route('admin.posts.index')}}',
        //         columns: [
        //             // {data: 'id', name: 'id'},
        //             {data: 'name', name: 'name'},
        //             {data: 'slug', name: 'slug'},
        //             {data: 'created_at', name: 'created_at'},
        //             {data: 'updated_at', name: 'updated_at'},
        //             {data: 'action', name: 'action', orderable: false},
        //         ],
        //         order: [[0, 'asc']],
        //         paging: true,
        //         searching: true,
        //         destroy: true
        //     });
        // }
        // index();

        $("#addPostForm").on('submit', function(ev){
            ev.preventDefault();
            var formData = new FormData(this);
            $(this).validate({
                rules: {
                    title: 'required',
                    subtitle: 'required',
                    slug: 'required',
                    description: 'required',
                },

                messages: {
                    title: '<small style="color:red"><b>Title is required!</b></small>',
                    subtitle: '<small style="color:red"><b>Subtitle is required!</b></small>',
                    slug: '<small style="color:red"><b>Slug is required!</b></small>',
                    description: '<small style="color:red"><b>Description is required!</b></small>',
                }
            });
            if($(this).valid() && $(".note-editable > p").text() != ''){
                let description = $(".note-editable > p").text();
                $.ajax({
                    url: '/admin/posts/store',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                    type: 'post', 
                    data: formData, description,
                    contentType: false,
                    processData: false,
                    success: function(response){

                    }
                });
            }else{
                $("#description-msg").append('<small class="text-danger">Description is required!</small>');    
            }
        });

    </script>
@endpush