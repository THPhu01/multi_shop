@extends('client.layout')

@section('contentMain')
    <div class="container-fluid mb-3">
        <div class="row px-xl-5">
            <div class="col-lg-12">
                <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#header-carousel" data-slide-to="1"></li>
                        <li data-target="#header-carousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($imgSlider as $img)
                            @php
                                $i++;
                            @endphp
                            <div class="carousel-item position-relative {{ $i == 1 ? 'active' : '' }} "
                                style="height: 400px;">
                                <img class="position-absolute w-100 h-100"
                                    src="{{ asset('upload/slider') }}/{{ $img->image }}"
                                    style="object-fit: cover;image-rendering:auto;">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Carousel End -->

    <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Sản phẩm uy tín</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Giao hàng nhanh</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">14-Ngày đổi trả</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Hỗ trợ 24/7</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Điện thoại
                Khuyến Mãi</span></h2>
        <div class="row px-xl-5" id="load-more-product-dt">
        </div>
    </div>

    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Laptop
                Khuyến Mãi</span></h2>
        <div class="row px-xl-5" id="load-more-product-lap">
        </div>
    </div>

    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Máy tính
                bảng
                Khuyến Mãi</span></h2>
        <div class="row px-xl-5" id="load-more-product-ipad">
        </div>
    </div>
    <!-- Products End -->

    <style>
        .owl-item {
            width: 230px !important;
            margin-right: 10px !important;
        }
    </style>
    <!-- Vendor Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel vendor-carousel" style="height:110px">

                    <div class="bg-light">
                        <img src="https://images.fpt.shop/unsafe/fit-in/384x180/filters:quality(90):fill(white)/fptshop.com.vn/Uploads/Originals/2023/4/4/638162050899556607_TPBANK%20Evo%20-%20F_384x180-1.png"
                            alt="">
                    </div>
                    <div class="bg-light">
                        <img src="https://images.fpt.shop/unsafe/fit-in/384x180/filters:quality(90):fill(white)/fptshop.com.vn/Uploads/Originals/2023/7/4/638240672466962574_F_H3-384x180VIB.png"
                            alt="">
                    </div>
                    <div class="bg-light">
                        <img src="https://images.fpt.shop/unsafe/fit-in/384x180/filters:quality(90):fill(white)/fptshop.com.vn/Uploads/Originals/2023/8/15/638276916178941939_F_H3_384x180.png"
                            alt="">
                    </div>
                    <div class="bg-light">
                        <img src="https://images.fpt.shop/unsafe/fit-in/384x180/filters:quality(90):fill(white)/fptshop.com.vn/Uploads/Originals/2023/8/31/638291180638980144_H3VNPAY.png"
                            alt="">
                    </div>
                    <div class="bg-light">
                        <img src="https://images.fpt.shop/unsafe/fit-in/384x180/filters:quality(90):fill(white)/fptshop.com.vn/Uploads/Originals/2022/7/20/637939260761612196_F_384x180-4.png"
                            alt="">
                    </div>
                    <div class="bg-light">
                        <img src="https://images.fpt.shop/unsafe/fit-in/384x180/filters:quality(90):fill(white)/fptshop.com.vn/Uploads/Originals/2023/8/31/638291180469516616_H3tech.png"
                            alt="">
                    </div>
                    <div class="bg-light">
                        <img src="https://images.fpt.shop/unsafe/fit-in/384x180/filters:quality(90):fill(white)/fptshop.com.vn/Uploads/Originals/2023/8/2/638265728751334697_H3_384x180.png"
                            alt="">
                    </div>
                    <div class="bg-light">
                        <img src="https://images.fpt.shop/unsafe/fit-in/384x180/filters:quality(90):fill(white)/fptshop.com.vn/Uploads/Originals/2023/8/3/638266557202019666_H3_384x180.png"
                            alt="">
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
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

    {{-- Thêm vào giỏ hàng --}}
    <script type="text/javascript">
        function AddToCart($product_id) {

            var id = $product_id;
            var cart_product_id = $('.cart_product_id_' + id).val();
            var cart_product_name = $('.cart_product_name_' + id).val();
            var cart_product_image = $('.cart_product_image_' + id).val();
            var cart_product_price = $('.cart_product_price_' + id).val();
            var cart_product_price_sale = $('.cart_product_price_sale_' + id).val();
            var cart_product_qty = $('.cart_product_qty_' + id).val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{ route('client.shop.add.cart.view') }}',
                method: 'POST',
                data: {
                    cart_product_id: cart_product_id,
                    cart_product_name: cart_product_name,
                    cart_product_image: cart_product_image,
                    cart_product_price: cart_product_price,
                    cart_product_price_sale: cart_product_price_sale,
                    cart_product_qty: cart_product_qty,
                    _token: _token
                },
                success: function(response) {
                    var cartCount = response.cart_count;
                    $('#cart-count').text(cartCount);
                    var output = response.output;
                    $('#shopping-cart-box').html(output);

                    swal({
                            title: "Đã thêm sản phẩm vào giỏ hàng",
                            text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                            showCancelButton: true,
                            cancelButtonText: "Xem tiếp",
                            cancelButtonClass: "btn-secondary",
                            confirmButtonClass: "btn-success",
                            confirmButtonText: "Đi đến giỏ hàng",
                            closeOnConfirm: false
                        },
                        function() {
                            window.location.href = "{{ route('client.shop.cart') }}";
                        });

                }


            });

        };
    </script>

    {{-- Xem nhanh --}}
    <script>
        function QuickView($product_id) {
            var _token = $('input[name="_token"]').val();
            var product_id = $product_id;

            $.ajax({
                url: '{{ route('client.shop.quickView') }}',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    _token: _token,
                    product_id: product_id,
                },
                success: function(data) {
                    $('#image-product').html(data.product_image);
                    $('#gallery-product').html(data.product_gallery);
                    $('#name-product').html(data.product_name);
                    $('#price-product').html(data.product_price);
                    $('#price-product').html(data.product_price_sale);
                    $('#desc-product').html(data.product_desc);
                    $('#idProduct').html(data.product_id);
                }
            });
        }
    </script>

    {{-- Load more sản phẩm --}}
    <script>
        load_more_product_dt()
        load_more_product_lap()
        load_more_product_ipad()

        // Điện thoại
        function load_more_product_dt(id = '') {
            $.ajax({
                url: '{{ route('client.load.product.dt') }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id
                },
                success: function(data) {
                    $('#load-product-dt-button').remove();
                    $('#load-more-product-dt').append(data);
                }
            });
        }
        $(document).on('click', '#load-product-dt-button', function() {
            var id_last = $(this).data('id');
            load_more_product_dt(id_last);

        });

        // Laptop
        function load_more_product_lap(id = '') {
            $.ajax({
                url: '{{ route('client.load.product.lap') }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id
                },
                success: function(data) {
                    $('#load-product-lap-button').remove();
                    $('#load-more-product-lap').append(data);
                }
            });
        }
        $(document).on('click', '#load-product-lap-button', function() {
            var id_last = $(this).data('id');
            load_more_product_lap(id_last);

        });

        // Ipad
        function load_more_product_ipad(id = '') {
            $.ajax({
                url: '{{ route('client.load.product.ipad') }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id
                },
                success: function(data) {
                    $('#load-product-ipad-button').remove();
                    $('#load-more-product-ipad').append(data);
                }
            });
        }
        $(document).on('click', '#load-product-ipad-button', function() {
            var id_last = $(this).data('id');
            load_more_product_ipad(id_last);

        });
    </script>
    @extends('client.extendsJs')
@endsection
