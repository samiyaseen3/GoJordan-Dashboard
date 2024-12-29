<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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

 @include('userside.source.partials.chat')

</body>
</html>