@extends('admin.layout')

@section('contentMain')
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Danh sách <span style="font-size: 15px">({{ $brands->total() }} thương hiệu)</span></h4>
                        <div class="input-group icons" style="width:250px;margin: 20px 0px;">

                            <input type="search" class="form-control" placeholder="Tìm kiếm..."
                                aria-label="Search Dashboard" style="border-radius: 20px">
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped verticle-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tên danh mục</th>
                                        <th scope="col">Ảnh</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Tác vụ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($brands as $brand)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $brand->name }}</td>
                                            <td>
                                                <img src="{{ asset('upload/brand') }}/{{ $brand->image }}" alt=""
                                                    style="width:108px">
                                            </td>
                                            <td>
                                                @if ($brand->status == 2)
                                                    <a href="{{ route('admin.unActiveBrand', [$brand->id]) }}">
                                                        <i
                                                            class="fa fa-regular fa-eye-slash"style="color: red;font-size: 20px;margin-left: 10px;">
                                                        </i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('admin.activeBrand', [$brand->id]) }}">
                                                        <i
                                                            class="fa fa-regular fa-eye"style="color: green;font-size: 20px;margin-left: 10px;">
                                                        </i>
                                                    </a>
                                                @endif
                                            </td>

                                            <td>
                                                <span>
                                                    <a href="{{ route('admin.editBrand', [$brand->id]) }}"
                                                        data-toggle="tooltip" data-placement="top" title="Edit"
                                                        style="margin-right: 5px;">
                                                        <i class="fa fa-pencil color-muted m-r-5"></i>
                                                    </a>
                                                    <a href="{{ route('admin.deleteBrand', [$brand->id]) }}"
                                                        onclick="confirmation(event)" data-toggle="tooltip"
                                                        data-placement="top" title="Xóa">
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
                                    <ul class="pagination justify-content-end">
                                        {{ $brands->appends(request()->all())->links() }}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
