@extends('admin.layout')

@section('contentMain')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="form-valide" action="{{ route('admin.updateCategory', [$editCategory->id]) }}"
                                method="POST" id="form_edit_category" novalidate="novalidate">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Tên danh mục <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Nhập tên danh mục.." value="{{ $editCategory->name }}">
                                        <span class="name_error" style="display: block;color: red;margin-top:10px"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" class="btn btn-primary">Cập nhật</button>
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
        $("#form_edit_category").submit(function(e) {
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
                            '{{ route('admin.listCategory') }}'
                        );
                    }
                }
            });

        });
        $("#name").click(function(e) {
            $('.name_error').html('');
        });
    </script>
@endsection
