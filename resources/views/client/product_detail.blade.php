@extends('client.layout')

@section('contentMain')
    <style>
        .lSSlideOuter .lSPager.lSGallery img {
            height: 160px;
            padding: 10px;

        }

        .lSSlideOuter .lSPager.lSGallery li {
            background-color: white
        }
    </style>
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('client.home') }}">Trang chủ</a>
                    <a class="breadcrumb-item text-dark"
                        href="{{ route('client.shop.category', [$shopId->productCategory->id]) }}">{{ $shopId->productCategory->name }}</a>
                    <span class="breadcrumb-item active">{{ $shopId->name }}</span>
                </nav>
            </div>
        </div>
    </div>
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <ul id="imageGallery">
                    <li data-thumb="{{ asset('upload/product') }}/{{ $shopId->image }}"
                        data-src="{{ asset('upload/product') }}/{{ $shopId->image }}" style="background-color: white;">
                        <img style="width:100%;padding: 20px;" src="{{ asset('upload/product') }}/{{ $shopId->image }}" />
                    </li>
                    @if (!empty($shopGallery))
                        @foreach ($shopGallery as $gallery)
                            <li data-thumb="{{ asset('upload/gallery') }}/{{ $gallery->image }}"
                                data-src="{{ asset('upload/gallery') }}/{{ $gallery->image }}"
                                style="background-color: white;">
                                <img style="width:100%;padding: 20px;"
                                    src="{{ asset('upload/gallery') }}/{{ $gallery->image }}" />
                            </li>
                        @endforeach
                    @endif

                </ul>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3 class="mb-3">{{ $shopId->name }}</h3>
                    @if ($shopId->price_sale != 0)
                        <div class="d-flex align-items-end ">
                            <h3 class="font-weight-semi-bold mb-4" style="color:red">
                                {{ number_format($shopId->price_sale, 0, '', '.') }}đ
                            </h3>
                            <span class="font-weight-semi-bold mb-4" style="font-size: 20px;margin-left:10px">
                                <del> {{ number_format($shopId->price, 0, '', '.') }}đ</del>
                            </span>
                        </div>
                    @else
                        <h3 class="font-weight-semi-bold ">
                            {{ number_format($shopId->price, 0, '', '.') }}đ
                        </h3>
                    @endif
                    <p class="">{!! $shopId->desc !!}</p>

                    <div class="d-flex align-items-center mb-4 pt-2">
                        <form>
                            @csrf
                            <div style="display: -webkit-box;width: 350px;">
                                <input type="hidden" name="id_sp" value="{{ $shopId->id }}">
                                <input type="hidden" name="qty" value="1">
                                <div class="d-flex">
                                    <button type="button" class="btn btn-primary px-3 add-to-cart" name="add-cart"
                                        style="width: 200px;height: 50px;margin-right: 15px;"
                                        data-id_product="{{ $shopId->id }}"><i class="fa fa-shopping-cart mr-1"></i>Thêm
                                        vào
                                        giỏ hàng </button>

                                    <input id="wishlist_name-{{ $shopId->id }}" type="hidden"
                                        value="{{ $shopId->name }}" class="cart_product_name_{{ $shopId->id }}">

                                    <input id="wishlist_linkimage-{{ $shopId->id }}" type="hidden"
                                        src="{{ asset('upload/product') }}/{{ $shopId->image }}">

                                    <input id="wishlist_image-{{ $shopId->id }}" type="hidden"
                                        value="{{ $shopId->image }}">

                                    <input id="wishlist_price_sale-{{ $shopId->id }}" type="hidden"
                                        value="{{ $shopId->price_sale }}">

                                    <input id="wishlist_price-{{ $shopId->id }}" type="hidden"
                                        value="{{ $shopId->price }}">

                                    <a id="wishlist_id-{{ $shopId->id }}" class="d-none"
                                        href="{{ route('client.shop.detail', [$shopId->id]) }}">{{ $shopId->name }}</a>

                                    <button type="button" class="btn btn-primary px-3" name=""
                                        style="width: 200px;height: 50px;" onclick="add_wishlist(this.id);"
                                        id="{{ $shopId->id }}">
                                        <i class="fas fa-heart mr-1"></i>Thêm
                                        vào
                                        yêu thích </button>

                                </div>
                            </div>
                            <input type="hidden" value="{{ $shopId->id }}" class="cart_product_id_{{ $shopId->id }}">

                            <input type="hidden" value="{{ $shopId->name }}"
                                class="cart_product_name_{{ $shopId->id }}">

                            <input type="hidden" value="{{ $shopId->image }}"
                                class="cart_product_image_{{ $shopId->id }}">


                            <input type="hidden" value="{{ $shopId->price_sale }}"
                                class="cart_product_price_sale_{{ $shopId->id }}">

                            <input type="hidden" value="{{ $shopId->price }}"
                                class="cart_product_price_{{ $shopId->id }}">

                            <input type="hidden" value="1" class="cart_product_qty_{{ $shopId->id }}">

                            <input type="hidden" value="{{ $shopId->id }}" class="" id="product_viewed_id">
                        </form>
                    </div>

                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Thông tin sản
                            phẩm</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Đánh giá</a>
                    </div>
                    <div class="tab-content" style="overflow: hidden">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <h4 class="mb-3">{{ $shopId->name }}</h4>
                            <p>{!! $shopId->content !!}</p>
                        </div>

                        <input type="hidden" name="product_id_comment" value="{{ $shopId->id }}">
                        <div class="tab-pane fade" id="tab-pane-3">
                            <div class="row">
                                <div class="col-md-6">

                                    <div id="show-comment"></div>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="mb-2">Gửi đánh giá</h4>
                                    <form style="margin: 0">
                                        <div class="form-group">
                                            <label for="message">Nội dung đánh giá *</label>
                                            <textarea id="message" placeholder="Hãy chia sẽ cảm nhận của bạn về sản phẩm... " cols="30" rows="5"
                                                id="comment_content" class="form-control comment_content"></textarea>
                                            <span class="comment_content_error"
                                                style="display: block;color: red;margin-top:5px;font-size:14px"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Nhập họ và tên *</label>
                                            <input type="text" placeholder="Nhập họ và tên"
                                                class="form-control comment_name">
                                            <span class="comment_name_error"
                                                style="display: block;color: red;margin-top:5px;font-size:14px"></span>
                                        </div>
                                        <div class="form-group mb-0">
                                            <input type="button" value="Hoàn tất"
                                                class="btn btn-primary px-3 send-comment">
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Sản phẩm
                liên quan</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($shopLq as $lq)
                        <div class="product-item bg-light">
                            <div class="product-img position-relative overflow-hidden">
                                <img style="padding: 30px" class="img-fluid w-100"
                                    src="{{ asset('upload/product') }}/{{ $lq->image }}" alt="">
                                <form>
                                    <div class="product-action">

                                        <button type="button" class="btn btn-outline-dark btn-square add-to-cart"
                                            data-id_product="{{ $lq->id }}" name="add-to-cart"><i
                                                class="fa fa-shopping-cart"></i></button>

                                        <button type="button" class="btn btn-outline-dark btn-square add-to-wishlist"
                                            onclick="add_wishlist(this.id);" id="{{ $lq->id }}">
                                            <i class="far fa-heart">
                                            </i>
                                        </button>

                                        <button type="button" class="btn btn-outline-dark btn-square quickview"
                                            data-toggle="modal" data-target="#exampleModalCenter" id="quickview"
                                            data-id_product="{{ $lq->id }}">
                                            <i class="fa fa-search"></i>
                                        </button>

                                    </div>
                                    @csrf
                                    <input type="hidden" value="{{ $lq->id }}"
                                        class="cart_product_id_{{ $lq->id }}">

                                    <input id="wishlist_name-{{ $lq->id }}" type="hidden"
                                        value="{{ $lq->name }}" class="cart_product_name_{{ $lq->id }}">

                                    <input id="wishlist_linkimage-{{ $lq->id }}" type="hidden"
                                        value="{{ $lq->image }}"
                                        src="{{ asset('upload/product') }}/{{ $lq->image }}"
                                        class="cart_product_image_{{ $lq->id }}">

                                    <input id="wishlist_image-{{ $lq->id }}" type="hidden"
                                        value="{{ $lq->image }}">

                                    <input type="hidden" value="{{ $lq->price_sale }}"
                                        class="cart_product_price_sale_{{ $lq->id }}">

                                    <input type="hidden" value="{{ $lq->price }}"
                                        class="cart_product_price_{{ $lq->id }}">

                                    <input id="wishlist_price_sale-{{ $lq->id }}" type="hidden"
                                        value="{{ $lq->price_sale }}">

                                    <input id="wishlist_price-{{ $lq->id }}" type="hidden"
                                        value="{{ $lq->price }}">

                                    <input type="hidden" value="1" class="cart_product_qty_{{ $lq->id }}">
                                </form>
                            </div>
                            <div class="text-center py-4">
                                <a id="wishlist_id-{{ $lq->id }}" class="h6 text-decoration-none text-truncate"
                                    href="{{ route('client.shop.detail', [$lq->id]) }}">{{ $lq->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    @if ($lq->price_sale != 0)
                                        <div class="d-flex align-items-end">
                                            <h5 class="font-weight-semi-bold mb-4" style="color:red">
                                                {{ number_format($lq->price_sale, 0, '', '.') }}đ
                                            </h5>
                                            <span class="font-weight-semi-bold mb-4"
                                                style="font-size: 15px;margin-left:10px">
                                                <del> {{ number_format($lq->price, 0, '', '.') }}đ</del>
                                            </span>
                                        </div>
                                    @else
                                        <h5 class="font-weight-semi-bold mb-4">
                                            {{ number_format($lq->price, 0, '', '.') }}đ
                                        </h5>
                                    @endif
                                    {{-- <h6 class="text-muted ml-2"><del>$123.00</del></h6> --}}
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:1000px">

            <!-- Modal content -->
            <div class="modal-content p-3">
                <div class="row px-xl-5" style="padding-left: 0 !important;
            padding-right: 0 !important;">
                    <div class="col-lg-5">

                        <div id="product-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner bg-light">
                                <div class="carousel-item active" id="image-product">
                                </div>
                                <div class="carousel-item" id="gallery-product">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                                <i class="fa fa-2x fa-angle-left text-dark"></i>
                            </a>
                            <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                                <i class="fa fa-2x fa-angle-right text-dark"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-7 h-auto mb-30">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="h-100 bg-light">
                            <h3 id="name-product"></h3>
                            <h3 class="font-weight-semi-bold mb-4" id="price-product"></h3>
                            <p class="mb-4" id="desc-product"></p>

                            <div class="">
                                <form action="">
                                    @csrf
                                    <p id="idProduct" style="display: none"></p>
                                    <button type="button" class="btn btn-primary px-3 add-cart-quickview"><i
                                            class="fa fa-shopping-cart mr-1"></i> Thêm vào giỏ
                                        hàng</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <script>
        $(document).ready(function() {
            show_comment();

            function show_comment() {
                var _token = $('input[name="_token"]').val();
                var product_id_comment = $('input[name="product_id_comment"]').val();

                $.ajax({
                    url: '{{ route('client.shop.comments') }}',
                    method: 'POST',
                    data: {
                        _token: _token,
                        product_id_comment: product_id_comment
                    },
                    success: function(data) {
                        $('#show-comment').html(data);

                    }
                })
            }

            $('.send-comment').click(function() {
                var _token = $('input[name="_token"]').val();
                var product_id_comment = $('input[name="product_id_comment"]').val();
                var comment_name = $('.comment_name').val();
                var comment_content = $('.comment_content').val();


                $.ajax({
                    url: '{{ route('client.shop.add.comment') }}',
                    method: 'POST',
                    data: {
                        product_id_comment: product_id_comment,
                        comment_name: comment_name,
                        comment_content: comment_content,
                        _token: _token
                    },
                    success: function(data) {
                        show_comment();
                        $('.comment_name').val('');
                        $('.comment_content').val('');

                        if (data.status == 0) {
                            $.each(data.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                            });
                        }
                        if (data == 1) {
                            toastr.success('Thêm đánh giá thành công.')
                            show_comment();
                            $('.comment_name').val('');
                            $('.comment_content').val('');
                        }

                    }
                })
                $(".comment_name").click(function(e) {
                    $('.comment_name_error').html('');
                });
                $(".comment_content").click(function(e) {
                    $('.comment_content_error').html('');
                });
            });
        });
    </script>


@endsection
