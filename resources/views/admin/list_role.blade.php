@extends('admin.layout')

@section('contentMain')
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Danh sách vai trò</h4>
                            <a href="{{ route('admin.createRole') }}"> <button
                                    class="btn mb-1 btn-flat btn-outline-success">Thêm mới</button></a>
                        </div>
                        <div class="input-group icons" style="width:250px;margin: 20px 0px;">

                            <input type="search" class="form-control" placeholder="Tìm kiếm..."
                                aria-label="Search Dashboard" style="border-radius: 20px">
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped verticle-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tên vai trò</th>
                                        <th scope="col">Mô tả</th>
                                        <th scope="col">Tác vụ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>
                                                {{ $role->name }}
                                            </td>
                                            <td>
                                                {{ $role->desc }}
                                            </td>

                                            <td>
                                                <span>
                                                    <a href="{{ route('admin.editRole', [$role->id]) }}"
                                                        data-toggle="tooltip" data-placement="top" title="Edit"
                                                        style="margin-right: 5px;">
                                                        <i class="fa fa-pencil color-muted m-r-5"></i>
                                                    </a>
                                                    <a href="{{ route('admin.deleteRole', [$role->id]) }}"
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
