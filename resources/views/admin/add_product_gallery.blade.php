@extends('admin.layout')

@section('contentMain')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">

                <form action="{{ route('admin.addGallery', [$product_id]) }}" method="POST" enctype="multipart/form-data"
                    class="form-inline" style="margin: 20px 0;">
                    @csrf
                    <div class="form-group mx-sm-3
                    mb-2">
                        <input type="file" class="form-control" id="image" name="image[]" accept="image/" multiple>
                        <span class="image_error"
                            style="display: block;color: red;position: absolute;top: 66px;left: 40px;"></span>
                    </div>
                    <button type="submit" class="btn btn-dark mb-2" name="upload">Tải ảnh</button>
                </form>

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Thư viện ảnh sản phẩm {{ $nameProduct->name }}</h4>
                        <input type="hidden" class="product_id" value="{{ $product_id }}">
                        <form action="">
                            @csrf
                            <div cslass="table-reponsive">
                                <div id="load_gallery">


                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            load_gallery();

            function load_gallery() {
                var product_id = $('.product_id').val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: '{{ route('admin.selectGallery') }}',
                    method: 'POST',
                    data: {
                        product_id: product_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#load_gallery').html(data);
                    }
                })
            };

            $('#image').change(function() {
                var error = '';
                var image = $('#image')[0].files;

                if (image.length > 5) {
                    error += '<p>Bạn chọn tối đa được 5 ảnh</p>';
                } else if (image.length == '') {
                    error += '<p>Bạn không được để trống ảnh</p>';
                } else if (image.size > 2000000) {
                    error += '<p>File ảnh không được lớn 2MB</p>';
                }

                if (error == '') {

                } else {
                    $('#image').val('');
                    $('.image_error').html(error);
                    return false;
                }

            });

            $(document).on('change', '.file_image', function() {
                var gallery_id = $(this).data('gallery_id');
                var file = document.getElementById('file-' + gallery_id).files[0];

                var form_data = new FormData();
                form_data.append("file", file);
                form_data.append("gallery_id", gallery_id);

                $.ajax({
                    url: '{{ route('admin.updateGallery') }}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        load_gallery();
                    }
                })
            })
        });
    </script>
@endsection
