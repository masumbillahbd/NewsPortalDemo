@extends('layouts.backend')
@section('title')
    Admin | Post create
@endsection
@section('extra_css')
    <meta name="token" id="token" value="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iCheck/skins/flat/green.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
    <link href='{{ asset("/assets/select/css/select2.min.css") }}' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('assets/vendors/google-code-prettify/bin/prettify.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tag-it/2.0/css/jquery.tagit.min.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="{{ asset('assets/css/pmanager.css') }}" rel="stylesheet">
    
    <style>
        input[type=number]::-webkit-outer-spin-button,
        input[type=number]::-webkit-inner-spin-button {
          -webkit-appearance: none;
          margin: 0;
        }
        input[type=number] {
          -moz-appearance: textfield;
        }
        .body__edit #post_content_ifr {
            height: 405px !important;
        }
        .create__post svg {
            stroke: #fff !important;
            width: 18px !important;
            height: 18px !important;
            margin-right: -4px;
        }
        .select2-container, .tag__list {
            width: 100% !important;
        }
        .form-group{
            width: 100%;
        }
        .position span{
            margin-right: 10px;
        }

        .ui-front input, .ui-front{
            width: 100%;
        }

        #banner{
            text-transform: capitalize;
        }
        .form-group {
            margin-bottom: 22px;
        }
       .ui-menu.ui-widget.ui-widget-content.ui-autocomplete.ui-front{
           max-width: 300px !important;
       }
        .btn__create button{
            width: 140px;
            height: 40px;
            font-size: 18px;
        }
        .textarea{
            display: block;
            width: 100%;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        }
        #pmanager-image-preview img{
            width: 326px !important;
            height: auto;
            max-width: 340px;
        }
        .image__size{
            font-weight: bold;
            color: red;
            font-size: 13px;
        }
        .video__url{
            display: block;
            font-size: 12px;
            font-weight: 300;
        }
    </style>
@endsection


