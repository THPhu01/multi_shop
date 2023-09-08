@extends('client.layout')

@section('contentMain')
    <div class="container" style="height: 360px !important">
        <div class="row px-xl-12 mx-auto checkout-custom-container">
            <div class="checkout-custom-img"></div>
            <div class="checkout-custom-h2">
                <h2>Đặt hàng thành công !</h2>
            </div>
            <div class="checkout-custom-p">Cảm ơn quý khách đã đặt tại Multi Shop của chúng tôi</div>
            <div class="checkout-custom-p">Đội ngũ chăm sóc khách hàng sẽ liên hệ trong thời gian sớm nhất để xác nhận đơn
                hàng</div>
            <a href="{{ route('client.home') }}" class="checkout-custom-a"><button
                    class="btn btn-block btn-primary my-4 py-3 ">Quay lại trang chủ</button></a>
        </div>
    </div>
@endsection
