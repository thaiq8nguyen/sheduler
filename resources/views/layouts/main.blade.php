<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <title>Scheduler</title>
    <meta name = "viewport" content = "width = device-width, initial-scale=1">
    <link rel = "stylesheet" href = "{{ asset('css/bootstrap-flatly-min.css') }}">
    <link rel = "stylesheet" href = "{{ asset('css/bootstrap-datepicker3.css') }}">
    <link rel = "stylesheet" href = "{{ asset('css/font-awesome.css') }}">
    {{--<link rel = "stylesheet" href = "{{ asset('css/custom.css') }}">--}}
    @stack('styles')
</head>
    <body>
        @yield('content')
        <script src = "{{ asset('js/jquery.js') }}"></script>
        <script src = "{{ asset('js/bootstrap.js') }}"></script>
        <script src = "{{ asset('js/moment.js') }}"></script>
        <script src = "{{ asset('js/bootstrap-datepicker.js') }}"></script>
        <script src = "{{ asset('js/main.js') }}"></script>
    </body>
</html>