@extends('admin.layout')

@section('contentMain')
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Danh sách <span style="font-size: 15px">({{ $orders->total() }} đơn
                                hàng)</span></h4>
                        <div class="input-group icons" style="width:250px;margin: 20px 0px;">

                            <input type="search" class="form-control" placeholder="Tìm kiếm..."
                                aria-label="Search Dashboard" style="border-radius: 20px">
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped verticle-middle" id="productDataTable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Thông tin</th>
                                        <th scope="col">Tổng đơn</th>
                                        <th scope="col">Hình thức thanh toán</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Ngày lập</th>
                                        <th scope="col">Tác vụ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td style="width: 260px;padding: 10px 20px;">
                                                <ul>
                                                    <li class="order-li-custom"> - Họ tên: {{ $order->full_name }}</li>
                                                    <li class="order-li-custom"> - Email: {{ $order->email }}</li>
                                                    <li class="order-li-custom"> - Phone: {{ $order->phone }}</li>
                                                    <li class="order-li-custom address-li"> - Address: {{ $order->address }}
                                                    </li>
                                                    <li class="order-li-custom"> - Ghi chú: {{ $order->note }}</li>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul style="text-align: center">
                                                    <li class="totalNewOrder_{{ $order->id }}">
                                                        {{ number_format($order->total + $order->feeship, 0, '', '.') }}đ
                                                    </li>
                                                    <li>(Bao gồm Ship:
                                                        {{ number_format($order->feeship, 0, '', '.') }}đ)
                                                    </li>
                                                </ul>
                                            </td>
                                            <td style="text-align: center;">
                                                @if ($order->payment == 1)
                                                    <span class="label label-pill label-success">Tiền mặt</span>
                                                @elseif($order->payment == 2)
                                                    <span class="label label-pill label-success"> Thẻ tín dụng</span>
                                                @endif
                                            </td>
                                            <td style="text-align: center;width: 108px;">
                                                @if ($order->status == 1)
                                                    <span class="label label-pill label-info">Đang xử lí</span>
                                                @elseif($order->status == 2)
                                                    <span class="label label-pill label-secondary">Đang vận chuyển</span>
                                                @elseif($order->status == 3)
                                                    <span class="label label-pill label-success">Giao thành công</span>
                                                @elseif($order->status == 4)
                                                    <span class="label label-pill label-danger">Hủy đơn</span>
                                                    @if (!empty($order->cancel_order))
                                                        <p class="mt-3">Lí do: {{$order->cancel_order}}</p>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                {{ $order->created_at }}
                                            </td>
                                            <td>
                                                <span>
                                                    <a href="" data-toggle="modal" data-target="#exampleModalCenter"
                                                        title="Thông tin" style="margin-right: 5px;"
                                                        class="ti-info-alt btn-show-modal"
                                                        data-item-id="{{ $order->id }}">
                                                    </a>
                                                    <a href="{{ route('admin.deleteOrder', [$order->id]) }}"
                                                        onclick="confirmation(event)" data-toggle="tooltip"
                                                        data-placement="top" title="Xóa" class="ti-trash">
                                                    </a>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="bootstrap-pagination">
                                <nav>
                                    <ul class="pagination justify-content-end">
                                        {{ $orders->appends(request()->all())->links() }}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalCenter" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:800px">
            <div class="modal-content" id="order-details"></div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.btn-show-modal').on('click', function() {
                var itemId = $(this).data('item-id');
                var url = "{{ route('admin.orderDetail', ':id') }}".replace(':id', itemId);
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'html',
                    success: function(data) {
                        // Đổ nội dung vào modal
                        $('#order-details').html(data);
                        // Mở modal
                        $('#exampleModalCenter').modal('show');
                    },
                    // error: function() {
                    //     alert('Đã xảy ra lỗi khi lấy thông tin phần tử.');
                    // }
                });
            });
        });
    </script>
@endsection
