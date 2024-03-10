<script src="{{ asset('/frontend/') }}/assets/js/jquery.min.js"></script>
<script src="{{ asset('/frontend/') }}/assets/js/plugins.min.js"></script>
<script src="{{ asset('/frontend/') }}/assets/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('/frontend/') }}/assets/js/jquery.appear.min.js"></script>
<script src="{{ asset('/frontend/') }}/assets/js/jquery.plugin.min.js"></script>
<script src="{{ asset('/frontend/') }}/assets/js/jquery.countdown.min.js"></script>

{{-- toastr --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Main JS File -->
<script src="{{ asset('/frontend/') }}/assets/js/main.min.js"></script>




    {{-- toastr --}}
    <script type="text/javascript">    
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
       toastr.info('{{Session::get('Success')}}');
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
       toastr.error('{{Session::get('Error')}}');
    @endif
    </script>




<script type="text/javascript">
function googleTranslateElementInit() {

  new google.translate.TranslateElement({
    pageLanguage: 'en',
    includedLanguages: 'en,my',
}, 'google_translate_element');
  console.log('google translate loaded');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>




<style>
  .translated-ltr{margin-top:-40px;}
  .translated-ltr{margin-top:-40px;}
  .goog-te-banner-frame {display: none;margin-top:-20px;}

  .goog-logo-link {
     display:none !important;
  } 

  .goog-te-gadget{
     color: transparent !important;
  }

  #google_translate_element{
    display: none;
  }

</style>
