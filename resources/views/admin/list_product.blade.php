@extends('admin.layout')

@section('contentMain')
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Danh sách <span style="font-size: 15px">({{ $product->count() }} sản
                                phẩm)</span></h4>
                        <div class="input-group icons" style="width:250px;margin: 20px 0px;">
                            {{-- <input type="search" class="form-control" placeholder="Tìm kiếm..."
                                aria-label="Search Dashboard" style="border-radius: 20px"> --}}
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped verticle-middle" id="productDataTable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Tên danh mục</th>
                                        <th scope="col">Tên thương hiệu</th>
                                        <th scope="col">Giá sản phẩm</th>
                                        <th scope="col">Giảm giá (%)</th>
                                        <th scope="col">Ảnh</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Tác vụ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product as $sp)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td style="width: 200px;">
                                                <ul>
                                                    <li class="font-weight-bold" style="line-height: 24px;">
                                                        {{ $sp->name }}</li>
                                                    <li style="margin-top:4px">Kho Sl: {{ $sp->qty }}</li>
                                                    <li style="margin-top:4px">Đã bán: {{ $sp->sold }}</li>
                                                    <li style="margin-top:4px">
                                                        <button class="btn mb-1 btn-rounded btn-success">
                                                            <span class="btn-icon-left" style="margin-right: 5px;">
                                                                <i class="fa fa-upload color-success"></i>
                                                            </span>
                                                            <a href="{{ route('admin.productGallery', [$sp->id]) }}"
                                                                style="color: white;">
                                                                Thêm thư viện ảnh</a>
                                                        </button>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                <span class="label label-secondary" style="padding: 5px 5px;">
                                                    {{ $sp->productCategory->name }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="label label-info" style="padding: 5px 5px;">
                                                    {{ $sp->productBrand->name }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($sp->price_sale != 0)
                                                    <div>
                                                        <div>
                                                            <del>
                                                                {{ number_format($sp->price, 0, '', '.') }}đ
                                                            </del>
                                                        </div>
                                                        <div>
                                                            <span style="color: red">
                                                                {{ number_format($sp->price_sale, 0, '', '.') }}đ
                                                            </span>
                                                        </div>
                                                    </div>
                                                @else
                                                    {{ number_format($sp->price, 0, '', '.') }}
                                                    <span class="price">đ</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($sp->percent != 0)
                                                    <span class="label label-warning" style="padding: 5px 5px;">
                                                        {{ $sp->percent }}%
                                                    </span>
                                                @else
                                                    <span class="label label-warning" style="padding: 5px 5px;">
                                                        0%
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <img src="{{ asset('upload/product') }}/{{ $sp->image }}"
                                                    alt="" style="width:108px">
                                            </td>
                                            <td>
                                                @if ($sp->status == 2)
                                                    <a href="{{ route('admin.unActiveProduct', [$sp->id]) }}">
                                                        <i
                                                            class="fa fa-regular fa-eye-slash"style="color: red;font-size: 20px;margin-left: 10px;">
                                                        </i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('admin.activeProduct', [$sp->id]) }}">
                                                        <i
                                                            class="fa fa-regular fa-eye"style="color: green;font-size: 20px;margin-left: 10px;">
                                                        </i>
                                                    </a>
                                                @endif
                                            </td>

                                            <td>
                                                <span>
                                                    <a href="{{ route('admin.editProduct', [$sp->id]) }}"
                                                        data-toggle="tooltip" data-placement="top" title="Edit"
                                                        style="margin-right: 5px;">
                                                        <i class="fa fa-pencil color-muted m-r-5"></i>
                                                    </a>
                                                    <a href="{{ route('admin.deleteProduct', [$sp->id]) }}"
                                                        onclick="confirmation(event)" data-toggle="tooltip"
                                                        data-placement="top" title="Delete">
                                                        <i class="fa fa-close color-danger"></i>
                                                    </a>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="bootstrap-pagination">
                                <nav>
                                    {{-- <ul class="pagination justify-content-end">
                                        {{ $product->appends(request()->all())->links() }}
                                    </ul> --}}
                                </nav>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
