<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $meta_title }}</title>
    {{-- Seo Meta --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Free HTML Templates">
    <meta name="description" content="Free HTML Templates">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="canonical" href="{{ $url_canonical }}">

    <!-- Favicon -->
    <link href="{{ asset('client/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="{{ asset('client/https://fonts.gstatic.com') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('client/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('client/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('client/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('client/css/lightslider.css') }}" rel="stylesheet">
    <link href="{{ asset('client/css/lightgallery.min.css') }}" rel="stylesheet">
    <link href="{{ asset('client/css/prettify.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.2.19/css/lightgallery.min.css" />

    {{-- Css view login/register --}}
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    {{-- Thanh cuộn thương hiệu --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('client/slick/slick.css?v2022') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('client/slick/slick-theme.css?v2022') }}">
    {{-- Thông báo Sweetalert1 --}}
    <link rel="stylesheet" type="text/css" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-1 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center h-100">
                    <a class="text-body mr-3" href="#">About</a>
                    <a class="text-body mr-3" href="#">Contact</a>
                    <a class="text-body mr-3" href="#">Help</a>
                    <a class="text-body mr-3" href="#">FAQs</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">

                    <div class="btn-group mx-2">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                            data-toggle="dropdown">USD</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <button class="dropdown-item" type="button">EUR</button>
                            <button class="dropdown-item" type="button">GBP</button>
                            <button class="dropdown-item" type="button">CAD</button>
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                            data-toggle="dropdown">EN</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <button class="dropdown-item" type="button">FR</button>
                            <button class="dropdown-item" type="button">AR</button>
                            <button class="dropdown-item" type="button">RU</button>
                        </div>
                    </div>
                </div>
                <div class="d-inline-flex align-items-center d-block d-lg-none">
                    <a href="#" class="btn px-0 ml-2">
                        <i class="fas fa-heart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle"
                            style="padding-bottom: 2px;">0</span>
                    </a>
                    <a href="#" class="btn px-0 ml-2">
                        <i class="fas fa-shopping-cart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle"
                            style="padding-bottom: 2px;">0</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="{{ route('client.home') }}" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">Multi</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span>
                </a>
            </div>
            <div class="col-lg-4 col-6 text-left">
                <form action="" style="margin: 0;">
                    @csrf
                    <div class="input-group" style="position: relative;width: 420px;">
                        <input class="search-input form-control" type="text" placeholder="Tìm kiếm sản phẩm.."
                            id="search">
                        <div class="resultBox" style="" style="display: block;">
                            <div class="" id="resultBox" style="padding: 20px">

                            </div>

                        </div>
                        <span class="input-group-text bg-transparent text-primary">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </form>

            </div>
            <div class="col-lg-4 col-6 text-right">
                <p class="m-0">phuth01.dev@gmail.com</p>
                <h5 class="m-0">0902314116</h5>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">

            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="{{ route('client.home') }}" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">Multi</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse"
                        data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{ route('client.home') }}" class="nav-item nav-link ">Trang chủ</a>
                            @php
                                use App\Models\Category;
                                $category = Category::where('status', 1)->get();
                            @endphp
                            @foreach ($category as $cate)
                                <a href="{{ route('client.shop.category', [$cate->id]) }}"
                                    class="nav-link nav-item ">{{ $cate->name }}
                                </a>
                            @endforeach
                            <div class="nav-item">
                                <a href="#" class="nav-link">Pages <i class="fa fa-angle-down mt-1"></i></a>
                                <div class="dropdown-menu bg-primary rounded-0 border-0 m-0">
                                    <a href="{{ route('client.shop.cart') }}" class="dropdown-item">Shopping Cart</a>
                                    <a href="{{ route('client.view.wishlist') }}" class="dropdown-item">Shopping
                                        Wishlist</a>
                                    <a href="{{ route('client.shop.checkout') }}" class="dropdown-item ">Checkout</a>
                                </div>
                            </div>
                            <a href="#" class="nav-item nav-link">Contact</a>

                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                            @if (Auth::check())
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav mr-auto">
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                                role="button" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Xin chào {{ Auth::user()->name }}
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="{{ route('client.my.account') }}">Quản
                                                    lí tài khoản</a>
                                                <a class="dropdown-item" href="{{ route('client.logout') }}">Đăng
                                                    xuất</a>

                                            </div>
                                        </li>
                                    </ul>
                                @else
                                    <div class="btn-group mx-2">
                                        <a href="{{ route('client.viewLogin') }}" class="btn px-0 mr-1">
                                            <i class="fas fa-user text-primary"></i>
                                        </a>
                                    </div>
                            @endif
                            <a href="{{ route('client.view.wishlist') }}" class="btn px-0">
                                <i class="fas fa-heart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle"
                                    style="padding-bottom: 2px;" id="wishlist-count">
                                    0
                                </span>
                            </a>
                            @php
                                $product = Cart::content();
                            @endphp
                            <div class="btn-group mx-2">
                                <div class="nav-item box-cart-hover">
                                    <a href="#" class="nav-link ">
                                        <i class="fas fa-shopping-cart text-primary"></i>
                                        <span class="badge text-secondary border border-secondary rounded-circle"
                                            style="padding-bottom: 2px;" id="cart-count">
                                            @if (Cart::count() > 0)
                                                {{ Cart::content()->count() }}
                                            @else
                                                0
                                            @endif
                                        </span>
                                    </a>
                                    <div class="shopping-cart-box" id="shopping-cart-box">
                                    </div>
                                    <!--end shopping-cart -->

                                </div>
                            </div>
                        </div>


                    </div>


            </div>
            </nav>
        </div>
    </div>
    </div>
    <!-- Navbar End -->

    @yield('contentMain')

    <!-- Carousel Start -->



    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary mt-5 pt-5">
        <div class="row px-xl-5 ">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <h5 class="text-secondary text-uppercase mb-4">Trần Hữu Phú</h5>
                <p class="mb-4">Em học CĐ FPT Polytechnic, ngành TKW BACKEND (PHP,LARAVEL), em mong muốn kiếm được 1
                    công ty phù hợp với chuyên ngành để có cơ hợi phát triển bản thân và học hỏi để có kinh nghiệm giúp
                    ích cho xã hội, công ty và gia đình. Em cảm ơn.</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>Quận 12</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>phuth01.dev@gmail.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>0902314116</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <h5 class="text-secondary text-uppercase mb-4">Danh mục</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="{{ route('client.home') }}"><i
                                    class="fa fa-angle-right mr-2"></i>Trang
                                chủ</a>
                            @foreach ($category as $cate)
                                <a class="text-secondary mb-2"
                                    href="{{ route('client.shop.category', [$cate->id]) }}"><i
                                        class="fa fa-angle-right mr-2"></i>{{ $cate->name }}</a>
                            @endforeach
                            <a class="text-secondary mb-2" href="{{ route('client.shop.cart') }}"><i
                                    class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-secondary  mb-2" href="{{ route('client.view.wishlist') }}"><i
                                    class="fa fa-angle-right mr-2"></i>Shopping Wishlist</a>
                            <a class="text-secondary" href="{{ route('client.shop.checkout') }}"><i
                                    class="fa fa-angle-right mr-2"></i>Checkout</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <h5 class="text-secondary text-uppercase mb-4">CHỨC NĂNG</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Login/Register</a>
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>QuickView</a>
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Wishlist</a>
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Search Autocomplete</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>My
                                Account</a>
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>History Order</a>
                                    <a class="text-secondary mb-2" href="#"><i
                                        class="fa fa-angle-right mr-2"></i>Comment Product</a>
                            <a class="text-secondary mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Filter Brand / Price</a>
                            <a class="text-secondary" href="#"><i class="fa fa-angle-right mr-2"></i>Shopping
                                Cart / Checkout</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <h5 class="text-secondary text-uppercase mb-4">Newsletter</h5>
                        <p>Duo stet tempor ipsum sit amet magna ipsum tempor est</p>
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Your Email Address">
                                <div class="input-group-append">
                                    <button class="btn btn-primary">Sign Up</button>
                                </div>
                            </div>
                        </form>
                        <h6 class="text-secondary text-uppercase mt-4 mb-3">Follow Us</h6>
                        <div class="d-flex">
                            <a class="btn btn-primary btn-square mr-2" href="#"><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i
                                    class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-secondary">
                    &copy; <a class="text-primary" href="#">Domain</a>. All Rights Reserved. Designed
                    by
                    <a class="text-primary" href="https://htmlcodex.com">HTML Codex</a>
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="{{ asset('client/img/payments.png') }}" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('client/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('client/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Contact Javascript File -->
    <script src="{{ asset('client/mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('client/mail/contact.js') }}"></script>
    <!-- Template Javascript -->
    <script src="{{ asset('client/js/main.js') }}"></script>
    <script src="{{ asset('client/js/sweetalert2.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

    {{-- Thanh cuộn thương hiệu --}}
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>

    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    {!! Toastr::message() !!}
    {{-- sweetalert1 --}}
    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
    <script src="{{ asset('client/slick/slick.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-migrate-3.4.0.min.js"></script>
    <script src="{{ asset('client/slick/slick.js?v2022') }}" type="text/javascript" charset="utf-8"></script>
    {{-- Slider Brands --}}
    <script type="text/javascript">
        $(document).on('ready', function() {
            $(".center").slick({
                dots: false,
                infinite: false,
                centerMode: false,
                slidesToShow: 6,
                slidesToScroll: 1
            });

            toastr.options = {
                closeButton: true,
                progressBar: true,
                positionClass: 'toast-top-right',
                timeOut: 3000 // Thời gian hiển thị thông báo (milliseconds)
            };


        });
    </script>

    {{-- Slider Gallery ShopDetail --}}
    <script src="{{ asset('client/js/lightslider.js') }}"></script>
    <script src="{{ asset('client/js/prettify.js') }}"></script>
    <script src="{{ asset('client/js/lightgallery-all.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#imageGallery').lightSlider({
                gallery: true,
                item: 1,
                loop: true,
                thumbItem: 3,
                slideMargin: 0,
                enableDrag: false,
                currentPagerPosition: 'left',
                onSliderLoad: function(el) {
                    el.lightGallery({
                        selector: '#imageGallery .lslide'
                    });
                }
            });
        });
    </script>

    {{-- Tìm kiếm --}}
    <script type="text/javascript">
        $('#search').keyup(function() {
            var search = $(this).val();
            var _token = $('input[name="_token"]').val();

            if (search != '') {
                $.ajax({
                    url: '{{ route('client.shop.search') }}',
                    method: 'POST',
                    data: {
                        search: search,
                        _token: _token,
                    },
                    success: function(data) {
                        $('#resultBox').fadeIn();
                        $('#resultBox').html(data);
                    }
                })
            } else {
                $('#resultBox').fadeOut();
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            showcarticon();

            function showcarticon() {

                $.ajax({
                    url: '{{ route('client.showCartIcon') }}',
                    method: 'GET',
                    success: function(data) {
                        $('#shopping-cart-box').html(data);

                    }
                })
            }
        });
    </script>

    {{-- Format Tiền  --}}
    <script>
        function formatCurrency(number) {
            // Convert number to string
            var strNumber = number.toString();

            // Split the number into whole and decimal parts
            var parts = strNumber.split('.');
            var wholePart = parts[0];
            var decimalPart = parts.length > 1 ? parts[1] : '';

            // Add commas every three digits in the whole part
            var formattedWholePart = '';
            var digitCount = 0;
            for (var i = wholePart.length - 1; i >= 0; i--) {
                formattedWholePart = wholePart.charAt(i) + formattedWholePart;
                digitCount++;
                if (digitCount === 3 && i > 0) {
                    formattedWholePart = '.' + formattedWholePart;
                    digitCount = 0;
                }
            }

            // Combine the formatted whole and decimal parts
            var formattedNumber = formattedWholePart;
            if (decimalPart !== '') {
                formattedNumber += '.' + decimalPart;
            }

            // Add the VNĐ symbol
            formattedNumber += 'đ';

            return formattedNumber;
        }
    </script>
   
    {{-- Thêm sp vào giỏ hàng --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('.add-to-cart').click(function() {
                var id = $(this).data('id_product');
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
            });
        });
    </script>
   
    {{-- quickview --}}
    <script>
        $(".quickview").click(function() {
            var _token = $('input[name="_token"]').val();
            var product_id = $(this).data('id_product');

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


        });
        $('.add-cart-quickview').click(function() {
            var id = document.getElementById("idProduct");
            id = id.innerHTML;
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{ route('client.addQuickViewCart') }}',
                method: 'POST',
                data: {
                    id: id,
                    _token: _token
                },
                success: function(response) {
                    var cartCount = response.cart_count;
                    var output = response.output;
                    $('#cart-count').text(cartCount);
                    $('#shopping-cart-box').html(output);

                    swal({
                        title: "Thành công!",
                        text: "Bạn đã thêm sản phẩm vào giỏ hàng!",
                        type: "success",
                        timer: 3000,
                        buttons: false
                    });

                }

            });
        });
    </script>

    {{-- Sản phẩm yêu thích --}}
    <script>
        view_wishlist()

        function view_wishlist() {
            if (localStorage.getItem('data') != null) {

                var data = JSON.parse(localStorage.getItem('data'));
                data.reverse();
                var countWishlist = data.length;
                for (i = 0; i < data.length; i++) {
                    var name = data[i].name;
                    var price = data[i].price;
                    var price_sale = data[i].price_sale;
                    var image = data[i].image;
                    var linkimage = data[i].linkimage;
                    var url = data[i].url;
                    if (Number.parseInt(price_sale) > 0) {
                        $('#view_wishlist').append(
                            ' <div class="block-wishlist"><ul class="wishlist-list" ><li class="wishlist-item"><a href = "' +
                            url + '" class="wishlist-image" ><img style="width:100%" src="' + linkimage +
                            '"></a><div class="wishlist-content"><h2 class="wishlist-title"><a href="' + url +
                            '"class="wishlist-a decoration-none">' + name +
                            ' </a></h2><div class= "wishlist-price"><div><del style="font-size: 14px;"aria-hidden="true"><span>' +
                            formatCurrency(price) + '</span></del></div><ins><span>' + formatCurrency(price_sale) +
                            '</span></ins></div></div></li></ul> </div>');
                        $('#wishlist-count').html(countWishlist);
                    } else {
                        $('#view_wishlist').append(
                            ' <div class="block-wishlist"><ul class="wishlist-list" ><li class="wishlist-item"><a href = "' +
                            url + '" class="wishlist-image" ><img style="width:100%" src="' + linkimage +
                            '"></a><div class="wishlist-content"><h2 class="wishlist-title"><a href="' + url +
                            '"class="wishlist-a decoration-none">' + name +
                            ' </a></h2><div class= "wishlist-price"><div></div><span>' + formatCurrency(price) +
                            '</span></div></div></li></ul> </div>');
                        $('#wishlist-count').html(countWishlist);

                    }
                }
            }
        }

        function add_wishlist(id) {
            var id = id;
            var name = document.getElementById('wishlist_name-' + id).value;
            var price = document.getElementById('wishlist_price-' + id).value;
            var price_sale = document.getElementById('wishlist_price_sale-' + id).value;
            var image = document.getElementById('wishlist_image-' + id).value;
            var linkimage = document.getElementById('wishlist_linkimage-' + id).src;
            var url = document.getElementById('wishlist_id-' + id).href;

            var newItem = {
                'id': id,
                'name': name,
                'price': price,
                'price_sale': price_sale,
                'image': image,
                'linkimage': linkimage,
                'url': url,
            }

            if (localStorage.getItem('data') == null) {
                localStorage.setItem('data', '[]');
            }

            var old_data = JSON.parse(localStorage.getItem('data'));
            var matches = $.grep(old_data, function(obj) {
                return obj.id == id;
            })

            if (matches.length) {
                toastr.success('Sản phẩm đã yêu thích, nên không thể thêm!')
            } else {
                old_data.push(newItem);
                var countWishlist = old_data.length;

                if (Number.parseInt(newItem.price_sale) > 0) {
                    toastr.success('Thêm sản phẩm yêu thích thành công!')
                    $('#view_wishlist').append(
                        ' <div class="block-wishlist"><ul class="wishlist-list" ><li class="wishlist-item"><a href = "' +
                        newItem.url + '" class="wishlist-image" ><img style="width:100%" src="' + newItem.linkimage +
                        '"></a><div class="wishlist-content"><h2 class="wishlist-title"><a href="' + newItem.url +
                        '"class="wishlist-a decoration-none">' + newItem.name +
                        ' </a></h2><div class= "wishlist-price"><div><del style="font-size: 14px;"aria-hidden="true"><span>' +
                        formatCurrency(newItem.price) + '</span></del></div><ins><span>' + formatCurrency(newItem
                            .price_sale) +
                        '</span></ins></div></div></li></ul> </div>');
                    $('#wishlist-count').html(countWishlist);

                } else {
                    toastr.success('Thêm sản phẩm yêu thích thành công!')
                    $('#view_wishlist').append(
                        ' <div class="block-wishlist"><ul class="wishlist-list" ><li class="wishlist-item"><a href = "' +
                        newItem.url + '" class="wishlist-image" ><img style="width:100%" src="' + newItem.linkimage +
                        '"></a><div class="wishlist-content"><h2 class="wishlist-title"><a href="' + newItem.url +
                        '"class="wishlist-a decoration-none">' + newItem.name +
                        ' </a></h2><div class= "wishlist-price"><div></div><span>' + formatCurrency(newItem.price) +
                        '</span></div></div></li></ul> </div>');
                    $('#wishlist-count').html(countWishlist);


                }
            }
            localStorage.setItem('data', JSON.stringify(old_data));

        }
    </script>

    {{-- Sản phẩm đã xem --}}
    <script>
        view_viewed()

        function view_viewed() {
            if (localStorage.getItem('viewed') != null) {

                var viewed = JSON.parse(localStorage.getItem('viewed'));
                viewed.reverse();
                for (i = 0; i < viewed.length; i++) {
                    var name = viewed[i].name;
                    var price = viewed[i].price;
                    var price_sale = viewed[i].price_sale;
                    var image = viewed[i].image;
                    var linkimage = viewed[i].linkimage;
                    var url = viewed[i].url;
                    if (Number.parseInt(price_sale) > 0) {
                        $('#view_viewed').append(
                            ' <div class="block-wishlist"><ul class="wishlist-list" ><li class="wishlist-item"><a href = "' +
                            url + '" class="wishlist-image" ><img style="width:100%" src="' + linkimage +
                            '"></a><div class="wishlist-content"><h2 class="wishlist-title"><a href="' + url +
                            '"class="wishlist-a decoration-none">' + name +
                            ' </a></h2><div class= "wishlist-price"><div><del style="font-size: 14px;"aria-hidden="true"><span>' +
                            formatCurrency(price) + '</span></del></div><ins><span>' + formatCurrency(price_sale) +
                            '</span></ins></div></div></li></ul> </div>');
                    } else {
                        $('#view_viewed').append(
                            ' <div class="block-wishlist"><ul class="wishlist-list" ><li class="wishlist-item"><a href = "' +
                            url + '" class="wishlist-image" ><img style="width:100%" src="' + linkimage +
                            '"></a><div class="wishlist-content"><h2 class="wishlist-title"><a href="' + url +
                            '"class="wishlist-a decoration-none">' + name +
                            ' </a></h2><div class= "wishlist-price"><div></div><span>' + formatCurrency(price) +
                            '</span></div></div></li></ul> </div>');

                    }
                }
            }
        }


        product_viewed();

        function product_viewed(id) {
            var id_sp = $('#product_viewed_id').val();
            if (id_sp != undefined) {
                var id = id_sp;
                var name = document.getElementById('wishlist_name-' + id).value;
                var price = document.getElementById('wishlist_price-' + id).value;
                var price_sale = document.getElementById('wishlist_price_sale-' + id).value;
                var image = document.getElementById('wishlist_image-' + id).value;
                var linkimage = document.getElementById('wishlist_linkimage-' + id).src;
                var url = document.getElementById('wishlist_id-' + id).href;

                var newItem = {
                    'id': id,
                    'name': name,
                    'price': price,
                    'price_sale': price_sale,
                    'image': image,
                    'linkimage': linkimage,
                    'url': url,
                }

                if (localStorage.getItem('viewed') == null) {
                    localStorage.setItem('viewed', '[]');
                }

                var old_viewed = JSON.parse(localStorage.getItem('viewed'));
                var matches = $.grep(old_viewed, function(obj) {
                    return obj.id == id;
                })

                if (matches.length) {} else {
                    old_viewed.push(newItem);

                    if (Number.parseInt(newItem.price_sale) > 0) {
                        $('#view_viewed').append(
                            ' <div class="block-wishlist"><ul class="wishlist-list" ><li class="wishlist-item"><a href = "' +
                            newItem.url + '" class="wishlist-image" ><img style="width:100%" src="' + newItem
                            .linkimage +
                            '"></a><div class="wishlist-content"><h2 class="wishlist-title"><a href="' + newItem.url +
                            '"class="wishlist-a decoration-none">' + newItem.name +
                            ' </a></h2><div class= "wishlist-price"><div><del style="font-size: 14px;"aria-hidden="true"><span>' +
                            formatCurrency(newItem.price) + '</span></del></div><ins><span>' + formatCurrency(newItem
                                .price_sale) +
                            '</span></ins></div></div></li></ul> </div>');

                    } else {
                        $('#view_viewed').append(
                            ' <div class="block-wishlist"><ul class="wishlist-list" ><li class="wishlist-item"><a href = "' +
                            newItem.url + '" class="wishlist-image" ><img style="width:100%" src="' + newItem
                            .linkimage +
                            '"></a><div class="wishlist-content"><h2 class="wishlist-title"><a href="' + newItem.url +
                            '"class="wishlist-a decoration-none">' + newItem.name +
                            ' </a></h2><div class= "wishlist-price"><div></div><span>' + formatCurrency(newItem.price) +
                            '</span></div></div></li></ul> </div>');

                    }
                }
                localStorage.setItem('viewed', JSON.stringify(old_viewed));
            }

        }
    </script>

</body>

</html>
