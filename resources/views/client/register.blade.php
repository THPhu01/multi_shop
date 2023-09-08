@extends('client.layout')

@section('contentMain')
    <section class="container-register forms">
        <div class="form signup" style="display: block;">
            <div class="form-content">
                <header>Đăng kí</header>
                <form action="{{ route('client.register') }}" method="POST" id="form_register">
                    @csrf
                    <div class="field input-field">
                        <input type="text" name="name" id="name" placeholder="Họ và tên" class="input"
                            value="{{ old('name') }}">
                        <span class="name_error" style="display: block;color: red;margin-top:5px;font-size:14px"></span>
                    </div>

                    <div class="field input-field" style="margin-top: 30px;">
                        <input type="email" name="email" id="email" placeholder="Email" class="input"
                            value="{{ old('email') }}">
                        <span class="email_error" style="display: block;color: red;margin-top:5px;font-size:14px"></span>
                    </div>

                    <div class="field input-field" style="margin-top: 30px;">
                        <input type="number" name="phone" id="phone" placeholder="Điện thoại" class="input"
                            value="{{ old('phone') }}">
                        <span class="phone_error" style="display: block;color: red;margin-top:5px;font-size:14px"></span>
                    </div>

                    <div class="field input-field" style="margin-top: 30px;">
                        <input type="password" name="password" id="password" placeholder="Nhập mật khẩu" class="password">
                        <i class='bx bx-hide eye-icon'></i>

                        <span class="password_error" style="display: block;color: red;margin-top:5px;font-size:14px"></span>
                    </div>
                    <div class="field button-field" style="margin-top: 30px;">
                        <button>Đăng kí</button>
                    </div>
                </form>

                <div class="form-link">
                    <span>Có sẵn tài khoản? <a href="{{ route('client.viewLogin') }}"
                           >Login</a></span>
                </div>
            </div>

        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script>
        $("#form_register").submit(function(e) {
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
                            '{{ route('client.viewLogin') }}'
                        );
                    }

                }
            });

        });
        $("#name").click(function(e) {
            $('.name_error').html('');
        });
        $("#email").click(function(e) {
            $('.email_error').html('');
        });
        $("#phone").click(function(e) {
            $('.phone_error').html('');
        });
        $("#password").click(function(e) {
            $('.password_error').html('');
        });
    </script>
@endsection
