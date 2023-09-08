@extends('client.layout')

@section('contentMain')
    <div class="container-fluid mb-3">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <form action="{{ route('client.myAccount.upInfo', [Auth::user()->id]) }}" method="POST" id="form_edit_user"
                    style="margin-top: 0">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="text" readonly="readonly" class="form-control-plaintext"
                                value="{{ Auth::user()->email }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" id="name" name="name" class="form-control"
                                value="{{ Auth::user()->name }}">
                            <span class="name_error" style="display: block;color: red;margin-top:10px"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Điện thoại</label>
                        <div class="col-sm-9">
                            <input type="number" id="phone" name="phone" class="form-control"
                                value="{{ Auth::user()->phone }}">
                            <span class="phone_error" style="display: block;color: red;margin-top:10px"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Mật khẩu cũ</label>
                        <div class="col-sm-9">
                            <input type="password" id="password_old" name="password_old" class="form-control"
                                placeholder="Password">
                            <span class="password_old_error" style="display: block;color: red;margin-top:10px"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Mật khẩu mới</label>
                        <div class="col-sm-9">
                            <input type="password" id="password_new" name="password_new" class="form-control"
                                placeholder="Password">
                            <span class="password_new_error" style="display: block;color: red;margin-top:10px"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nhập lại mật khẩu mới</label>
                        <div class="col-sm-9">
                            <input type="password" id="password_confirm" name="password_confirm" class="form-control"
                                placeholder="Password">
                            <span class="password_confirm_error" style="display: block;color: red;margin-top:10px"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-dark mb-2">Thay đổi</button>

                        </div>
                </form>
            </div>

        </div>

    </div>
    </div>

    <script>
        $("#form_edit_user").submit(function(e) {
            e.preventDefault();

            var form = this;

            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function(data) {
                    if (data.status == 0) {

                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });

                    }

                    if (data == 1) {
                        window.location.replace(
                            '{{ route('client.my.account') }}'
                        );
                    }
                    if (data.password_old) {
                        $('.password_old_error').text(data.password_old);
                    }
                }
            });

        });
        $("#name").click(function(e) {
            $('.name_error').html('');
        });
        $("#phone").click(function(e) {
            $('.phone_error').html('');
        });
        $("#password_old").click(function(e) {
            $('.password_old_error').html('');
        });
        $("#password_new").click(function(e) {
            $('.password_new_error').html('');
        });
        $("#password_confirm").click(function(e) {
            $('.password_confirm_error').html('');
        });
    </script>
@endsection
