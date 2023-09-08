    <h4 class="modal-title">Chi tiết đơn hàng</h4>
    <table class="table table-light table-borderless table-hover text-center mb-0">
        <thead class="thead-dark initialism">
            <tr>
                <th>Ảnh Sản phẩm</th>
                <th>Tên Sản phẩm</th>
                <th>Đơn Giá</th>
                <th>Số Lượng</th>
                <th>Tổng</th>
            </tr>
        </thead>

        <tbody class="align-middle">
            @php
                $total_final = 0;
            @endphp
            @foreach ($orderDetail as $sp)
                @php
                    $subtotal = $sp->price * $sp->qty;
                    $total_final += $subtotal;
                @endphp
                <form>
                    @csrf
                    <tr class="cart-item">
                        <td data-th="Image" class="align-middle">
                            <img src="{{ asset('upload/product') }}/{{ $sp->orderProduct->image }}" alt=""
                                style="width: 60px;">
                        </td>
                        <td class="align-middle">

                            <a href="{{ route('client.shop.detail', [$sp->id]) }}"class="wishlist-a decoration-none">{{ $sp->name }}
                            </a>

                        </td>
                        <td class="align-middle">
                            {{ number_format($sp->price, 0, '', '.') }}đ
                        </td>
                        <td class="align-middle">
                            {{ $sp->qty }}
                        </td>
                        <td class="align-middle totalSp_{{ $sp->rowId }}">
                            {{ number_format($sp->price * $sp->qty, 0, '', '.') }}<span class="price">đ</span>
                        </td>
                    </tr>
                </form>
            @endforeach
            <span class="order_detail_total">
                <h6 style="font-weight:700 !important;padding: 10px 0;">
                    Tổng chi tiết đơn hàng: {{ number_format($total_final, 0, '', '.') }}đ
                </h6>
                <div class="mb-3">
                    @if ($order->status == 4 || $order->status == 3)
                    @else
                    <button class="btn btn-sm btn-danger btn-show-cancel" data-toggle="modal"
                        data-target="#cancelorder">Hủy đơn
                        hàng</button>
                    @endif
                </div>
            </span>

            {{-- Modal Hủy đơn hàng --}}
            <div class="modal fade" id="cancelorder" tabindex="-1" role="dialog" aria-labelledby="myaccountTitle"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered text-center" role="document">

                    <!-- Modal content -->
                    <div class="modal-content w-100">
                        <div class="modal-header">
                            <h5 class="modal-title">Lý do hủy đơn hàng</h5>
                        </div>
                        <form action="" style="margin-top:0px"> 
                            @csrf
                            <div class="modal-body">
                                <textarea class="w-100 p-2 cancel-order" name="" id="" rows="5"
                                    placeholder="Lý do hủy đơn hàng...(bắt buộc)"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button id="{{ $order->id }}" onclick="cancelOrder(this.id)"
                                    class="btn btn-sm btn-success p-2">Gửi lý do
                                    hủy
                                    đơn</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </tbody>

    </table>

    <script>
        function cancelOrder(id) {
            var order_id = id;
            var cancel = $('.cancel-order').val();
            var status = 4;
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: '{{ route('client.myAccount.cancelOrder') }}',
                method: 'POST',
                data: {
                    order_id: order_id,
                    cancel: cancel,
                    status: status,
                    _token: _token,
                },
                success: function(data) {
                    toastr.success('Hủy đơn hàng thành công!')
                    window.setTimeout(function() {
                        window.location.reload();
                    }, 500);
                }
            })
        }
    </script>
