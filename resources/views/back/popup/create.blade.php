@extends('layouts.backend')
@section('title')
    Admin | Popup ads setting
@endsection

@section('extra_css')

@endsection

@section('extra_js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.getInputFile').change(function (e) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.profileImgShow').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            })
        });
    </script>
@endsection

@section('content')
    <main>
        <div class="container-fluid">
            <div class="row justify-content-center">
                @include('back.parts.message')
                <div class="col-lg-4">
                    <div class="card shadow-lg border-0 rounded-lg mt-3 mb-3">
                        <div class="card-header"><h4 class="text-center">Add Popup Adv.</h4></div>
                        <div class="card-body">
                            <form role="form" method="post" action="{{ route('popup.store') }}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                        <input class="form-control" name="name" placeholder="Name" type="text"
                                               autocomplete="off" maxlength="95" required>
                                        <span class="text-danger">{{ $errors->has('name') ? $errors->first('name'):''}}</span>
                                </div>
                                <div class="form-group">
                                    <label for="link">Link <span class="text-danger"></span></label>
                                        <input class="form-control" name="link" placeholder="Link" type="text"
                                               autocomplete="off">
                                        <span class="text-danger">{{ $errors->has('link') ? $errors->first('link'):''}}</span>
                                </div>
                                <div class="form-group">
                                    <label for="position">Visible for</label>
                                        <select name="position" id="position" class="form-control">
                                            <option value="home">Home Page</option>
                                            <option value="single">Single Page</option>
                                        </select>
                                        <span class="text-danger">{{ $errors->has('position') ? $errors->first('position'):''}}</span>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                        <span class="text-danger">{{ $errors->has('status') ? $errors->first('status'):''}}</span>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4" for="image">Image<small>(740x740)</small><span
                                                class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input type="file" name="image" class="getInputFile" id="validatedCustomFile"
                                               hidden/>
                                        <label class="my_file-label" for="validatedCustomFile"><i
                                                    class="fas fa-cloud-upload-alt"></i> Upload</label>
                                        <span id="my-file-chosen"></span>
                                        <br>
                                        <label class="pt-1" id="profileLabel" for="image">
                                            <img style="width:100% !important;height:50px !important;"
                                                 class="profileImgShow" src="{{ asset('defaults/default3.png')}}">
                                        </label>
                                        <span class="text-danger">{{ $errors->has('image') ? $errors->first('image'):''}}</span>
                                    </div>
                                </div>
                                <button type="submit" class="float-right btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div> <!--col-6-->

                <div class="col-lg-8">
                    <div class="card shadow-lg border-0 rounded-lg mt-3 mb-3">
                        <div class="card-header"><h4 class="text-center">All Popup Adv.</h4></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Visible for</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Image</th>
                                        <th class="text-center" style="width: 170px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(App\Models\Popup::orderBy('id','desc')->get() as $key=> $row)
                                        <tr>
                                            <td class="text-center">{{$row->name}}</td>
                                            <td class="text-center">{{$row->position}}</td>
                                            <td class="text-center">{{$row->status ?'active':'inactive'}}</td>
                                            <td class="text-center"><img width="100px"
                                                                         src="{{ asset('img/popup/'.$row->image)}}" class="float-none">
                                            </td>
                                            <td class="text-center col__action__body">
                                                <a href="{{ route('popup.edit', ['id' => $row->id])}}"
                                                   class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                                <a href="{{ route('popup.destroy', ['id' => $row->id])}}"
                                                   onclick="return confirm('Are you sure to delete this!')"
                                                   class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
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
    </main>
@endsection
