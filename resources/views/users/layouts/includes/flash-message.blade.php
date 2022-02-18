<script>
    @if ($message = Session::get('success'))
        var message = @json($message);
        notify(message, 'fa fa-check  mr-2', 'success');
    @endif
    @if ($message = Session::get('error'))
        var message = @json($message);
        notify(message, 'fa fa-exclamation-triangle mr-2', 'error');
    @endif
    @if ($message = Session::get('warning'))
        var message = @json($message);
        notify(message, 'fa fa-exclamation-triangle mr-2', 'warning');
    @endif
    @if ($message = Session::get('info'))
        var message = @json($message);
        notify(message,'fa fa-check  mr-2',  'primary');
    @endif
    function notification(res, message){
        if(res=='success'){
            notify(message, 'fa fa-check  mr-2', 'success');
        }
        if(res=='error'){
            notify(message, 'fa fa-exclamation-triangle mr-2', 'error');
        }
    }
    function notify(message, icon, type){
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        Toast.fire({
            icon: type,
            title: message
        });
        // $.growl({
        //     icon: icon,
        //     message: message
        // },{
        //     type: type,
        //     allow_dismiss: true,
        //     label: 'Cancel',
        //     className: 'btn-xs btn-inverse',
        //     placement: {
        //         from: 'top',
        //         align: 'right'
        //     },
        //     delay: 8000,
        //     timer: 8000,
        //     animate: {
        //             enter: 'animated fadeInDown',
        //             exit: 'animated fadeOutUp'
        //     },
        //     offset: {
        //         x: 30,
        //         y: 30
        //     },
        //     icon_type: 'class',
        //     template: '<div data-growl="container" class="alert" role="alert">' +
        //     '<button type="button" class="close" data-growl="dismiss">' +
        //     '<span aria-hidden="true">&times;</span>' +
        //     '<span class="sr-only">Close</span>' +
        //     '</button>' +
        //     '<span data-growl="icon"></span>' +
        //     '<span data-growl="title"></span>' +
        //     '<span data-growl="message"></span>' +
        //     '<a href="#" data-growl="url"></a>' +
        //     '</div>'
        // });
    };
</script>
