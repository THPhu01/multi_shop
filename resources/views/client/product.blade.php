@extends('client.layout')

@section('contentMain')
    <div class="container-fluid mb-3">
        <div class="row px-xl-5">
            <div class="col-lg-12">
                <div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel" style="margin-bottom: 15px">
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
                                style="height: 300px;">
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
    <ul id="product-list">

    </ul>

    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">

                <!-- Brand Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Hãng
                        sản
                        xuất</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form style="margin-top:0px">
                        <div class="custom-control-brand">
                            @foreach ($brandAll as $brand)
                                <label class="custom-control-brand-input" name="">
                                    {{ $brand->name }}
                                    <input type="checkbox" id="" class="filter-checkbox" name="brand"
                                        value="{{ $brand->id }}">
                                    <span class="checkmark"></span>
                                </label>
                            @endforeach
                        </div>
                    </form>
                </div>

                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Mức
                        giá</span></h5>
                <div class="bg-light p-4 mb-30">
                    @if ($nameCate->name == 'Laptop' || $nameCate->name == 'laptop')
                        <form style="margin-top:0px">
                            <div class="custom-control-brand">
                                <label class="custom-control-brand-input" style="width:100%">
                                    Dưới 10 triệu
                                    <input type="checkbox" id="" class="filter-checkbox" value="10000000"
                                        name="price">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="custom-control-brand-input" style="width:100%">
                                    Từ 10 - 15 triệu
                                    <input type="checkbox" id="" class="filter-checkbox" value="10000000-15000000"
                                        name="price">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="custom-control-brand-input" style="width:100%">
                                    Từ 15 - 20 triệu
                                    <input type="checkbox" id="" class="filter-checkbox" value="15000000-20000000"
                                        name="price">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="custom-control-brand-input" style="width:100%">
                                    Từ 20 - 25 triệu
                                    <input type="checkbox" id="" class="filter-checkbox" value="20000000-25000000"
                                        name="price">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="custom-control-brand-input" style="width:100%">
                                    Trên 25 triệu
                                    <input type="checkbox" id="" class="filter-checkbox"
                                        value="25000000"name="price">
                                    <span class="checkmark"></span>
                                </label>

                            </div>
                        </form>
                    @else
                        <form style="margin-top:0px">
                            <div class="custom-control-brand">
                                <label class="custom-control-brand-input" style="width:100%">
                                    Dưới 2 triệu
                                    <input type="checkbox" id="" class="filter-checkbox" value="2000000"
                                        name="price">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="custom-control-brand-input" style="width:100%">
                                    Từ 2 - 4 triệu
                                    <input type="checkbox" id="" class="filter-checkbox" value="2000000-4000000"
                                        name="price">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="custom-control-brand-input" style="width:100%">
                                    Từ 4 - 7 triệu
                                    <input type="checkbox" id="" class="filter-checkbox"
                                        value="4000000-7000000" name="price">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="custom-control-brand-input" style="width:100%">
                                    Từ 7 - 13 triệu
                                    <input type="checkbox" id="" class="filter-checkbox"
                                        value="7000000-13000000" name="price">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="custom-control-brand-input" style="width:100%">
                                    Trên 13 triệu
                                    <input type="checkbox" id="" class="filter-checkbox"
                                        value="13000000"name="price">
                                    <span class="checkmark"></span>
                                </label>

                            </div>
                        </form>
                    @endif
                </div>

                <!-- Viewed Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Sản phẩm đã xem</span></h5>
                <div class="bg-light p-2 mb-30 wishlist-container ">
                    <form style="margin-top:0px">
                        <div id="view_viewed" class="">
                        </div>
                    </form>
                </div>

                <!-- Wishlist Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Sản phẩm
                        yêu thích</span></h5>
                <div class="bg-light p-2 mb-30 wishlist-container ">
                    <form style="margin-top:0px">
                        <div id="view_wishlist" class="">
                        </div>
                    </form>
                </div>

            </div>

            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8" id="muti">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="brand-custom">
                            <div class="card-header-brand">
                                <h1 class="cdt-head__title">
                                    {{ $nameCate->name }}
                                    <input type="hidden" name="category_id" value="{{ $nameCate->id }}">

                                </h1>
                                <span class="cdt-head-span">({{ $products->count() }} sản phẩm)</span>
                                <hr>
                            </div>
                            <section class="center slider" style="margin: 20px">
                                @foreach ($brandAll as $brand)
                                    <div class="brand-img-zoom">
                                        <a
                                            href="{{ route('client.shop.category', [$nameCate->id]) }}?brand={{ $brand->id }}">
                                            <img src="{{ asset('upload/brand') }}/{{ $brand->image }}"></a>
                                    </div>
                                @endforeach
                            </section>
                        </div>
                    </div>
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div></div>
                            <div class="ml-2">
                                <div class="btn-group ml-2 loc-sp">
                                    <button type="button" class="btn btn-sm btn-light">Lọc giá sản phẩm</button>
                                    <div class="dropdown-menu-right loc-sp-box">
                                        <a class="dropdown-item" href="{{ Request::url() }}?loc_sp=tang_dan">Lọc giá từ
                                            thấp đến cao</a>
                                        <a class="dropdown-item" href="{{ Request::url() }}?loc_sp=giam_dan">Lọc giá từ
                                            cao đến thấp</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 pb-1 d-flex flex-wrap">

                        @foreach ($products as $sp)
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4" style="height: 414px">

                                    <div class="product-img position-relative overflow-hidden" style="height:284px">
                                        <img class="img-fluid w-100"
                                            src="{{ asset('upload/product') }}/{{ $sp->image }}" alt=""
                                            style="padding: 30px">
                                        <form>
                                            <div class="product-action">

                                                <button type="button" class="btn btn-outline-dark btn-square add-to-cart"
                                                    data-id_product="{{ $sp->id }}" name="add-to-cart"><i
                                                        class="fa fa-shopping-cart"></i></button>

                                                <button type="button"
                                                    class="btn btn-outline-dark btn-square add-to-wishlist"
                                                    onclick="add_wishlist(this.id);" id="{{ $sp->id }}">
                                                    <i class="far fa-heart">
                                                    </i>
                                                </button>

                                                <button type="button" class="btn btn-outline-dark btn-square quickview"
                                                    data-toggle="modal" data-target="#exampleModalCenter" id="quickview"
                                                    data-id_product="{{ $sp->id }}">
                                                    <i class="fa fa-search"></i>
                                                </button>

                                            </div>
                                            @csrf
                                            <input type="hidden" value="{{ $sp->id }}"
                                                class="cart_product_id_{{ $sp->id }}">

                                            <input id="wishlist_name-{{ $sp->id }}" type="hidden"
                                                value="{{ $sp->name }}"
                                                class="cart_product_name_{{ $sp->id }}">

                                            <input id="wishlist_linkimage-{{ $sp->id }}" type="hidden"
                                                value="{{ $sp->image }}"
                                                src="{{ asset('upload/product') }}/{{ $sp->image }}"
                                                class="cart_product_image_{{ $sp->id }}">

                                            <input id="wishlist_image-{{ $sp->id }}" type="hidden"
                                                value="{{ $sp->image }}">

                                            <input type="hidden" value="{{ $sp->price_sale }}"
                                                class="cart_product_price_sale_{{ $sp->id }}">

                                            <input type="hidden" value="{{ $sp->price }}"
                                                class="cart_product_price_{{ $sp->id }}">

                                            <input id="wishlist_price_sale-{{ $sp->id }}" type="hidden"
                                                value="{{ $sp->price_sale }}">

                                            <input id="wishlist_price-{{ $sp->id }}" type="hidden"
                                                value="{{ $sp->price }}">

                                            <input type="hidden" value="1"
                                                class="cart_product_qty_{{ $sp->id }}">
                                        </form>
                                    </div>
                                    <div class="text-center py-4">
                                        <a id="wishlist_id-{{ $sp->id }}"
                                            class="h6 text-decoration-none text-truncate custom-name-product"
                                            href="{{ route('client.shop.detail', [$sp->id]) }}">{{ $sp->name }}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            @if ($sp->price_sale != 0)
                                                <h5 style="color: red">
                                                    {{ number_format($sp->price_sale, 0, '', '.') }}đ
                                                </h5>
                                                <span class="text-muted ml-2">
                                                    <del>
                                                        {{ number_format($sp->price, 0, '', '.') }}đ
                                                    </del>
                                                </span>
                                            @else
                                                <h5>
                                                    {{ number_format($sp->price, 0, '', '.') }}đ
                                                </h5>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
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
        $('.filter-checkbox').on('change', function() {
            updateFilteredProducts();
        });

        function updateFilteredProducts() {
            var selectedPrice = [];
            var selectedBrand = [];

            $('input[name="price"]:checked').each(function() {
                selectedPrice.push($(this).val());
            });

            $('input[name="brand"]:checked').each(function() {
                selectedBrand.push($(this).val());
            });
            var category_id = $('input[name="category_id"]').val();

            $.ajax({
                type: 'GET',
                url: '{{ route('client.shop.check') }}',
                data: {
                    price: selectedPrice,
                    brands: selectedBrand,
                    category_id: category_id
                },
                success: function(data) {
                    $('#muti').html(data);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    </script>
@endsection
