<div class="box-lightbox">
    <div class="bt-close js-lightbox-close"></div>
    <div class="box-content-login">
        <div class="cd-signup">
            <div class="popup">
                <div class="popup-left">
                    <div class="form">
                        <form action="{{ route('register-action') }}" method="post" id="register-form">
                            @csrf
                            <h2>Create an account!</h2>
                            <span>Please enter your details.</span>

                            <div class="single">
                            <button>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 48 48"><defs><path id="a" d="M44.5 20H24v8.5h11.8C34.7 33.9 30.1 37 24 37c-7.2 0-13-5.8-13-13s5.8-13 13-13c3.1 0 5.9 1.1 8.1 2.9l6.4-6.4C34.6 4.1 29.6 2 24 2 11.8 2 2 11.8 2 24s9.8 22 22 22c11 0 21-8 21-22 0-1.3-.2-2.7-.5-4z"/></defs><clipPath id="b"><use xlink:href="#a" overflow="visible"/></clipPath><path clip-path="url(#b)" fill="#FBBC05" d="M0 37V11l17 13z"/><path clip-path="url(#b)" fill="#EA4335" d="M0 11l17 13 7-6.1L48 14V0H0z"/><path clip-path="url(#b)" fill="#34A853" d="M0 37l30-23 7.9 1L48 0v48H0z"/><path clip-path="url(#b)" fill="#4285F4" d="M48 48L17 24l-4-3 35-10z"/></svg>
                                Sign up with Google
                            </button>
                            </div>
                            <div class="group">
                                <input type="text" name="name" placeholder="name" required>
                                <span class="highlight"></span>

                            </div>
                            <div class="group">
                                <input type="email" name="email" placeholder="Email"required>
                                <span class="highlight"></span>
                            </div>

                            <div class="group">
                                <input type="password"  name="password" placeholder="Password" required>
                                <span class="highlight"></span>
                            </div>

                            <div class="group">
                                <input type="password"  name="password_confirmation"placeholder="Re-type Password" required>
                                <span class="highlight"></span>
                            </div>

                            {{-- <div class="single">
                            <input type="checkbox" id="remember-me">
                            <label for="remember-me">Remember for 30 days</label>
                            </div> --}}
                            <div class="group">
                            <button >Create account</button>
                            </div>
                        </form>

                        <p class="footer">
                            Already have an account?
                            <a href="" target="_blank" id="js-login">
                                Log in
                            </a>
                        </p>

                        </div>
                </div>
                <div class="popup-right">
                    <img src="{{ asset('img/modal2.jpg') }}" alt="">
                </div>

            </div>
        </div>
        <div class="cd-login active">
            <div class="popup">
                <div class="popup-left">
                    <div class="form">
                        <form action="{{ route('login-action') }}" method="post" id="login-form">
                            @csrf
                            <h2>Welcome!</h2>
                            <span>Please enter your details.</span>

                            <div class="single">
                            <button>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 48 48"><defs><path id="a" d="M44.5 20H24v8.5h11.8C34.7 33.9 30.1 37 24 37c-7.2 0-13-5.8-13-13s5.8-13 13-13c3.1 0 5.9 1.1 8.1 2.9l6.4-6.4C34.6 4.1 29.6 2 24 2 11.8 2 2 11.8 2 24s9.8 22 22 22c11 0 21-8 21-22 0-1.3-.2-2.7-.5-4z"/></defs><clipPath id="b"><use xlink:href="#a" overflow="visible"/></clipPath><path clip-path="url(#b)" fill="#FBBC05" d="M0 37V11l17 13z"/><path clip-path="url(#b)" fill="#EA4335" d="M0 11l17 13 7-6.1L48 14V0H0z"/><path clip-path="url(#b)" fill="#34A853" d="M0 37l30-23 7.9 1L48 0v48H0z"/><path clip-path="url(#b)" fill="#4285F4" d="M48 48L17 24l-4-3 35-10z"/></svg>
                                Log in with Google
                            </button>
                            </div>
                            <div class="group">
                            <input type="email" name="email" placeholder="Email" required>
                            <span class="highlight"></span>
                            </div>

                            <div class="group">
                            <input type="password" name="password" placeholder="Password" required>
                            <span class="highlight"></span>
                            </div>

                            {{-- <div class="single">
                            <input type="checkbox" id="remember-me">
                            <label for="remember-me">Remember for 30 days</label>
                            </div> --}}
                            <div class="group">
                            <button >Log in</button>
                            </div>
                        </form>

                        <p class="footer">
                            Don't have an account?
                            <a href="" target="_blank" id="js-register">
                                Sign up for free
                            </a>
                        </p>

                        </div>
                </div>
                <div class="popup-right">
                    <img src="{{ asset('img/modal2.jpg') }}" alt="">
                </div>

            </div>
        </div>
    </div>
</div>

@push('js-front')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.28/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function () {
        $('#register-form').submit(function (e) {
                e.preventDefault();
                $('.textdanger').remove();
                var form = $(this);
                var actionUrl = form.attr('action');
                $.ajax({
                    type: "POST",
                    url: actionUrl,
                    data: form.serialize(),
                    dataType: 'json',
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: "Register Successfully!",
                            text: "Please login!",
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout(function() {
                            $('.textdanger').remove();
                            $('.cd-login').addClass('active');
                            $('.cd-signup').removeClass('active');
                        }, 1700);
                    },
                    error: function (response) {
                        $.each(response.responseJSON.errors,function(field_name,error){
                            $(document).find('[name='+field_name+']').after('<span class="text-strong textdanger">' +error+ '</span><br>')
                        })
                    }
                });
            });
            $('#login-form').submit(function (e) {
                e.preventDefault();
                $('.textdanger').remove();
                var form = $(this);
                var actionUrl = form.attr('action');
                $.ajax({
                    type: "POST",
                    url: actionUrl,
                    data: form.serialize(),
                    dataType: 'json',
                    success: function (response) {
                        document.location.reload(true);
                    },
                    error: function (response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.responseJSON.message,

                        });
                    }
                });
            });
    });
</script>
@endpush
