@extends('client.layout')

@section('contentMain')
    <div class="container-fluid">
        <form id="form_order">
            @csrf
            <div class="row px-xl-5">
                <div class="col-lg-7">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Thông tin
                            khách hàng</span></h5>
                    @if (Auth::check())
                        <div class="bg-light p-30 mb-5">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label>Họ và tên:</label>
                                    <input class="form-control" type="text" placeholder="Họ và tên"
                                        value=" {{ Auth::user()->name }}" name="name">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>E-mail:</label>
                                    <input class="form-control" type="text" placeholder="Email"
                                        value="{{ Auth::user()->email }}" name="email">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Số điện thoại:</label>
                                    <input class="form-control" type="text" placeholder="Số điện thoại" name="phone"
                                        value="{{ Auth::user()->phone }}">
                                </div>
                                <form>
                                    @csrf
                                    <div class="col-md-12 form-group">
                                        <label>Tỉnh/Thành phố:</label>
                                        <select class="form-control input-sm m-bot15 choose city price-feeship"
                                            name="city" id="city">
                                            <option value=""> -- Chọn Tỉnh/Thành phố --</option>
                                            @foreach ($city as $tp)
                                                <option value="{{ $tp->matp }}">{{ $tp->name_city }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Quận/Huyện:</label>
                                        <select name="quanhuyen" id="quanhuyen"
                                            class="form-control input-sm m-bot15 choose quanhuyen">
                                            <option value=""> -- Chọn Quận/Huyện --</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Phường/Xã:</label>
                                        <select name="phuongxa" id="phuongxa"
                                            class="form-control input-sm m-bot15 phuongxa">
                                            <option value=""> -- Chọn Phường/Xã --</option>
                                        </select>
                                    </div>

                                </form>
                                <div class="col-md-12 form-group">
                                    <label>Địa chỉ:</label>
                                    <input class="form-control" type="text" placeholder="Đia chỉ" name="address">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Ghi chú:</label>
                                    <textarea style="resize:none" rows="5" type="text" class="form-control" name="note" id="note"
                                        placeholder="Ghi chú ....."></textarea>
                                </div>

                            </div>
                        </div>
                    @endif

                </div>
                <div class="col-lg-5">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Thông
                            tin đơn hàng</span></h5>
                    @php
                        $product = Cart::content();
                    @endphp
                    <div class="bg-light p-30 mb-5">
                        <div class="border-bottom">
                            <h6 class="">Sản phẩm</h6>
                            @foreach ($product as $sp)
                                <div class="" style="padding: 12px 0;">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="{{ asset('upload/product') }}/{{ $sp->options->image }}"
                                                alt="" style="width: 60px;">
                                        </div>
                                        <p class="col-md-5" style="margin:auto 0px;"><a
                                                href="{{ route('client.shop.detail', [$sp->id]) }}"style="color:black">{{ $sp->name }}
                                            </a> </p>
                                        <em class="col-1" style="margin:auto 0px;font-size:14px">x{{ $sp->qty }}</em>
                                        <p class="col-3" style="margin:auto 0px;">
                                            {{ number_format($sp->price * $sp->qty, 0, '', '.') }}đ</p>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                        <div class="border-bottom pt-3 pb-2">
                            <div class="d-flex justify-content-between mb-3">
                                <h6>Tổng:</h6>
                                <h6>{{ number_format(Cart::subtotal(), 0, '', '.') }}đ</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Phí vận chuyển:</h6>
                                <span id="feeship">0đ</span>
                            </div>
                        </div>
                        <div class="pt-2">
                            <div class="d-flex justify-content-between mt-2">
                                <h5>Tổng đơn hàng:</h5>
                                <h5 id="total-final" style="color: red">{{ number_format(Cart::subtotal(), 0, '', '.') }}đ
                                </h5>
                            </div>
                        </div>
                        <input type="hidden" name="user_id" value=" {{ Auth::user()->id }}">
                        <input type="hidden" name="total" value="{{ Cart::subtotal() }}">
                    </div>
                    <div class="mb-5">
                        <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Hình
                                thức thanh toán</span></h5>
                        <div class="bg-light p-30">
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment" id="paypal"
                                        value="1">
                                    <label class="custom-control-label" for="paypal">
                                        Thanh toán khi nhận hàng</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment" id="directcheck"
                                        value="2">
                                    <label class="custom-control-label" for="directcheck">Thẻ tín dụng</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-block btn-primary py-3">Đặt
                                hàng</button>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>

    {{-- Chọn địa chỉ giao hàng --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('.choose').on('change', function() {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();

                var result = "";

                if (action == 'city') {
                    result = 'quanhuyen';
                } else {
                    result = 'phuongxa';
                }
                $.ajax({
                    url: '{{ route('client.select.delivery') }}',
                    method: 'POST',
                    data: {
                        action: action,
                        ma_id: ma_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#' + result).html(data);
                    }
                })
            });
        })
    </script>

    {{-- Cập nhật giá tiền vận chuyển --}}
    <script>
        var total = $('input[name="total"]').val();
        if (total != null) {
            $('.price-feeship').on('change', function() {
                var city = $('.city').val();
                var quan = $('.quanhuyen').val();
                var xa = $('.phuongxa').val();
                var _token = $('input[name="_token"]').val();
                total = Number(total);
                $.ajax({
                    url: '{{ route('client.price.delivery') }}',
                    method: 'POST',
                    data: {
                        city: city,
                        quan: quan,
                        xa: xa,
                        _token: _token,
                        total: total
                    },
                    success: function(data) {
                        var fee = Number(data);
                        $('#feeship').html(formatCurrency(fee));
                        var result = fee + total;
                        $("#total-final").html(formatCurrency(result));
                    }
                })

            })
        }
    </script>

    {{-- Xác nhận đơn đặt hàng --}}
    <script>
        $("#form_order").submit(function(e) {
            e.preventDefault();
            swal({
                    title: "Xác nhận đơn đặt hàng",
                    text: "Đơn hàng sẽ không được hoàn trả khi đặt,bạn có muốn đặt không? ",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Đặt hàng!",
                    cancelButtonText: "Hủy",
                    cancelButtonClass: "btn-secondary",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        var feeship = document.getElementById("feeship");
                        var note = document.getElementById("note");
                        var payment = document.getElementsByName('payment');
                        for (var i = 0; i < payment.length; i++) {
                            if (payment[i].checked) {
                                payment = payment[i].value;
                            }
                        }
                        var _token = $('input[name="_token"]').val();
                        var user_id = $('input[name="user_id"]').val();
                        var name = $('input[name="name"]').val();
                        var email = $('input[name="email"]').val();
                        var phone = $('input[name="phone"]').val();
                        var total = $('input[name="total"]').val();
                        var city = $('.city').val();
                        var quan = $('.quanhuyen').val();
                        var xa = $('.phuongxa').val();
                        var address = $('input[name="address"]').val();

                        feeship = feeship.innerHTML;
                        note = note.value;
                        feeship = feeship.replace(/[.,đ]/g, "");
                        $.ajax({
                            url: '{{ route('client.shop.orders') }}',
                            method: 'POST',
                            data: {
                                _token: _token,
                                user_id: user_id,
                                name: name,
                                email: email,
                                phone: phone,
                                city: city,
                                quan: quan,
                                xa: xa,
                                address: address,
                                note: note,
                                total: total,
                                feeship: feeship,
                                payment: payment,
                            },
                            success: function(data) {
                                swal("Thành công!", "Đơn hàng của bạn đã gửi thành công.",
                                    "success");
                            }
                        })
                        window.setTimeout(function() {
                            window.location.replace(
                                '{{ route('client.shop.orders.notification') }}'
                            );
                        }, 2000);
                    } else {
                        swal("Hủy", "Đơn hàng chưa được gửi, làm ơn hoàn tất đơn hàng", "error");
                    }
                });


        });
    </script>
@endsection
