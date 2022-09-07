@extends('admin.layouts.master')
@section('content')

<div class="col-lg-12">
    <div class="white_box mb_30">
    <div class="row justify-content-center">
    <div class="col-lg-6">

    <div class="modal-content cs_modal">
    <div class="modal-header theme_bg_1 justify-content-center">
    <h5 class="modal-title text_white">Change Password</h5>
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
    <form action="{{ route('admin.change-password')}}" method="post">
    <div class="">
    <input type="password" class="form-control" name="old_password" placeholder="Your old password">
    </div>
    <div class="">
    <input type="password" class="form-control" name="new_password" placeholder="Enter a new password"  >
    </div>
    <div class="">
    <input type="password" class="form-control" name="new_password_confirmation" placeholder="Re-type New Password">
    </div>
    <button  class="btn_1 full_width text-center"> Change</button>
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
    @if (session('success'))
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.28/dist/sweetalert2.all.min.js">
        </script>
        <script>
            $(document).ready(function () {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 1500
                })

            });
        </script>
    @endif

@endsection
