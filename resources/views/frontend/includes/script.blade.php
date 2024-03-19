<script type="text/javascript" src="{{ asset('frontend/js/jquery.min.js') }}"></script>
{{-- <script type="text/javascript" src="{{ asset('frontend/js/popper.js') }}"></script> --}}
{{-- <script type="text/javascript" src="{{ asset('frontend/js/bootstrap.min.js') }}"></script> --}}
{{-- <script type="text/javascript" src="{{ asset('frontend/js/jquery.mCustomScrollbar.js') }}"></script> --}}
{{-- <script type="text/javascript" src="{{ asset('frontend/lib/slick/slick.min.js') }}"></script> --}}
{{-- <script type="text/javascript" src="{{ asset('frontend/js/scrollbar.js') }}"></script> --}}
{{-- <script type="text/javascript" src="{{ asset('frontend/js/script.js') }}"></script> --}}

{{-- toastr --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" crossorigin="anonymous"
    referrerpolicy="no-referrer"></script> --}}





{{-- toastr --}}
{{-- <script type="text/javascript">
    @if (Session::has('Success'))
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        toastr.info('{{ Session::get('Success') }}');
    @endif
    @if (Session::has('Error'))
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        toastr.error('{{ Session::get('Error') }}');
    @endif
</script> --}}
