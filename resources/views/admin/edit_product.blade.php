@extends('admin.layout')

@section('contentMain')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="form-valide" action="{{ route('admin.updateProduct', [$editProduct->id]) }}"
                                method="POST" novalidate="novalidate" id="form_edit_product" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Tên sản phẩm<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Nhập tên sản phẩm.." value="{{ $editProduct->name }}">
                                        <span class="name_error" style="display: block;color: red;margin-top:10px"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Ảnh sản phẩm <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="file" class="form-control" id="" name="image"
                                            value="{{ $editProduct->image }}">
                                        <img src="{{ asset('upload/product') }}/{{ $editProduct->image }}" alt=""
                                            style="width:100px;height:100px">

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Giá sản phẩm <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="number" class="form-control" id="price" name="price"
                                            placeholder="Nhập giá sản phẩm.." value="{{ $editProduct->price }}">
                                        <span class="price_error" style="display: block;color: red;margin-top:10px"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Giảm giá (%)<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="percent" name="percent"
                                            placeholder="Nhập giảm giá.." value="{{ $editProduct->percent }}">
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
                                            placeholder="Nhập số lượng sản phẩm.." value="{{ $editProduct->qty }}">
                                        <span class="qty_error" style="display: block;color: red;margin-top:10px"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Mô tả sản phẩm <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <textarea class="form-control" id="desc-edit-product" name="desc" rows="8" style="resize:none" type="text"
                                            placeholder="Nhập mô tả sản phẩm ....">{{ $editProduct->desc }}</textarea>
                                        <span class="desc_error" style="display: block;color: red;margin-top:10px"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Nội dung sản phẩm <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <textarea class="form-control" id="content-edit-product" name="content" rows="8" style="resize:none"
                                            type="text" placeholder="Nhập nội dung sản phẩm ....">{{ $editProduct->content }}</textarea>
                                        <span class="content_error"
                                            style="display: block;color: red;margin-top:10px"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-skill">Danh mục sản phẩm <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <select class="form-control" id="val-skill" name="category_id">
                                            <option value="{{ $editProduct->category_id }}">
                                                {{ $editProduct->productCategory->name }}
                                            </option>
                                            @foreach ($cate as $ct)
                                                @if ($editProduct->productCategory->id != $ct->id)
                                                    <option value="{{ $ct->id }}">{{ $ct->name }}</option>
                                                @endif
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
                                            <option value="{{ $editProduct->brand_id }}">
                                                {{ $editProduct->productBrand->name }}
                                            </option>
                                            @foreach ($brand as $bd)
                                                @if ($editProduct->productBrand->id != $bd->id)
                                                    <option value="{{ $bd->id }}">{{ $bd->name }}</option>
                                                @endif
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
                                            @if ($editProduct->status == 1)
                                                <option value="1" selected>Hiển thị</option>
                                                <option value="2">Ẩn</option>
                                            @else
                                                <option value="1">Hiển thị</option>
                                                <option value="2" selected>Ẩn</option>
                                            @endif
                                        </select>
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
        $("#form_edit_product").submit(function(e) {
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
        $("#price").click(function(e) {
            $('.price_error').html('');
        });
        $("#percent").click(function(e) {
            $('.percent_error').html('');
        });
        $("#qty").click(function(e) {
            $('.qty_error').html('');
        });
        $("#desc-edit-product").click(function(e) {
            $('.desc_error').html('');
        });
        $("#content-edit-product").click(function(e) {
            $('.content_error').html('');
        });
    </script>
@endsection
