@extends('layouts.backend')
@section('title')
    Admin | Banner Setup
@endsection

@section('extra_css')
    <style type="text/css">
        .richIMG img {
            width: 100%;
        }

        .ads__img {
            max-height: 100px;
            max-width: 250px;
        }

    </style>
@endsection

@section('extra_js')
    <script>
        $(document).ready(function () {
            $('#lfm').filemanager('image');
            $('#feature_lfm').filemanager('image');
        });
    </script>
    <script>
        $(document).ready(function () {
            $('.toggle_banner_status').change(function () {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).attr("data-id");
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('banner_status_toggle') }}",
                    data: {'status': status, 'id': id},
                    success: function (data) {
                        toastr.success(data.success)
                    }
                });
            });
        })
    </script>
@endsection

@section('content')
    <main>
        <div class="container-fluid">
            <div class="row justify-content-center">
                @include('back.parts.message')
                <div class="col-lg-4">
                    <div class="card shadow-lg border-0 rounded-lg mt-3 mb-3">
                        <div class="card-header"><h4 class="text-center font-weight-light my-1">Edit Banner</h4>
                        </div>
                        <div class="card-body">
                            <form role="form" method="post" action="{{ route('banner.update',['id'=>$edit->id]) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-3" for="name">Name <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input class=" form-control" name="name" value="{{$edit->name}}"
                                               placeholder="Name" type="text"
                                               autocomplete="off" required>
                                        <span class="text-danger">{{ $errors->has('name') ? $errors->first('name'):''}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3" for="status">Banner <span
                                                class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <div class="input-group ">
                                            <input id="featured_image" class="form-control" maxlenght="250" type="text"
                                                   name="banner" value="{{$edit->banner}}">
                                            <span class="input-group-btn"> <a id="feature_lfm"
                                                                              data-input="featured_image"
                                                                              data-preview="holder"
                                                                              class="btn btn-primary btn-height"> <i
                                                            class="fa fa-image"></i> Choose </a> </span>

                                        </div>

                                        <span class="text-danger">{{ $errors->has('banner') ? $errors->first('banner'):''}}</span>
                                    </div>
                                </div>
                                <button type="submit" class="float-right btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div> <!--col-6-->

                <div class="col-lg-8">
                    <div class="card shadow-lg border-0 rounded-lg mt-3 mb-3">
                        <div class="card-header">
                            <h4 class="text-center font-weight-light my-1">All Banner</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th style="width: 200px">Name</th>
                                        <th class="text-center">Banner</th>
                                        <th class="text-center" style="width: 80px">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach(\App\Models\Banner::orderBy('id','asc')->get() as $row)
                                        <tr>
                                            <td style="text-transform: capitalize">{{$row->name}}</td>
                                            <td class="text-center"><img src="{{ $row->banner }}"
                                                                         style="border-radius:4px;width:auto;height:40px;">
                                            </td>
                                            <td class="text-center">
                                                <label class="switch">
                                                    <input id="banner_status" class="toggle_banner_status"
                                                           data-id="{{$row->id}}"
                                                           type="checkbox" {{ $row->status == 1 ? 'checked' : '' }} >
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('banner.edit', ['id' => $row->id])}}"
                                                   class="btn btn-soft-primary btn-icon btn-circle btn-sm"><i
                                                            class="fa fa-edit"></i></a>
                                                <a href="{{ route('banner.delete', ['id' => $row->id])}}"
                                                   onclick="return confirm('Are you sure to delete this!')"
                                                   class="btn btn-soft-danger btn-icon btn-circle btn-sm"><i
                                                            class="fa fa-trash"></i> </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> <!--col-6-->

            </div>
        </div>
    </main>
@endsection
