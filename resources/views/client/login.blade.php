@extends('client.layout')

@section('contentMain')

    <body>
        <section class="container forms">
            <div class="form login" style="display: block;">
                <div class="form-content">
                    <header style="margin-bottom:10px">Đăng nhập</header>
                    @if (Session::has('msg'))
                        <span id="message_active" class="message_active">{{ Session('msg') }}</span>
                    @endif
                    <div id="show_error"> </div>
                    <form action="{{ route('client.login') }}" method="POST" style="margin-top:0px" id="form_login">
                        @csrf
                        <div class="field input-field">
                            <input type="email" placeholder="Email" class="input" id="email" name="email"
                                value="{{ old('email') }}">
                            <span class="email_error"
                                style="display: block;color: red;margin-top:5px;font-size:14px"></span>
                        </div>
                        <div class="field input-field" style="margin-top: 30px;">
                            <input type="password" placeholder="Password" id="password" class="password" name="password">
                            <i class='bx bx-hide eye-icon'></i>
                            <span class="password_error"
                                style="display: block;color: red;margin-top:5px;font-size:14px"></span>
                        </div>

                        <div class="form-link" style="margin-top: 30px;">
                            <a href="#" class="forgot-pass">Quên password?</a>
                        </div>

                        <div class="field button-field">
                            <button>Đăng nhập</button>
                        </div>
                    </form>

                    <div class="form-link">
                        <span>Chưa có tài khoản? <a href="{{ route('client.viewRegister') }}" >Đăng
                                kí</a></span>
                    </div>
                </div>
            </div>

            <!-- Signup Form -->
        </section>

        <!-- JavaScript -->
        <script src="{{ asset('client/js/script.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <script>
            $("#form_login").submit(function(e) {
                e.preventDefault();

                var all = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'),
                    type: "POST",
                    data: all,
                    success: function(data) {
                        if (data.status == 0) {
                            $.each(data.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                            });
                        }
                        if (data == 1) {
                            window.location.replace(
                                '{{ route('client.home') }}'
                            );
                        } else if (data == 2) {
                            $("#show_error").html(
                                ' <span id="message_active" class="message_active">Email hoặc Mật khẩu không đúng vui lòng kiểm tra lại!</span>'

                            );

                        }

                    }
                });

            });
            $("#email").click(function(e) {
                $('.email_error').html('');
                $('#show_error').html('');
            });
            $("#password").click(function(e) {
                $('.password_error').html('');
                $('#show_error').html('');
            });
        </script>
    </body>

    </html>
@endsection
