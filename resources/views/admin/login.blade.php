<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Quixlab</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16"href="{{ asset('admin/images/favicon.png') }}">

    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> -->
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>

<body class="h-100">

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3"
                    stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0" style="box-shadow: 0px 0px 50px 0px #a99de7;">
                            <div class="card-body pt-5">
                                <a class="text-center" href="index.html">
                                    <h4 class="mb-3">Đăng nhập</h4>
                                </a>
                                @if (Session::has('msg'))
                                    <div class="alert alert-danger">{{ Session('msg') }}</div>
                                @endif
                                <div id="show_error"> </div>
                                <form action="{{ route('admin.login') }}" method="POST" id="form_login"
                                    class="login-input">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Email" name="email"
                                            id="email" value="{{ old('email') }}">
                                        <span class="email_error"
                                            style="display: block;color: red;margin-top:10px"></span>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Password"
                                            name="password" id="password">
                                        <span class="password_error"
                                            style="display: block;color: red;margin-top:10px"></span>
                                    </div>

                                    <button type="submit" class="btn login-form__btn submit w-100">Đăng nhập</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!--**********************************
        Scripts
    ***********************************-->
    <script src="{{ asset('admin/plugins/common/common.min.js') }}"></script>
    <script src="{{ asset('admin/js/custom.min.js') }}"></script>
    <script src="{{ asset('admin/js/settings.js') }}"></script>
    <script src="{{ asset('admin/js/gleek.js') }}"></script>
    <script src="{{ asset('admin/js/styleSwitcher.js') }}"></script>
    <script src="{{ asset('admin/js/main.js') }}"></script>

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
                            '{{ route('admin.home') }}'
                        );
                    } else if (data == 2) {
                        $("#show_error").html(
                            '<div class="alert alert-danger">Email hoặc Mật khẩu không đúng vui lòng kiểm tra lại !</div>'
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
