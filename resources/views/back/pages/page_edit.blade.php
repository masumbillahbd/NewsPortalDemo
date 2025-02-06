
@extends('layouts.backend')
@section('title')
Admin | Edit page
@endsection

@section('extra_css')

<style type="text/css">
  
</style>
@endsection



@section('content')
  <main>
  <div class="container-fluid">
    <div class="row justify-content-center">
      @include('back.parts.message')
      <div class="col-lg-10">
        <div class="card shadow-lg border-0 rounded-lg mt-4 mb-3">
          <div class="card-header">
              <div class="pg__name float-left">
                                <h4 class="font-weight-light my-1">Edit Photo</h4>
                            </div>
                            <div class="pg__btn float-right">
                                <a href="{{ route('page.create') }}" class="btn btn-success">Create</a>
                            </div>
                            </div>          
          <div class="card-body">
            <form role="form" id="page" method="post" action="{{ route('page.update',['id'=>$page->id]) }}" >
              @csrf

              <div class="form-group">
                <label class="" for="title">Title <span class="text-danger">*</span></label>
                  <input class="form-control" name="title" value="{{$page->title}}" id="title" placeholder="Title" type="text" required>
                  <span class="text-danger">{{ $errors->has('title') ? $errors->first('title'):''}}</span>
                  <span id="titleError"></span>
              </div>

          

              <div class="form-group">
                <label class="" for="content">Content <span class="text-danger">*</span></label>
                <div class="">
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.11/tinymce.min.js"></script>
                  <textarea class="" name="content" id="content" placeholder="" rows="20" >{{$page->content}}</textarea>
                                      <script>
                                        var editor_config = {
                                            path_absolute: "/",
                                            selector: "#content",
                                            plugins: [
                                                "textcolor advlist autolink lists link image charmap print preview hr anchor pagebreak",
                                                "searchreplace wordcount visualblocks visualchars code fullscreen",
                                                "insertdatetime media nonbreaking save table directionality",
                                                "emoticons template paste textcolor colorpicker textpattern"
                                            ],
                                            toolbar: "forecolor backcolor insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
                                            relative_urls: false,
                                            file_browser_callback: function (field_name, url, type, win) {
                                                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                                                var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                                                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                                                if (type == 'image') {
                                                    cmsURL = cmsURL + "&type=Images";
                                                } else {
                                                    cmsURL = cmsURL + "&type=Files";
                                                }

                                                tinyMCE.activeEditor.windowManager.open({
                                                    file: cmsURL,
                                                    title: 'Filemanager',
                                                    width: x * 0.8,
                                                    height: y * 0.8,
                                                    resizable: "yes",
                                                    close_previous: "no"
                                                });
                                            }
                                        };
                                        tinymce.init(editor_config);
                                    </script>

                <span class="text-danger">{{ $errors->has('content') ? $errors->first('content'):''}}</span>
                <span id="contentError"></span>
                </div>  
              </div>

              
              <button type="submit" id="submit_btn" class="float-right btn btn-primary">Update</button>
            </form>
          </div>
        </div>
      </div> <!--col-5-->
    </div>  
  </div>
</main>
@endsection

@section('extra_js')

@endsection