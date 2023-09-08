@extends('admin.layout')

@section('contentMain')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="form-valide" action="{{ route('admin.addRole') }}" method="POST"
                                novalidate="novalidate" id="form_add_role">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Tên vai trò<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Nhập tên vai trò.." value="">
                                        <span class="name_error" style="display: block;color: red;margin-top:10px"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Mô tả vai trò<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="desc" name="desc"
                                            placeholder="Nhập mô tả vai trò.." value="">
                                        <span class="desc_error" style="display: block;color: red;margin-top:10px"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $("#form_add_role").submit(function(e) {
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
                            '{{ route('admin.listRole') }}'
                        );
                    }
                }
            });

        });
        $("#name").click(function(e) {
            $('.name_error').html('');
        });
        $("#desc").click(function(e) {
            $('.desc_error').html('');
        });
    </script>
@endsection
