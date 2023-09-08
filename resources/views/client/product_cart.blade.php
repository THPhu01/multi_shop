@extends('client.layout')

@section('contentMain')

    @if (Cart::count() > 0)
        <div class="row px-xl-5 cart-container justify-content-center">
            <div class="col-lg-10 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark initialism">
                        <tr>
                            <th>Ảnh Sản phẩm</th>
                            <th>Tên Sản phẩm</th>
                            <th>Đơn Giá</th>
                            <th>Số Lượng</th>
                            <th>Thành tiền Tiền</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>

                    <tbody class="align-middle">
                        @php
                            $product = Cart::content();
                            $product = $product->reverse();
                        @endphp
                        @foreach ($product as $sp)
                            <form>
                                @csrf
                                <tr class="cart-item">
                                    <input type="hidden" name="row_id" value="{{ $sp->rowId }}">
                                    <td data-th="Image" class="align-middle">
                                        <img src="{{ asset('upload/product') }}/{{ $sp->options->image }}" alt=""
                                            style="width: 60px;">
                                    </td>
                                    <td class="align-middle">

                                        <a
                                            href="{{ route('client.shop.detail', [$sp->id]) }}"class="wishlist-a decoration-none">{{ $sp->name }}
                                        </a>

                                    </td>
                                    <td class="align-middle">
                                        @if ($sp->options->price_sale != 0)
                                            <span style="color:red">
                                                {{ number_format($sp->options->price_sale, 0, '', '.') }}đ
                                            </span>

                                            <del style="font-size: 14px;">
                                                {{ number_format($sp->options->price, 0, '', '.') }}đ</del>
                                            <input type="hidden" name="price" class="price_{{ $sp->rowId }}"
                                                value="{{ $sp->options->price_sale }}">
                                        @else
                                            {{ number_format($sp->price, 0, '', '.') }}đ
                                            <input type="hidden" name="price" class="price_{{ $sp->rowId }}"
                                                value="{{ $sp->price }}">
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <form action="">
                                            @csrf
                                            <input type="number"
                                                class="form-control-sm bg-secondary border-0 text-center cart_update quantity qty_{{ $sp->rowId }}"
                                                value="{{ $sp->qty }}" name="qty_cart" size="2" min="1"
                                                style="width:80px" data-row_id="{{ $sp->rowId }}">

                                            <input type="hidden" name="product_id" class="product_id"
                                                value="{{ $sp->id }}">
                                            <input type="hidden" name="name_product" class="name_product"
                                                value="{{ $sp->name }}">
                                            @foreach ($shop as $s)
                                                @if ($s->id == $sp->id)
                                                    <input type="hidden" name="product_qty" class="product_qty"
                                                        value="{{ $s->qty }}">
                                                @endif
                                            @endforeach
                                        </form>
                                    </td>
                                    <td class="align-middle totalSp_{{ $sp->rowId }}">
                                        {{ number_format($sp->price * $sp->qty, 0, '', '.') }}<span class="price">đ</span>
                                    </td>
                                    <td class="align-middle">

                                        <button class="btn btn-sm btn-danger remove-from-cart"
                                            data-id="{{ $sp->rowId }}"><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>
                            </form>
                        @endforeach

                    </tbody>

                </table>
                <div class="d-flex justify-content-end mt-4">
                    <h5 class="">Tổng giá:</h5>
                    <h5 class="cart-total ml-2" style="color:red">{{ number_format(Cart::subtotal(), 0, '', '.') }}đ</h5>
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <button onclick="deleteCartItems()" class="btn btn-light initialism mr-2">Xóa toàn bộ giỏ hàng</button>
                    <a href="{{ route('client.shop.checkout') }}"><button class=" btn btn-primary initialism p-2">Thanh
                            toán</button></a>


                </div>



            </div>

        </div>
    @else
        <div class="container" style="height: 400px !important">
            <div class="row px-xl-12 mx-auto cart-custom-container">
                <div class="cart-custom-img"></div>
                <div class="cart-custom-p">Giỏ hàng của bạn còn trống</div>
                <a href="{{ route('client.home') }}" class="cart-custom-a"><button
                        class="btn btn-block btn-primary my-3 py-3 ">Mua
                        ngay</button></a>
            </div>
        </div>
    @endif
    <div class="cart-null"></div>
    <script>

        // Cập nhật số lượng sản phẩm
        $(".cart_update").change(function(e) {
            var _token = $('input[name="_token"]').val();
            var name_product = $('input[name="name_product"]').val();
            var row_id = $(this).data('row_id');
            var price = $('.price_' + row_id).val();
            var qty = $('.qty_' + row_id).val();

            var product_qty = $('input[name="product_qty"]').val();
            if (parseInt(qty) > parseInt(product_qty)) {
                swal("", "Sản phẩm " + name_product + " vui lòng đặt ít hơn số lượng " + product_qty)
            } else {
                $.ajax({
                    url: '{{ route('client.shop.update.cart') }}',
                    method: 'POST',
                    data: {
                        _token: _token,
                        row_id: row_id,
                        price: price,
                        qty: qty,
                    },
                    success: function(data) {
                        toastr.success('Cập nhật thành công.')
                        totalSp = Number(data.totalSp);
                        newTotal = Number(data.newTotal);
                        $('.totalSp_' + data.rowId).html(formatCurrency(totalSp));
                        $('.cart-total').html(formatCurrency(newTotal));
                    }
                });
            }

        });

        //xóa tất cả sản phẩm
        function deleteCartItems() {
            $.ajax({
                url: '{{ route('client.shop.delete.all.cart') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    toastr.success('Xóa thành công.')
                    var cartCount = response.cart_count;
                    $('#cart-count').text(cartCount);
                    $('.cart-container').hide();
                    $('.cart-null').html(response.message);

                    var output = response.output;
                    $('#shopping-cart-box').html(output);
                },
                error: function(xhr) {
                    alert('Đã xảy ra lỗi khi xóa giỏ hàng!');
                }
            });
        }

        //Xóa 1 sản phẩm
        document.querySelectorAll('.remove-from-cart').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                var rowId = this.getAttribute('data-id');

                // Gửi yêu cầu xóa sản phẩm bằng Ajax
                $.ajax({
                    url: '{{ route('client.shop.delete.cart') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        rowId: rowId
                    },
                    success: function(response) {

                        var cartCount = response.cart_count;
                        $('#cart-count').text(cartCount);

                        var cartItem = btn.closest('.cart-item');
                        toastr.success('Xóa thành công.')
                        cartItem.remove();

                        var newTotal = response.newTotal;
                        newTotal = Number(newTotal);
                        var totalElement = document.querySelector('.cart-total');
                        totalElement.textContent = formatCurrency(newTotal);

                        var output = response.output;
                        $('#shopping-cart-box').html(output);

                        var cartItems = document.querySelectorAll('.cart-item');
                        if (cartItems.length === 0) {
                            $('.cart-container').hide();
                            $('.cart-null').html(response.message);
                        }
                    },
                    error: function(xhr) {
                        alert('Đã xảy ra lỗi khi xóa giỏ hàng!');
                    }
                });
            });
        });
    </script>
@endsection
