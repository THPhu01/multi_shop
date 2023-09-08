@extends('admin.layout')

@section('contentMain')
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Danh sách <span style="font-size: 15px">({{ $comments->count() }} bình
                                luận)</span></h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped verticle-middle" id="productDataTable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tên người gửi</th>
                                        <th scope="col">Nôi dung bình luận</th>
                                        <th scope="col">Sản phẩm</th>
                                        <th scope="col">Ngày gửi</th>
                                        <th scope="col">Tác vụ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($comments as $comment)
                                        @if (empty($comment->parent_id))
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td style="width: 85px;">
                                                    @if ($comment->status == 2)
                                                        <ul>
                                                            <li>{{ $comment->name }}</li>
                                                            <li class=" mt-2">
                                                                <span class="label label-info">Duyệt</span>
                                                            </li>
                                                        </ul>
                                                    @else
                                                        <ul>
                                                            <li>{{ $comment->name }}</li>
                                                            <li class=" mt-2">
                                                                <span class="label label-danger">Chưa duyệt</span>

                                                            </li>
                                                        </ul>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="d-block mt-3">
                                                        -{{ $comment->name }}:
                                                        {{ $comment->comment }}
                                                    </span>
                                                    <ul>

                                                        @foreach ($comments as $reply)
                                                            @if ($reply->parent_id === $comment->id)
                                                                <li
                                                                    style="list-style-type: decimal;margin: 5px 40px;color: blue;">
                                                                    Trả lời: {{ $reply->name }}: {{ $reply->comment }}
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                    @if ($comment->status == 1)
                                                        <form action="{{ route('admin.replyComment') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" value="{{ $comment->id }}"
                                                                name="comment_id">
                                                            <input type="hidden" value="{{ $comment->product_id }}"
                                                                name="comment_product_id">
                                                            <textarea class="w-100 mt-3" placeholder="Phản hồi bình luận..." rows="6" name="comment_content"></textarea>
                                                            <br>
                                                            <button type="submit"
                                                                class="btn mt-2 mb-1 btn-flat btn-outline-primary">Phản hồi
                                                                bình
                                                                luận</button>
                                                        </form>
                                                    @endif

                                                </td>
                                                <td style="text-align: center;">
                                                    <ul>
                                                        <li>
                                                            <img src="{{ asset('upload/product') }}/{{ $comment->productComment->image }}"
                                                                alt="" style="width:80px">
                                                        </li>
                                                    </ul>
                                                    {{ $comment->productComment->name }}
                                                </td>
                                                <td>
                                                    {{ $comment->created_at }}
                                                </td>
                                                <td>
                                                    <span>
                                                        <a href="{{ route('admin.deleteComment', [$comment->id]) }}"
                                                            onclick="confirmation(event)" data-toggle="tooltip"
                                                            data-placement="top" title="Xóa">
                                                            <i class="fa fa-close color-danger"></i>
                                                        </a>
                                                    </span>
                                                </td>
                                            </tr>
                                        @endif
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
