<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="author" content="Admin">
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <title>Pirots | Admin </title>
    @stack('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" >
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.24/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap1.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}" >
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body class="crm_body_bg">
    @include('admin.layouts.sidebar')
    <section class="main_content dashboard_part large_header_bg">
        @include('admin.layouts.header')
        <div class="main_content_iner overly_inner">

                @yield('content')

        </div>
    </section>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/admin.js') }}"></script>

    @stack('js')
</body>

</html>

