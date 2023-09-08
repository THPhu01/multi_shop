@extends('admin.layout')

@section('contentMain')
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-1">
                    <div class="card-body" style="padding:20px !important; height:180px">
                        <h3 class="card-title text-white">Tổng sản phẩm</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{ $totalQty }}
                                <span class="float-right display-5 opacity-5"><i class="fa fa-solid fa-clipboard"></i></span>
                            </h2>
                            <p class="text-white mb-0">Số lượng sản phẩm trong kho</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-2">
                    <div class="card-body" style="padding:20px !important; height:180px">
                        <h3 class="card-title text-white">Tổng sản phẩm bán ra</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{ $totalSold }}
                                <span class="float-right display-5 opacity-5"><i class="fa fa-solid fa-database"></i></span>
                            </h2>
                            <p class="text-white mb-0">Số lượng sản phẩm đã bán</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-3">
                    <div class="card-body" style="padding:20px !important; height:180px">
                        <h3 class="card-title text-white">Doanh số đơn hàng</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white" style="font-size: 25px !important;">
                                {{ number_format($totalPriceOrder, 0, '', '.') }}đ
                                <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                            </h2>
                            <p class="text-white mb-0">Doanh số hệ thống</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-4">
                    <div class="card-body" style="padding:20px !important; height:180px">
                        <h3 class="card-title text-white">Bình luận sản phẩm</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{ $comment->count() }}
                                <span class="float-right display-5 opacity-5"><i class="fa fa-sharp fa-solid fa-comment"></i></span>

                            </h2>
                            <p class="text-white mb-0">{{ $commentFeedback->count() }} bình luận chưa phản hồi</p>
                            <p class="text-white mb-0">{{ $commentReply->count() }} bình luận đã phản hồi</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-5">
                    <div class="card-body" style="padding:20px !important; height:180px">
                        <h3 class="card-title text-white">Đơn hàng xử lí</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{ $order1->count() }}
                                <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>

                            </h2>
                            <p class="text-white mb-0">Đơn hàng đang xử lí</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-6">
                    <div class="card-body" style="padding:20px !important; height:180px">
                        <h3 class="card-title text-white">Đơn hàng vận chuyển</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{ $order2->count() }}
                                <span class="float-right display-5 opacity-5"><i class="fa fa-solid fa-truck"></i></span>

                            </h2>
                            <p class="text-white mb-0">Đơn hàng đang vận chuyển</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-7">
                    <div class="card-body" style="padding:20px !important; height:180px">
                        <h3 class="card-title text-white">Đơn hàng thành công</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{ $order3->count() }}
                                <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>

                            </h2>
                            <p class="text-white mb-0">Đơn hàng giao thành công</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-7">
                <div class="card gradient-8">
                    <div class="card-body" style="padding:20px !important; height:180px">
                        <h3 class="card-title text-white">Đơn hàng hủy</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{ $order4->count() }}
                                <span class="float-right display-5 opacity-5"><i class="fa fa-trash"></i></span>

                            </h2>
                            <p class="text-white mb-0">Đơn hàng bị hủy</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-xl-6 col-lg-12 col-sm-12 col-xxl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-0">Store Location</h4>
                        <div id="world-map" style="height: 470px;"></div>
                    </div>
                </div>
            </div>
        </div>




    </div>
@endsection
