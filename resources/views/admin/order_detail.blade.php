<div class="modal-header">
    <h4 class="modal-title">Chi tiết đơn hàng</h4>

</div>
<div class="table-responsive" style="padding: 10px;">
    <table class="table table-bordered table-striped verticle-middle">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Ảnh</th>
                <th scope="col">Giá</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Tổng</th>
                <th scope="col">Tác vụ</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_final = 0;
            @endphp
            @foreach ($orderDetail as $sp)
                @php
                    $subtotal = $sp->price * $sp->qty;
                    $total_final += $subtotal;
                @endphp
                <tr class="qty_color_{{ $sp->product_id }}">
                    <td>#{{ $sp->product_id }}</td>
                    <td>
                        <ul>
                            <li class="font-weight-bold" style="line-height: 24px;">{{ $sp->name }}</li>
                            <li style="margin-top:4px">Kho SL: {{ $sp->orderProduct->qty }}</li>
                            <li style="margin-top:4px">Đã bán: {{ $sp->orderProduct->sold }}</li>
                        </ul>
                    </td>
                    <td>
                        <img src="{{ asset('upload/product') }}/{{ $sp->orderProduct->image }}" alt=""
                            style="width:64px;height:64px">
                    </td>
                    <td>{{ number_format($sp->price, 0, '', '.') }}đ</td>
                    <td style="text-align: center">
                        <form action="">
                            @csrf
                            <input type="number" {{ $sp->orderInfo->status == 3 ? 'disabled' : '' }} name="qty"
                                min="1" class="qty_order_{{ $sp->product_id }}" value="{{ $sp->qty }}"
                                style="width:60px">

                            <input type="hidden" name="product_id" class="product_id" value="{{ $sp->product_id }}">

                            <input type="hidden" name="qty_storage" class="qty_storage_{{ $sp->product_id }}"
                                value="{{ $sp->orderProduct->qty }}">


                            <input type="hidden" name="order_id" class="order_id" value="{{ $sp->order_id }}">
                            @if ($sp->orderInfo->status != 3)
                                <button type="button" class="btn mt-2 btn-info update_qty_order_detail"
                                    name="update_qty_order_detail" data-product_id="{{ $sp->product_id }}">Cập
                                    nhật</button>
                            @endif
                        </form>
                    </td>
                    <td>
                        <span id="total-final"
                            class="totalNew_{{ $sp->product_id }}">{{ number_format($sp->price * $sp->qty, 0, '', '.') }}đ</span>
                        <input type="hidden" name="price" class="price_{{ $sp->product_id }}"
                            value="{{ $sp->price }}">


                    </td>
                    <td style="text-align: center">
                        <span>
                            <a href="{{ route('admin.deleteOrderDetail', [$sp->id]) }}" onclick="confirmation(event)"
                                data-toggle="tooltip" data-placement="top" title="Xóa" class="ti-trash">
                            </a>
                        </span>
                    </td>
                </tr>
            @endforeach
            <span class="order_detail_total">
                <h6 style="font-weight:700 !important">
                    Tổng chi tiết đơn hàng: {{ number_format($total_final, 0, '', '.') }}đ
                </h6>
            </span>
            <input type="hidden" name="order_feeship" class="order_feeship" value="{{ $sp->orderInfo->feeship }}">
        </tbody>
    </table>
