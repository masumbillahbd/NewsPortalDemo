@extends('layouts.backend')
@section('title')
    Admin | Inner content ads
@endsection

@section('extra_css')

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <style type="text/css">
        .richIMG img {
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <main>
        <div class="container-fluid">
            <div class="row justify-content-center">
                @include('back.parts.message')
                <div class="col-lg-4">
                    <div class="card shadow-lg border-0 rounded-lg mt-4 mb-3">
                        <div class="card-header"><h4 class="text-center font-weight-light my-1">Inner Ads</h4></div>
                        <div class="card-body">
                            <form role="form" name="form" method="post"
                                  cf  enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">
                                    <label class="col-md-3" for="url">URL <span class="text-danger"></span></label>
                                    <div class="col-md-9">
                                        <input type="text" name="url" value="" class="form-control"/>
                                        <span class="text-danger">{{ $errors->has('url') ? $errors->first('url'):''}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3" for="status">Status <span
                                                class="text-danger"></span></label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="status">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                        <span class="text-danger">{{ $errors->has('status') ? $errors->first('status'):''}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3" for="photo">Photo<span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="file" name="photo" class="getInputFile" id="validatedCustomFile"
                                               hidden/>
                                        <label class="my_file-label" for="validatedCustomFile"><i
                                                    class="fas fa-cloud-upload-alt"></i> Upload</label>
                                        <span id="my-file-chosen"></span>
                                        <br>
                                        <label class="pt-1" id="profileLabel" for="photo">
                                        </label>
                                        <span class="text-danger">{{ $errors->has('photo') ? $errors->first('photo'):''}}</span>

                                        <img class="image-preview" style="width: 100px;height: auto;" src="">
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
                            <h4 class="text-center font-weight-light my-1">Inner Ads</h4>
                        </div>
                        <hr>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">URL</th>
                                        <th class="text-center">Ads</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(\App\Models\InnerAd::orderBy('id','desc')->get() as $row)
                                        <tr>
                                            <td class="text-center" style="text-transform: capitalize;">{{$row->status == 1 ?'active':'inactive' }}</td>
                                            <td class="text-center">{{$row->url }}</td>
                                            <td class="text-center"><img src="{{ asset('/ads/'.$row->photo) }}" style="max-width:250px;">
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('innerAd.edit', ['id' => $row->id])}}"
                                                   class="btn btn-soft-primary btn-icon btn-circle btn-sm"><i
                                                            class="fa fa-edit"></i></a>

                                                <div class="" style="display: inline-block;">
                                                    <form method="POST"
                                                          action="{{ route('innerAd.delete', ['id' => $row->id]) }}">
                                                        @csrf
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button type="submit"
                                                                class="btn btn-soft-danger btn-icon btn-circle btn-sm delete_confirm"
                                                                data-toggle="tooltip" title='Delete'><i
                                                                    class="fa fa-trash"></i></button>
                                                    </form>
                                                </div>
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
    <script type="text/javascript">
        document.forms['form'].elements['status'].value ={{ $ad->status }}
    </script>
@endsection

@section('extra_js')
    <!-- rich editor  -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            $('#content').summernote({
                height: 150,
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.getInputFile').change(function (e) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.image-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            })
        });
    </script>
@endsection
