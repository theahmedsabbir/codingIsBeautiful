<link rel="icon" type="image/x-icon" href="{{ asset('/frontend/') }}/assets/images/icons/favicon.png">
<script>
    WebFontConfig = {
        google: {
            families: ['Open+Sans:300,400,600,700', 'Poppins:300,400,500,600,700,800', 'Oswald:300,400,500,600,700,800', 'Playfair+Display:900', 'Shadows+Into+Light:400']
        }
    };
    (function(d) {
        var wf = d.createElement('script'),
            s = d.scripts[0];
        wf.src = '{{ asset('frontend/assets/js/webfont.js') }}';
        wf.async = true;
        s.parentNode.insertBefore(wf, s);
    })(document);
</script>

<!-- Plugins CSS File -->
<link rel="stylesheet" href="{{ asset('/frontend/') }}/assets/css/bootstrap.min.css">

<!-- Main CSS File -->

<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/') }}/assets/css/style.min.css">
<link rel="stylesheet" href="{{ asset('/frontend/') }}/assets/css/demo1.min.css">


<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/') }}/assets/vendor/fontawesome-free/css/all.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/') }}/assets/vendor/simple-line-icons/css/simple-line-icons.min.css">

{{-- toastr --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

