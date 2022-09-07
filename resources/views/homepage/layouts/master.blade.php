<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/reponsive.css') }}">
    <title>Pirots | Phonghaw2</title>
</head>
<body>
    @include('homepage.layouts.header')
    @include('homepage.layouts.modal')
    <div id="container">
        @yield('content')
    </div>
    @include('homepage.layouts.footer')

    @stack('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#modal-trigger').click(function () {
                event.preventDefault();
                $('.box-lightbox').addClass('open');
            })
            $('#js-login').click(function (event) {
                event.preventDefault();
                $('.cd-login').addClass('active');
                $('.cd-signup').removeClass('active');
            })
            $('#js-register').click(function (event) {
                event.preventDefault();
                $('.cd-signup').addClass('active');
                $('.cd-login').removeClass('active');
            })
            $('.js-lightbox-close').click(function () {
                $('.box-lightbox').removeClass('open');
            })

        });
    </script>
</body>
</html>
