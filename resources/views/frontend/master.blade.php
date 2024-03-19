<!DOCTYPE html>
<html>


<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Coding Is Beautiful')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <link rel="icon" type="image/x-icon" href="{{ asset('/frontend/') }}/images/favicon.png">

    {{-- css --}}
    @include('frontend.includes.style')

    @stack('page-css')
</head>

<body>

    @yield('content')


    {{-- scripts --}}
    @include('frontend.includes.script')
    @stack('page-js')

</body>


</html>
