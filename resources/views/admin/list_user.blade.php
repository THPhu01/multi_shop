@extends('admin.layout')

@section('contentMain')
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Danh sách User <span style="font-size: 15px">({{ $users->total() }} User)</span></h4>
                        </div>
                        <div class="input-group icons" style="width:250px;margin: 20px 0px;">

                            <input type="search" class="form-control" placeholder="Tìm kiếm..."
                                aria-label="Search Dashboard" style="border-radius: 20px">
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped verticle-middle">
                                <thead>
                                    <tr style="text-align: center">
                                        <th scope="col">#</th>
                                        <th scope="col">Tên User</th>
                                        @foreach ($roles as $role)
                                            <th scope="col">
                                                <ul>
                                                    <li> {{ $role->name }}</li>
                                                    <li> ({{ $role->desc }})</li>
                                                </ul>

                                            </th>
                                        @endforeach
                                        <th scope="col">Tác vụ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <form action="{{ route('admin.updateRoleUser') }}" method="POST">
                                            @csrf
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>
                                                    <ul>
                                                        <li class="order-li-custom"> - Họ tên: {{ $user->name }}</li>
                                                        <li class="order-li-custom"> - Email: {{ $user->email }}</li>
                                                        <li class="order-li-custom"> - Phone: {{ $user->phone }}</li>
                                                    </ul>
                                                </td>
                                                <input type="hidden" name="email" value="{{ $user->email }}">
                                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                <td style="text-align: center">
                                                    <input type="checkbox" name="admin_role"
                                                        {{ $user->hasRole('Admin') ? 'checked' : '' }}>
                                                </td>
                                                <td style="text-align: center">
                                                    <input type="checkbox" name="author_role"
                                                        {{ $user->hasRole('Author') ? 'checked' : '' }}>
                                                </td>

                                                <td style="text-align: center">
                                                    <input type="checkbox" name="guest_role"
                                                        {{ $user->hasRole('Guest') ? 'checked' : '' }}>
                                                </td>
                                                </td>
                                                <td style="text-align: center">
                                                    <div>
                                                        <button type="submit"
                                                            class="btn mb-1 btn-flat btn-outline-success">Phân
                                                            quyền</button>
                                                        <a href="{{ route('admin.deleteUser', [$user->id]) }}"
                                                            onclick="confirmation(event)" data-toggle="tooltip"
                                                            data-placement="top" title="Xóa">
                                                            <button type="submit"
                                                                class="btn mb-1 btn-flat btn-outline-danger">Xóa</button>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </form>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="bootstrap-pagination">
                                <nav>
                                    <ul class="pagination justify-content-end">
                                        {{ $users->appends(request()->all())->links() }}
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
