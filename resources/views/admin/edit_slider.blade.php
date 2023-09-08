@extends('admin.layout')

@section('contentMain')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="form-valide"
                                action="{{ route('admin.updateSlider', [$editSlider->id]) }}"method="POST"
                                novalidate="novalidate" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Ảnh Slider<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="file" class="form-control" id="image" name="image"
                                            value="{{ $editSlider->image }}">
                                        <img src="{{ asset('upload/slider') }}/{{ $editSlider->image }}" alt=""
                                            style="width:100px;height:100px">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-skill">Thuộc danh mục<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <select class="form-control" id="val-skill" name="category_id">
                                            <option value="4">
                                                Trang chủ
                                            </option>
                                            @foreach ($category as $ct)
                                                <option value="{{ $ct->id }}">{{ $ct->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