</div>
<div class="modal-footer" style="justify-content: space-between;">
    <div>
        @if ($order->status == 1)
            <form action="">
                @csrf
                <select class="form-control order_detail_status" id="" name="">
                    <option id="{{ $order->id }}" selected value="1">Đang xử lí</option>
                    <option id="{{ $order->id }}" value="2">Đang vận chuyển</option>
                    <option id="{{ $order->id }}" value="3">Giao thành công</option>
                    <option id="{{ $order->id }}" value="4">Hủy đơn hàng</option>
                </select>
            </form>
        @elseif($order->status == 2)
            <form action="">
                @csrf
                <select class="form-control order_detail_status" id="" name="">
                    <option id="{{ $order->id }}" value="1">Đang xử lí</option>
                    <option id="{{ $order->id }}" value="2" selected>Đang vận chuyển</option>
                    <option id="{{ $order->id }}" value="3">Giao thành công</option>
                    <option id="{{ $order->id }}" value="4">Hủy đơn hàng</option>
                </select>
            </form>
        @elseif($order->status == 3)
            <form action="">
                @csrf
                <select class="form-control order_detail_status" id="" name="">
                    <option id="{{ $order->id }}" value="1">Đang xử lí</option>
                    <option id="{{ $order->id }}" value="2">Đang vận chuyển</option>
                    <option id="{{ $order->id }}" value="3" selected>Giao thành công</option>
                    <option id="{{ $order->id }}" value="4">Hủy đơn hàng</option>
                </select>
            </form>
        @elseif($order->status == 4)
            <form action="">
                @csrf
                <select class="form-control order_detail_status" id="" name="">
                    <option id="{{ $order->id }}" value="1">Chờ xác nhận</option>
                    <option id="{{ $order->id }}" value="2">Đang vận chuyển</option>
                    <option id="{{ $order->id }}" value="3">Giao thành công</option>
                    <option id="{{ $order->id }}" value="4" selected>Hủy đơn hàng</option>
                </select>
            </form>
        @endif
        </td>
    </div>
    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
</div>

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
    $('.order_detail_status').change(function() {
        var order_status = $(this).val();
        var order_id = $(this).children(':selected').attr('id');
        var _token = $('input[name="_token"]').val();

        //lấy số lượng
        var qty = [];
        $('input[name="qty"]').each(function() {
            qty.push($(this).val());
        });
        //lấy id product_id
        var product_id = [];
        $('input[name="product_id"]').each(function() {
            product_id.push($(this).val());
        });

        j = 0;
        for (i = 0; i < product_id.length; i++) {
            //sl khach dat
            var order_qty = $('.qty_order_' + product_id[i]).val();
            //sl kho
            var order_qty_storage = $('.qty_storage_' + product_id[i]).val();

            if (parseInt(order_qty) > parseInt(order_qty_storage)) {
                j = j + 1;
                if (j == 1) {
                    swal("Cảnh báo!", "Số lượng sản phẩm kho không đủ!", "error")
                }
                $('.qty_color_' + product_id[i]).css('background-color', '#ff5e5e')

            }
        }
        if (j == 0) {
            $.ajax({
                url: '{{ route('admin.updateQtyStatusOrderDetail') }}',
                method: 'POST',
                data: {
                    _token: _token,
                    qty: qty,
                    product_id: product_id,
                    order_id: order_id,
                    order_status: order_status
                },
                success: function(data) {
                    location.reload();
                }
            });
        }



    });


    $('.update_qty_order_detail').click(function() {
        var product_id = $(this).data('product_id');
        var product_qty = $('.qty_order_' + product_id).val();
        var price = $('.price_' + product_id).val();
        var order_id = $('.order_id').val();
        var _token = $('input[name="_token"]').val();
        var order_feeship = $('input[name="order_feeship"]').val();
        price = Number(price);
        product_qty = Number(product_qty);
        order_feeship = Number(order_feeship);


        total = product_qty * price;

        $.ajax({
            url: '{{ route('admin.updateQtyOrderDetail') }}',
            method: 'POST',
            data: {
                _token: _token,
                product_id: product_id,
                product_qty: product_qty,
                order_id: order_id,
                total: total,
                order_feeship: order_feeship
            },
            success: function(data) {
                total = Number(data.total);
                totalNewOrder = Number(data.order_total);
                totalNewOrderDetail = Number(data.order_detail_total);
                $('.totalNew_' + data.product_id).html(formatCurrency(total));
                $('.totalNewOrder_' + data.order_id).html(formatCurrency(totalNewOrder));
                $('.order_detail_total').html('<h6 class>Tổng chi tiết đơn hàng: ' + formatCurrency(
                    totalNewOrderDetail) + '</h6>').css('font-weight', '700 !important');

            }
        });
    });
</script>
