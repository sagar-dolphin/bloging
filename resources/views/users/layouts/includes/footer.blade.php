<!-- jQuery -->
<script src="{{ asset('/backend/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('/backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- bs-custom-file-input -->
<script src="{{ asset('/backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/backend/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('/backend/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<!-- Page specific script -->

<script src="{{ asset('/backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/backend/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

<script src="{{ asset('/backend/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/backend/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('/backend/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('/backend/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('/backend/plugins/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('/backend/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('/backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
{{-- <script src="https://cdn.socket.io/4.2.0/socket.io.min.js"
integrity="sha384-PiBR5S00EtOj2Lto9Uu81cmoyZqR57XcOna1oAuVuIEjzj0wpqDVfD0JA9eXlRsj" crossorigin="anonymous">
</script> --}}
{{-- <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.js"></script>
<script>
    $(function() {
        bsCustomFileInput.init();
    });
</script>

@include('admin.layouts.includes.flash-message')
@include('admin.layouts.includes.functions')
