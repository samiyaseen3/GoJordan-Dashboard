<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Template</title>
</head>
<body>
    {{-- navbar --}}
 @include('source.partials.navbar')

 {{-- sidebar --}}

 @include('source.partials.sidebar')

 {{-- content --}}

 @yield('content')

{{-- footer --}}
 @include('source.partials.footer')

</body>
</html>