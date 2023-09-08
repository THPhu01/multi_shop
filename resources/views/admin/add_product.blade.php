@extends('admin.layout')

@section('contentMain')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="form-valide" action="{{ route('admin.addProduct') }}" method="POST"
                                novalidate="novalidate" id="form_add_product" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Tên sản phẩm<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Nhập tên sản phẩm.." value="">
                                        <span class="name_error" style="display: block;color: red;margin-top:10px"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Ảnh sản phẩm <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="file" class="form-control" id="image" name="image"
                                            value="">
                                        <span class="image_error" style="display: block;color: red;margin-top:10px"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Giá sản phẩm <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="number" class="form-control" id="price" name="price"
                                            placeholder="Nhập giá sản phẩm.." value="">
                                        <span class="price_error" style="display: block;color: red;margin-top:10px"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Giảm giá (%) (Nhập từ 0 đến
                                        100)<span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="number" class="form-control" id="percent" name="percent"
                                            placeholder="Nhập giảm giá.." value="">
                                        <span class="percent_error"
                                            style="display: block;color: red;margin-top:10px"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Số lượng sản phẩm <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="number" class="form-control" id="qty" name="qty"
                                            placeholder="Nhập số lượng sản phẩm.." value="">
                                        <span class="qty_error" style="display: block;color: red;margin-top:10px"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Mô tả sản phẩm <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <textarea class="form-control" id="desc-add-product" name="desc" rows="8" style="resize:none" type="text"
                                            placeholder="Nhập mô tả sản phẩm ...."></textarea>
                                        <span class="desc_error" style="display: block;color: red;margin-top:10px"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Nội dung sản phẩm <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <textarea class="form-control" id="content-add-product" name="content" rows="8" style="resize:none"
                                            type="text" placeholder="Nhập nội dung sản phẩm ...."></textarea>
                                        <span class="content_error"
                                            style="display: block;color: red;margin-top:10px"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-skill">Danh mục sản phẩm <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <select class="form-control phu-kien category_id" id="category_id"
                                            name="category_id">
                                            <option value=""> -- Chọn danh mục --</option>
                                            @foreach ($category as $cate)
                                                <option value="{{ $cate->id }}">
                                                    {{ $cate->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-skill">Thương hiệu sản phẩm <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <select class="form-control" id="val-skill" name="brand_id">
                                            <option value=""> -- Chọn thương hiệu --</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-skill">Trạng thái <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <select class="form-control" id="val-skill" name="status">
                                            <option value="1">Hiển thị</option>
                                            <option value="2">Ẩn</option>
                                        </select>
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
        $("#form_add_product").submit(function(e) {
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
                            '{{ route('admin.listProduct') }}'
                        );
                    }
                }
            });

        });
        $("#name").click(function(e) {
            $('.name_error').html('');
        });
        $("#image").click(function(e) {
            $('.image_error').html('');
        });
        $("#price").click(function(e) {
            $('.price_error').html('');
        });
        $("#qty").click(function(e) {
            $('.qty_error').html('');
        });
        $("#percent").click(function(e) {
            $('.percent_error').html('');
        });
        $("#desc-add-product").click(function(e) {
            $('.desc_error').html('');
        });
        $("#content-add-product").click(function(e) {
            $('.content_error').html('');
        });
    </script>
@endsection
