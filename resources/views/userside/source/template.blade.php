<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets_userside/images/logo.png') }}">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets_userside/images/logo.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>GoJordan</title>
</head>
<body>
    {{-- navbar --}}
 @include('userside.source.partials.navbar')



 {{-- content --}}

 @yield('content')

{{-- footer --}}
 @include('userside.source.partials.footer')



</body>
</html>