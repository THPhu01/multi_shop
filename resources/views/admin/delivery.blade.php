@extends('admin.layout')

@section('contentMain')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="form-valide" action="" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-skill">Thành phố<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <select class="form-control choose city" id="city" name="city">
                                            <option value="">-- Chọn thành phố --</option>
                                            @foreach ($city as $tp)
                                                <option value="{{ $tp->matp }}">{{ $tp->name_city }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-skill">Quận huyện<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <select class="form-control choose quanhuyen" id="quanhuyen" name="quanhuyen">
                                            <option value="">-- Chọn quận huyện --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-skill">Phường xã<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <select class="form-control phuongxa" id="phuongxa" name="phuongxa">
                                            <option value="">-- Chọn xã phường --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Phí vận chuyển <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="number" class="form-control feeship" id="" name="feeship"
                                            placeholder="Nhập phí vận chuyển.." value="">
                                        <span class="feeship_error"
                                            style="display: block;color: red;margin-top:10px"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="button" name="add_delivery" class="btn btn-primary add_delivery">Thêm
                                            mới</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" id="info-feeship">

    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.add_delivery').click(function() {
                var city = $('.city').val();
                var quan = $('.quanhuyen').val();
                var xa = $('.phuongxa').val();
                var feeship = $('.feeship').val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: '{{ route('admin.create.delivery') }}',
                    method: 'POST',
                    data: {
                        city: city,
                        quan: quan,
                        xa: xa,
                        feeship: feeship,
                        _token: _token
                    },
                    success: function(data) {
                        fetch_delivery();
                    }
                })

            });
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
                    url: '{{ route('admin.select.delivery') }}',
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
            })

            function fetch_delivery() {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ route('admin.show.delivery') }}',
                    method: 'POST',
                    data: {
                        _token: _token
                    },
                    success: function(data) {
                        $('#info-feeship').html(data);

                    }
                })
            }
            fetch_delivery();
        })
        $(document).on('blur', '.fee_feeship_edit', function() {
            var feeship_id = $(this).data('feeship_id');
            var fee_value = $(this).text();
            var _token = $('input[name="_token"]').val();

            // alert(feeship_id);
            // alert(fee_value);
            $.ajax({
                url: '{{ route('admin.update.delivery') }}',
                method: 'POST',
                data: {
                    feeship_id: feeship_id,
                    fee_value: fee_value,
                    _token: _token
                },
                success: function(data) {
                    fetch_delivery();
                }
            })

        })
    </script>
@endsection