@section('content')
    <main>
        <div class="container-fluid">
            <div class="row justify-content-center">
            @include('back.parts.message')
        </div>
            <form role="form" method="post" action="{{ route('post.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="mb-4 mt-2"></div>
                <div class="row justify-content-center">
                    <div class="col-lg-12 create__post">
                        <a href="{{ route('post.index') }}" class="btn btn-primary btn-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-menu-2"
                                 width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#6f32be"
                                 fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="4" y1="6" x2="20" y2="6"/>
                                <line x1="4" y1="12" x2="20" y2="12"/>
                                <line x1="4" y1="18" x2="20" y2="18"/>
                            </svg>
                            View All
                        </a>
                    </div>
                    <div class="col-lg-8">
                        <div class="card shadow-lg rounded-lg mt-2 mb-5">
                            <div class="card-header"><h4 class="text-center font-weight-light my-2">Create Post</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="mb-1">Headline</label>
                                    <input name="headline" type="text" maxlength="250" class="form-control"
                                           required="required">
                                </div>
                                <div class="form-group">
                                    <label class="mb-1">Sub Headline</label>
                                    <input name="sub_headline" type="text" maxlength="100" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="mb-1">Intro</label>
                                    <textarea name="excerpt" maxlength="400" rows="5" class="textarea" ></textarea>
                                </div>

                                <div class="form-group body__edit">
                                    <label class="mb-1">Post Content</label>
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.11/tinymce.min.js"></script>
                                    <textarea id="post_content" name="post_content" class="form-control my-editor" rows="15"></textarea>
                                    <script>
                                        var editor_config = {
                                            path_absolute: "/",
                                            selector: "#post_content",
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card shadow-lg rounded-lg mt-2 mb-5">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="mb-1">Is Lead?</label>
                                        <input type="checkbox" id="sticky" value="0" name="sticky">
                                        <div class=" position" style="display: none;" id="sticky_position_input">
                                            <label style="display: flex;">
                                                <input id="sticky_position" type="number" name="sticky_position" placeholder="Position" style="width: 100%;border: 1px solid #ccc;padding: 5px 10px;border-radius: 4px;margin-top: 6px;">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="mb-1">RSS</label>
                                        <input type="checkbox" id="rss" title="" name="rss" checked="checked">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="mb-1">Scroll</label>
                                        <input type="checkbox" id="scroll" title="Scroll bar" name="scroll" checked="checked">
                                    </div>
                                </div>
                                
                                <!--<div class="form-group" class="profile-img">-->
                                <!--    <label class="mb-1">Featured Image <span style="color: #f10000; font-weight: bold;">(width: 640px; height: 360px)</span></label>-->
                                <!--    <input class="profile-img-input " id="photo" name="featured_image" type="file">-->
                                <!--    <span class="text-danger">{{ $errors->has('featured_image') ? $errors->first('featured_image'):''}}</span>-->

                                <!--    <label class="pt-1" id="profileLabel" for="photo">-->
                                <!--        <img id="profileImg" class="profileImgShow"-->
                                <!--             src="{{ asset('defaults/default3.png')}}">-->
                                <!--    </label>-->
                                <!--</div>-->
                                
                                <div class="form-group mt-4">
                                    <label>Featured Image (<span class="image__size">Width: 640px, Height: 360px</span>)</label>
                                    <div class="input-group">
                                        <input id="feature_thumbnail" class="form-control pmanager-input-field" type="text"
                                               name="featured_image">
                                        <span class="input-group-btn pmanagerModal" id="featureImage"> <a
                                                    data-input="feature_thumbnail" data-preview="holder"
                                                    class="btn btn-primary height" style="padding: 11px 12px;"> <svg
                                                        class="svg-inline--fa fa-image fa-w-16" aria-hidden="true"
                                                        focusable="false" data-prefix="fa" data-icon="image" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                        data-fa-i2svg=""></svg>Choose</a> </span>
                                    </div>
                                    <span class="text-danger">{{ $errors->has('featured_image') ? $errors->first('featured_image'):''}}</span>
                                    <div id="pmanager-image-preview"></div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="mb-1">Featured Image Caption</label>
                                    <input name="featured_image_caption" type="text" maxlength="200" 
                                           class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="mb-1" for="video_url">Video URL <span class="video__url">( Feature image will replace with youtube/facebook video on top of news details page )</span></label>
                                    <input name="video_url" id="video_url" placeholder="Youtube/Facebook video link"  maxlength="350" type="text" class="form-control">
                                </div>
                                <div class="form-group d-none">
                                    <label class="mb-1" for="streaming_site">Video From</label>
                                    <input name="video_from" id="streaming_site" placeholder="facebook or youtube"  maxlength="50" type="text" class="form-control">
                                </div>
                                <div class="form-group d-none">
                                    <label class="mb-1" for="video_id">Video id</label>
                                    <input name="video_id" id="video_id"  maxlength="350" type="text" class="form-control">
                                </div>
                                <div class="form-group d-none">
                                    <label class="mb-1" for="thumbnail">Video Thumbnail</label>
                                    <input name="video_thumbnail" id="thumbnail"  maxlength="350" type="text" class="form-control">
                                </div>
                                {{--<div class="form-group d-none">
                                    <label class="mb-1">Publisher Name</label>
                                    <input name="publisher_name" type="text" class="form-control">
                                </div>--}}
                                <div class="form-group">
                                    <label class="mb-1">Reporter</label>
                                    <select class="form-control" id="reporter_id" name="reporter_id">
                                        <option value="">-Select Reporter-</option>
                                        <?php $reporters = DB::select('select id,name from reporters ORDER BY position ASC') ?>
                                        @foreach($reporters as $reporter)
                                        <option value="{{$reporter->id}}">{{$reporter->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group d-none">
                                    <label class="mb-1">Photo Optional</label>
                                    <div class="input-group">
                                        <input id="thumbnail2" class="form-control" type="text" name="reporter_photo">
                                        <span class="input-group-btn">
                                                        <a id="lfm2" data-input="thumbnail2" data-preview="holder2"
                                                           class="btn btn-primary">
                                                          <i class="fa fa-image"></i> Choose
                                                        </a>
                                                    </span>
                                    </div>
                                    <img id="holder2" style="margin-top:15px;max-height:100px;">
                                </div>
                                <div class="form-group ui-front ">
                                   <label class="mb-1" for="title">Keywords</label>
                                   <input type="text" id="myTags" name="tag_list" class="form-control ui-autocomplete tag__list ">
                                </div>

                                <div class="form-group">
                                    <label for="category_id"> Category <span class="text-danger">*</span></label>
                                    <select class="form-control" id="category_list" name="category_id" required="">
                                        <option value="" disabled="" selected="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{!! $category->name !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="sub_cat_id"> Sub Category</label>
                                    <select class="form-control" id="sub_cat_list" name="sub_category_id">
                                        <option selected="">Select Sub Category</option>
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sub_cat_id">Division</label>
                                            <select class="form-control" id="division_list" name="division_id">
                                                <option selected="" value="">Select Division</option>
                                                @foreach($divisions as $division)
                                                    <option value="{{$division->id}}">{{$division->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="district_list">District</label>
                                            <select class="form-control" id="district_list" name="district_id">
                                                <option selected="" value="">Select District</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="upazila_list">Upazila</label>
                                            <select class="form-control" id="upazila_list" name="upazila_id">
                                                <option selected="" value="">Select Upazila</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                @if(!empty($banners))
                                <div class="form-group">
                                    <label class="mb-1" for="banner">Facebook Share Banner</label>
                                    <select class="form-control" id="banner" name="banner">
                                      @foreach($banners as $banner)
                                      <option value="{{$banner->banner}}">{{$banner->name}}</option>
                                      @endforeach
                                    </select>
                                </div>
                                @endif

                               {{-- <div class="form-group row">
                                    <label class="col-md-5 col-8" for="special">Exclusive <span
                                                class="text-danger"></span></label>
                                    <div class="col-md-7 col-4">
                                        <input type="checkbox" id="special" name="special" value="1">
                                        <span class="text-danger">{{ $errors->has('special') ? $errors->first('special'):''}}</span>
                                    </div>
                                </div>--}}
                                <div class="form-group">
                                    <label for="podcast">Podcast (<small class="text-danger">Only Audio File</small>)</label>
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="podcast" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
                                    <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                  </div>
                                </div>

                                <div class="form-group btn__create">
                                    <div class="form-group mt-4 mb-0">
                                        <button type="submit" class="btn btn-success submit">Create Post</button>
                                        <button type="submit" value="draft" name="draft" class="btn btn-danger submit"
                                                style="padding-left: 15px; padding-right: 15px;">
                                           Save as Draft
                                        </button>
                                    </div>
                                </div>


                            </div>

                        </div>
                    </div> <!--col-->


                </div>

            </form>
        </div>
    </main>
    

@endsection

@section('extra_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js" integrity="sha512-tWHlutFnuG0C6nQRlpvrEhE4QpkG1nn2MOUMWmUeRePl4e3Aki0VB6W1v3oLjFtd0hVOtRQ9PHpSfN6u6/QXkQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/vendors/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"
            charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tag-it/2.0/js/tag-it.min.js" type="text/javascript"
            charset="utf-8"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script> -->
        <script src='{{ asset("/assets/select/js/select2.js") }}' type='text/javascript'></script>
    <script>
        $(document).ready(function () {

            $("#myTags").tagit({
                singleField: true,
                singleFieldNode: $('#mySingleField'),
                allowSpaces: true,
                minLength: 2,
                removeConfirmation: true,
                tagSource: function(request, response){
                    console.log(request.term);
                    let keyword = request.term;
                    $.ajax({
                        url: "{{ route('tagLiveSearch') }}/"+keyword, 
                        data: { term:request.term },
                        dataType: "json",
                        success: function(data){
                            response($.map(data, function(item){
                                return {
                                    label: item.name,
                                    value: item.name
                                }
                            }));
                        }
                    });
                }
            });


            let post_status = $("#post_status");
            post_status.click(function () {
                if (post_status.is(':checked')) {
                    post_status.val(1);  // checked
                } else {
                    post_status.val(0);
                }
            });


            let sticky = $("#sticky");
            sticky.on('click', function () {
                if (sticky.is(':checked')) {
                    sticky.val(1);  // checked
                    $("#sticky_position_input").css("display", "block");
                } else {
                    sticky.val(0);
                    $("#sticky_position_input").css("display", "none");
                    $("#sticky_position").val('');
                }
            });


            let watermark = $("#watermark");
            watermark.click(function () {
                if (watermark.is(':checked')) {
                    watermark.val(1);  // checked
                } else {
                    watermark.val(0);
                }
            });


            let show_user_photo = $("#show_user_photo");
            show_user_photo.click(function () {
                if (show_user_photo.is(':checked')) {
                    show_user_photo.val(1);  // checked
                } else {
                    show_user_photo.val(0);
                }
            });


            $('#lfm').filemanager('image');
            $('#lfm2').filemanager('image');

            $('#category_list').select2();
            $('#reporter_id').select2();

            $('#division_list').on('change', function (e) {
                var division_id = e.target.value;
            });
        });
        
        $(document).ready(function () {
            document.getElementById("sticky_position").addEventListener("keyup", function() {
              this.value = this.value.replace(/[^0-9]/g,"");
            });
        })
    </script>

    <script>
        $(document).ready(function () {
            //ajax category subCsategory
            $('#category_list').on('change', function (e) {
                var category_id = e.target.value;
                if (category_id) {
                    $.ajax({
                        url: "{{ route('category.subcategory.ajax') }}/" + category_id,
                        type: "get",
                        dataType: "json",
                        success: function (data) {
                            $("#sub_cat_list").empty();
                            $("#sub_cat_list").append('<option selected value="">--Select Sub Category--</option>')
                            $.each(data, function (key, value) {
                                $('#sub_cat_list').append('<option value="' + value.id + '">' + value.name + '</option>')
                            })
                        }
                    })
                } else {
                }
            });

        });
    </script>

    <script>
        $(document).ready(function () {
            //ajax district
            $('#division_list').on('change', function (e) {
                var division_id = e.target.value;
                $("#district_list").empty();
                $("#district_list").append('<option selected  value="">Select District</option>');
                $("#upazila_list").empty();
                $("#upazila_list").append('<option selected  value="">Select Upazila</option>');
                if (division_id) {
                    $.ajax({
                        url: "{{ route('division.district') }}/" + division_id,
                        type: "get",
                        dataType: "json",
                        success: function (data) {
                            $("#district_list").empty();
                            $("#district_list").append('<option selected  value="">Select District</option>');
                            $.each(data, function (key, value) {
                                $('#district_list').append('<option value="' + value.id + '">' + value.name + '</option>')
                            })
                        }
                    })
                } else {
                    $("#district_list").empty();
                    $("#district_list").append('<option selected  value="">Select District</option>');
                    $("#upazila_list").empty();
                    $("#upazila_list").append('<option selected  value="">Select Upazila</option>');
                }
            });

            //ajax upazila
            $('#district_list').on('change', function (e) {
                var district_id = e.target.value;

                $("#upazila_list").append('<option selected  value="">Select Upazila</option>');

                if (district_id) {
                    $.ajax({
                        url: "{{ route('district.upazila') }}/" + district_id,
                        type: "get",
                        dataType: "json",
                        success: function (data) {
                            $("#upazila_list").empty();
                            $("#upazila_list").append('<option selected  value="">Select Upazila</option>');
                            $.each(data, function (key, value) {
                                $('#upazila_list').append('<option value="' + value.id + '">' + value.name + '</option>')
                            })
                        }
                    })
                } else {
                    $("#upazila_list").empty();
                    $("#upazila_list").append('<option selected  value="">Select Upazila</option>');
                }
            });

        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.profile-img-input').change(function (e) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.profileImgShow').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            })
        });
    </script>

@include('back.video.js')
@endsection



