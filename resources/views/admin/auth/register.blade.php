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
    <div class="col-lg-12">
        <div class="white_box mb_30">
        <div class="row justify-content-center">
        <div class="col-lg-6">

        <div class="modal-content cs_modal">
        <div class="modal-header theme_bg_1 justify-content-center">
        <h5 class="modal-title text_white">Resister</h5>
        </div>
        <div class="modal-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <form action="{{ route('admin.register-action')}}" method="post">
        <div class="">
        <input type="text" class="form-control" name="name" placeholder="Full Name" value="{{ old('name')}}">
        </div>
        <div class="">
        <input type="text" class="form-control" name="email" placeholder="Enter your email" value="{{ old('email')}}" >
        </div>
        <div class="">
        <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <div class=" cs_check_box">
        <input type="checkbox" id="check_box" class="common_checkbox">
        <label class="form-label" for="check_box">
        Keep me up to date
        </label>
        </div>
        <button  class="btn_1 full_width text-center"> Sign Up</button>
        <p>Need an account? <a data-bs-toggle="modal" data-bs-target="#sing_up" data-bs-dismiss="modal" href="{{ route('admin.login') }}">Log in</a></p>
        <div class="text-center">
        <a href="#" data-bs-toggle="modal" data-bs-target="#forgot_password" data-bs-dismiss="modal" class="pass_forget_btn">Forget Password?</a>
        </div>
        </form>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
</body>

</html>
