<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>Laravel-Notes</title>

</head>

<body>

    @yield('content')


    <script src="https://cdn.tiny.cloud/1/k3hpsqyq7bdu9tzvo6bsl0c8zig9qhpzxwntl6lllolbl1is/tinymce/5/tinymce.min.js">
    </script>
    <script>
        tinymce.init({
            selector: '#editor',
            plugins: 'code'
        });
    </script>
    <script src="{{asset('js/OtherComponents/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>    
    <script src="{{asset('js/edit_images.js')}}"></script>
</body>

</html>
