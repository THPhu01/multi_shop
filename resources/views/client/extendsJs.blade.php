<link rel="stylesheet" type="text/css" href="{{ asset('client/slick/slick.css?v2022') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('client/slick/slick-theme.css?v2022') }}">
{{-- Thông báo Sweetalert1 --}}
<link href="{{ asset('client/css/style.css') }}" rel="stylesheet">


<script src="{{ asset('client/slick/slick.js') }}" type="text/javascript" charset="utf-8"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-migrate-3.4.0.min.js"></script>
<script src="{{ asset('client/slick/slick.js?v2022') }}" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    $(".center").slick({
        dots: false,
        infinite: false,
        centerMode: false,
        slidesToShow: 6,
        slidesToScroll: 1
    });
</script>
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

<script type="text/javascript">
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
                    var output = response.output;
                    $('#cart-count').text(cartCount);
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
</script>
<script type="text/javascript">
    $(document).ready(function() {
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
    });
</script>

<script>
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
            toastr.success('Sản phẩm đã yêu thích, nên không thể thêm.')
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

<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
