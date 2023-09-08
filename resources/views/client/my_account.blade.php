@extends('client.layout')

@section('contentMain')
    <style>
        .accordion {
            margin-top: 50px;
            padding: 0 100px
        }

        .accordion-item {
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 16px;
        }

        .accordion-button {
            padding: 16px;
            background: #FFF;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            border-radius: 4px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .accordion-button i.icon {
            float: right;
            color: #FF5A5F;
        }

        /* Updated Accordion Content Styles */
        .accordion-content {
            padding: 0 16px;
            /* Set padding to 0 initially */
            max-height: 0;
            /* Set max-height to 0 */
            overflow: hidden;
            /* Hide overflow */
            transition: max-height 0.3s ease-out, padding 0.3s ease-out;
            /* Add transition effect */
            background: #f6f6f6;
            border-top: 1px solid #ccc;
            border-bottom-right-radius: 4px;
            border-bottom-left-radius: 4px;
        }

        /* New Class for Expanded Content */
        .accordion-content.show {
            max-height: 1100px;
            /* Set an appropriate max-height */
            padding: 16px;
            /* Reset the padding */
            transition: max-height 0.3s ease-in, padding 0.3s ease-in;
            /* Add transition effect */
        }
    </style>
    <div class="accordion">
        <!-- Accordion item 1 -->
        <div class="accordion-item">
            <button class="accordion-button">
                <h6>Thông tin tài khoản </h6>
                <i class="icon">+</i>
            </button>
            <div class="accordion-content">
                <p>Email: {{ Auth::user()->email }}</p>
                <p>Tên: {{ Auth::user()->name }}</p>
                <p>Số điện thoại: {{ Auth::user()->phone }}</p>
                <a href="{{ route('client.myAccount.info', [Auth::user()->id]) }}">
                    <button class=" btn btn-primary initialism p-2">Thay
                        đổi</button>
                </a>
            </div>
        </div>

        <div class="accordion-item">
            <button class="accordion-button">
                <h6>Lịch sử mua hàng</h6>
                <i class="icon">+</i>
            </button>
            <div class="accordion-content">
                <table class="table table-light table-borderless table-hover mb-0">
                    <thead class="thead-dark initialism">
                        <tr class=" text-center">
                            <th>Thông tin đơn hàng</th>
                            <th>Tổng đơn</th>
                            <th>Hình thức thanh toán</th>
                            <th>Trạng thái</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($listOrders as $order)
                            <tr class="cart-item">
                                <td style="width:420px">
                                    <ul>
                                        <li class="">Họ tên: {{ $order->full_name }}</li>
                                        <li class="">Email: {{ $order->email }}</li>
                                        <li class="">Phone: {{ $order->phone }}</li>
                                        <li class="">Address: {{ $order->address }}
                                        </li>
                                        <li class="">Ghi chú: {{ $order->note }}</li>
                                        <li style="font-weight: 700;">
                                            Ngày mua: {{ $order->created_at }}</li>
                                    </ul>
                                </td>
                                <td class="text-center align-middle" style="list-style: none;">
                                    <li class="text">
                                        {{ number_format($order->total + $order->feeship, 0, '', '.') }}đ
                                    </li>
                                    <li>(Bao gồm Ship:
                                        {{ number_format($order->feeship, 0, '', '.') }}đ)
                                    </li>
                                </td>
                                <td class="text-center align-middle">
                                    @if ($order->payment == 1)
                                        <span class="">Tiền mặt</span>
                                    @elseif($order->payment == 2)
                                        <span class=""> Thẻ tín dụng</span>
                                    @endif
                                </td>
                                <td class="text-center align-middle" style="width: 150px;">
                                    @if ($order->status == 1)
                                        <span class="label-info-order">Đang xử lí</span>
                                    @elseif($order->status == 2)
                                        <span class="label-secondary-order">Đang vận chuyển</span>
                                    @elseif($order->status == 3)
                                        <span class="label-success-order">Giao thành công</span>
                                    @elseif($order->status == 4)
                                        <span class="label-danger-order">Hủy đơn</span>
                                        @if (!empty($order->cancel_order))
                                            <p class="mt-1">Lí do: {{ $order->cancel_order }}</p>
                                        @endif
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    <div class="d-flex justify-content-around">
                                        <div>
                                            <button class="btn btn-sm btn-success btn-show-modal" id="show-modal"
                                                data-item-id="{{ $order->id }}" data-toggle="modal"
                                                data-target="#exampleModalCenter" title="Thông tin">Xem chi tiết</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>


                </table>
                <div class="col-12 pt-4">
                    <nav>
                        <ul class="pagination justify-content-center">
                            {{ $listOrders->appends(request()->all())->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>


    {{-- Modal Thong tin --}}
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="myaccountTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:1000px">

            <!-- Modal content -->
            <div class="modal-content p-4">
                <div id="orderDetail-myaccount">

                </div>
            </div>
        </div>
    </div>

    {{-- Modal Order Detail --}}

    </div>
    <!-- Include custom JS -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const accordionButtons = document.querySelectorAll('.accordion-button');

            // Open the first accordion item by default
            const firstContent = accordionButtons[0].nextElementSibling;
            firstContent.classList.add('show');
            const firstIcon = accordionButtons[0].querySelector('.icon');
            firstIcon.textContent = '-';

            accordionButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const content = this.nextElementSibling;

                    // Toggle the .show class to handle the transition
                    content.classList.toggle('show');

                    const icon = this.querySelector('.icon');
                    icon.textContent = icon.textContent === '+' ? '-' : '+';
                });
            });
        });

        const exampleModal = document.getElementById('exampleModal')
    </script>

    <script>
        $(document).ready(function() {
            $('.btn-show-modal').on('click', function() {
                var itemId = $(this).data('item-id');
                var url = "{{ route('client.orderDetail.myAccount', ':id') }}".replace(':id', itemId);
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'html',
                    success: function(data) {
                        // Đổ nội dung vào modal
                        $('#orderDetail-myaccount').html(data);
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
