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
                            <a href="{{ route('client.shop.category', [$nameCate->id]) }}?brand={{ $brand->id }}">
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
                            <a class="dropdown-item"
                                href="{{ route('client.shop.category', [$nameCate->id]) }}?loc_sp=tang_dan">Lọc giá từ
                                thấp đến cao</a>
                            <a class="dropdown-item"
                                href="{{ route('client.shop.category', [$nameCate->id]) }}?loc_sp=giam_dan">Lọc giá
                                từ
                                cao đến thấp</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 pb-1 d-flex flex-wrap">
            @if (count($products) > 0)
                @foreach ($products as $sp)
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4" style="height: 414px">

                            <div class="product-img position-relative overflow-hidden" style="height:284px">
                                <img class="img-fluid w-100" src="{{ asset('upload/product') }}/{{ $sp->image }}"
                                    alt="" style="padding: 30px">
                                <form>
                                    <div class="product-action">
                                        <button type="button" class="btn btn-outline-dark btn-square add-to-cart"
                                            data-id_product="{{ $sp->id }}" name="add-to-cart"><i
                                                class="fa fa-shopping-cart"></i></button>

                                        <button type="button" class="btn btn-outline-dark btn-square add-to-wishlist"
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
                                        value="{{ $sp->name }}" class="cart_product_name_{{ $sp->id }}">

                                    <input id="wishlist_image-{{ $sp->id }}" type="hidden"
                                        value="{{ $sp->image }}" class="cart_product_image_{{ $sp->id }}">

                                    <input id="wishlist_linkimage-{{ $sp->id }}" type="hidden"
                                        src="{{ asset('upload/product') }}/{{ $sp->image }}"
                                        class="cart_product_image_{{ $sp->id }}">

                                    <input type="hidden" value="{{ $sp->price_sale }}"
                                        class="cart_product_price_sale_{{ $sp->id }}">

                                    <input type="hidden" value="{{ $sp->price }}"
                                        class="cart_product_price_{{ $sp->id }}">

                                    <input id="wishlist_price_sale-{{ $sp->id }}" type="hidden"
                                        value="{{ $sp->price_sale }}">

                                    <input id="wishlist_price-{{ $sp->id }}" type="hidden"
                                        value="{{ $sp->price }}">

                                    <input type="hidden" value="1" class="cart_product_qty_{{ $sp->id }}">
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
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:1000px">

                            <!-- Modal content -->
                            <div class="modal-content p-3">
                                <div class="row px-xl-5"
                                    style="padding-left: 0 !important;
                padding-right: 0 !important;">
                                    <div class="col-lg-5">

                                        <div id="product-carousel" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner bg-light">
                                                <div class="carousel-item active" id="image-product">
                                                </div>
                                                <div class="carousel-item" id="gallery-product">
                                                </div>
                                            </div>
                                            <a class="carousel-control-prev" href="#product-carousel"
                                                data-slide="prev">
                                                <i class="fa fa-2x fa-angle-left text-dark"></i>
                                            </a>
                                            <a class="carousel-control-next" href="#product-carousel"
                                                data-slide="next">
                                                <i class="fa fa-2x fa-angle-right text-dark"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-lg-7 h-auto mb-30">
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
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
                                                    <button type="button"
                                                        class="btn btn-primary px-3 add-cart-quickview"><i
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
                @endforeach
            @else
                <div class="container" style="height: 360px !important">
                    <div class="row px-xl-12 mx-auto no-product-custom-container">
                        <div class="no-product-custom-img"></div>
                        <div class="no-product-custom-title">
                            <h5>Không tìm thấy sản phẩm phù hợp</h5>
                        </div>
                        <div class="no-product-custom-p">Vui lòng điều chỉnh lại bộ lọc</div>

                    </div>
            @endif

        </div>

    </div>
    @extends('client.extendsJs')
