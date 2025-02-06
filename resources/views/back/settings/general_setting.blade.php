@extends('layouts.backend')
<title>General Settings</title>
@section('extra_css')
    <link href="{{ asset('assets/vendors/switchery/dist/switchery.min.css') }}" rel="stylesheet">

    <style>
        .form-horizontal .form-group {
            margin-right: 0px;
            margin-left: 0px;
        }

        .my-file-icon333 label {
            float: left;
            font-size: 11px !important;
            background: #ccc;
            width: 18px;
            height: 18px;
            padding: 3px 7px;
            border-radius: 50%;
            margin-right: 5px;
        }
        .my-file-icon333 label:hover {
            cursor: help;
        }

        .setting__header {
            background: #7c7c7c1c;
            padding: 1px 10px 1px;
            line-height: 1;
            border-radius: 2px;
            height: 39px;
        }
        .form-control{
            border: none !important;
            -webkit-box-shadow: inset 0 0px 2px rgb(0 0 0 / 23%) !important;
            box-shadow: inset 0 0px 2px rgb(0 0 0 / 23%) !important;
        }
        .setting__body .admin__img .form-group{
            padding: 20px 10px;
            box-shadow: 0px 0px 12px #bbbbbb;
            border-radius: 5px;
        }
    </style>
@endsection

@section('extra_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.11/tinymce.min.js"></script>
    <script src="{{ asset('assets/vendors/switchery/dist/switchery.min.js') }}"></script>
    <script>tinymce.init({selector: 'textarea'});</script>
    
    <script>
  $(document).ready(function () {

    $('.toggle_banner_status').change(function(){
        var sm_banner = $(this).prop('checked') == true ? 1 : 0; 
        var id = $(this).data('id'); 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{ route('sm_banner_status') }}",
            data: {'sm_banner': sm_banner, 'id': id},
            success: function(data){
                 toastr.success(data.success)
            }
        });
    });
    
    $('.scrollBarToggle').change(function(){
        var scroll_bar = $(this).prop('checked') == true ? 1 : 0; 
        var id = $(this).data('id'); 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{ route('scrollBarToggle') }}",
            data: {'scroll_bar': scroll_bar, 'id': id},
            success: function(data){
                 toastr.success(data.success)
            }
        });
    });
    
    $('.menuBarToggle').change(function(){
        var desktop_menu_bar = $(this).prop('checked') == true ? 1 : 0; 
        var id = $(this).data('id'); 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{ route('menuBarToggle') }}",
            data: {'desktop_menu_bar': desktop_menu_bar, 'id': id},
            success: function(data){
                 toastr.success(data.success)
            }
        });
    });
    
    $('.popularTagToggle').change(function(){
        var popular_tag = $(this).prop('checked') == true ? 1 : 0; 
        var id = $(this).data('id'); 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{ route('popularTagToggle') }}",
            data: {'popular_tag': popular_tag, 'id': id},
            success: function(data){
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
                <div class="col-xl-8 col-lg-12 col-md-10 col-sm-12 m-auto">
                    <div class="card shadow-lg border-0 rounded-lg mt-5 mb-5">
                        <div class="card-header"><h4 class="text-center font-weight-light my-2">Website Setup</h4></div>
                        <div class="card-body">
                            <form action="{{ route('general_setting.update') }}" enctype="multipart/form-data"
                                  method="post" id="demo-form2" data-parsley-validate
                                  class="form-horizontal form-label-left">
                                {{ csrf_field() }}

                                <div class="setting__block mb-4">
                                    <div class="setting__header mb-3">
                                        <h4>Site Information</h4>
                                    </div>
                                    <div class="setting__body m-auto" style="width: 96%">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="mb-1" for="inputFirstName">Site URL</label>
                                                    <input class="form-control py-4" id="inputFirstName" type="text"
                                                           name="site_url"
                                                           value="{{ $setting->site_url }}"
                                                           placeholder="www.yourdomain.com">

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="mb-1" for="inputFirstName">Website Name</label>
                                                    <input class="form-control py-4" id="inputFirstName" type="text"
                                                           name="site" value="{{ $setting->site }}"
                                                           placeholder="Bangla News">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="mb-1" for="inputFirstName">Website Title</label>
                                                    <input class="form-control py-4" id="site_title" type="text"
                                                           name="site_title" value="{{ $setting->site_title }}"
                                                           placeholder="News Portal | Best performance news website Bangladesh">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="setting__block mb-4">
                                    <div class="setting__header mb-3">
                                        <h4>File Information</h4>
                                    </div>
                                    <div class="setting__body m-auto" style="width: 96%">
                                        <div class="admin__img mt-5">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="my-file-icon333">
                                                            <label for="" data-toggle="tooltip" data-placement="top"
                                                                   title="Please use standard logo size"><i
                                                                        class="fa fa-info"></i></label>
                                                        </div>
                                                        <label class="mb-5" for="inputFirstName"
                                                               style="margin-right: 18px;">Website Logo:</label>
                                                        <!--<input name="logo" type="file">-->
                                                        <input name="logo" type="file">
                                                        @if($setting->logo)
                                                            <div style="margin-top: 25px; margin-bottom: 25px">
                                                                <img src="{{ url(route('frontEndRoot') . '/' . $setting->logo) }}"
                                                                     alt="" width="100%">
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="my-file-icon333">
                                                            <label for="" data-toggle="tooltip" data-placement="top"
                                                                   title="Meta Image size should be width: 640px & height: 360px"><i
                                                                        class="fa fa-info"></i></label>
                                                        </div>
                                                        <label class="mb-5" for="inputFirstName">Meta Image: </label>
                                                        <!--<input name="meta_image" type="file">-->
                                                        <input name="meta_image" type="file">
                                                        @if($setting->meta_image)
                                                            <div style="margin-top: 25px; margin-bottom: 25px">
                                                                <img src="{{ url(route('frontEndRoot') . '/' . $setting->meta_image) }}"
                                                                     width="60px" alt="">
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="my-file-icon333">
                                                            <label for="" data-toggle="tooltip" data-placement="top"
                                                                   title="Favicon size should be width: 100px & height: 100px"><i
                                                                        class="fa fa-info"></i></label>
                                                        </div>
                                                        <label class="mb-5" for="inputFirstName">Favicon:</label>
                                                        <input name="favicon" type="file">
                                                        @if($setting->favicon)
                                                            <div style="margin-top: 25px; margin-bottom: 25px">
                                                                <img src="{{ url(route('frontEndRoot') . '/' . $setting->favicon) }}"
                                                                     alt="">
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="my-file-icon333">
                                                            <label for="" data-toggle="tooltip" data-placement="top"
                                                                   title="Lazy image size should be width: 640px & height: 360px"><i
                                                                        class="fa fa-info"></i></label>
                                                        </div>
                                                        <label class="mb-5" for="inputFirstName">lazy Image:</label>
                                                        <input name="lazy_image" type="file">
                                                        @if($setting->lazy_image)
                                                            <div style="margin-top: 25px; margin-bottom: 25px">
                                                                <img src="{{ url(route('frontEndRoot') . '/' . $setting->lazy_image) }}"
                                                                     alt="">
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="my-file-icon333">
                                                            <label for="" data-toggle="tooltip" data-placement="top"
                                                                   title="Facebook Share Banner size should be width: 640px & height: 55px"><i
                                                                        class="fa fa-info"></i></label>
                                                        </div>
                                                        <label class="mb-5" for="inputFirstName">Facebook
                                                            Banner:</label>
                                                        <label class="switch">
                                                            <input id="banner_status" class="toggle_banner_status"
                                                                   type="checkbox" {{ $setting->share_banner_status == 1 ? 'checked' : '' }} >
                                                            <span class="slider round"></span>
                                                        </label>
                                                        <input id="share_banner" name="share_banner" type="file">
                                                        @if($setting->share_banner != null)
                                                            @if($setting->share_banner)
                                                                <div class="img__cl py-5">
                                                                    <img class="w-100"
                                                                         src="{{  url(route('frontEndRoot') . '/' . $setting->share_banner) }}" alt="">
                                                                </div>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="setting__block mb-4">
                                    <div class="setting__header mb-3">
                                        <h4>Meta Information</h4>
                                    </div>
                                    <div class="setting__body m-auto" style="width: 96%">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="mb-1" for="inputFirstName">Meta Title</label>
                                                    <input class="form-control py-4" id="inputFirstName" type="text"
                                                           name="meta_title" value="{{ $setting->meta_title }}"
                                                           placeholder="News Portal | Best performance news website Bangladesh">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="mb-1" for="inputFirstName">Meta Keywords</label>
                                                    <input class="form-control py-4" id="inputFirstName" type="text"
                                                           name="meta_keywords" value="{{ $setting->meta_keywords }}"
                                                           placeholder="news, bdnews, politics, sports">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label class="mb-1" for="inputFirstName">Meta Description (<span
                                                                class="text-danger">Standard Between 155 to 160 characters</span>
                                                        )</label>
                                                    <input class="form-control py-4" id="inputFirstName" type="text"
                                                           name="meta_description"
                                                           value="{{ $setting->meta_description }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="mb-1" for="inputFirstName">FB App ID </label>
                                                    <input class="form-control py-4" id="fb_app_id" type="text" name="fb_app_id" value="{{ $setting->fb_app_id }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="setting__block mb-4">
                                    <div class="setting__header mb-3">
                                        <h4>Printers Line / Footer</h4>
                                    </div>
                                    <div class="setting__body m-auto" style="width: 96%">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="mb-1" for="inputFirstName">Editors Name</label>
                                                    <input id="text" name="cr_text_1" value="{{ $setting->cr_text_1 }}"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="mb-1" for="inputEmailAddress">Email</label>
                                                    <input class="form-control py-4" id="inputEmailAddress" type="email"
                                                           aria-describedby="emailHelp" name="site_email"
                                                           value="{{ $setting->site_email }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="mb-1" for="inputEmailAddress">Mobile</label>
                                                    <input class="form-control py-4" id="site_mobile" type="text"
                                                           name="site_mobile" value="{{ $setting->site_mobile }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="mb-1" for="inputFirstName">Address</label>
                                                    <input id="google_map" name="cr_text_2"
                                                           value="{{ $setting->cr_text_2 }}" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="setting__block mb-4">
                                    <div class="setting__header mb-3">
                                        <h4>Others</h4>
                                    </div>
                                    <div class="setting__body m-auto" style="width: 96%">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="mb-1" for="inputFirstName">Google AdSense (<span
                                                                class="text-danger">Paste Google AdSense Script</span>)</label>
                                                    <input id="google_adsense" name="google_adsense"
                                                           value="{{ $setting->google_adsense }}" class="form-control"
                                                           placeholder='<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-000000000" crossorigin="anonymous"></script>"'/>
                                                </div>
                                            </div>
                                            <div class="col-md-4 d-none">
                                                <div class="form-group">
                                                    <label class="mb-1" for="inputEmailAddress">Google Analytic (<span
                                                                class="text-danger">Do not include G- </span>)</label>
                                                    <input class="form-control py-4" id="google_analytic" type="text"
                                                           name="google_analytic"
                                                           value="{{ $setting->google_analytic }}"
                                                           placeholder="W6G27RCXKB">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="mb-1" for="inputFirstName">Google Map (<span
                                                                class="text-danger">Paste Google <ifram></ifram> Embed Code</span>)</label>
                                                    <input class="form-control py-4" id="google_map" type="text"
                                                           name="google_map" value="{{ $setting->google_map }}" rows="3"
                                                           placeholder='<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3652.2448873585727!2d90.4276720467015!3d2...></iframe>'>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="setting__block mb-4">
                                    <div class="setting__header mb-3">
                                        <h4>Social Link</h4>
                                    </div>
                                    <div class="setting__body m-auto" style="width: 96%">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="mb-1" for="facebook">Facebook </label>
                                                    <input class="form-control py-4" id="facebook" type="text"
                                                           name="facebook" value="{{ $setting->facebook }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="mb-1" for="youtube">Youtube </label>
                                                    <input class="form-control py-4" id="youtube" type="text"
                                                           name="youtube" value="{{ $setting->youtube }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="mb-1" for="twitter">Twitter </label>
                                                    <input class="form-control py-4" id="twitter" type="text"
                                                           name="twitter" value="{{ $setting->twitter }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="mb-1" for="inputFirstName">Linkedin</label>
                                                    <input id="linkedin" name="linkedin"
                                                           value="{{ $setting->linkedin }}" class="form-control"/>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="mb-1" for="inputFirstName">Instagram</label>
                                                    <input id="instagram" name="instagram"
                                                           value="{{ $setting->instagram }}" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="setting__block mb-4">
                                    <div class="setting__header mb-3">
                                        <h4>Option Settings</h4>
                                    </div>
                                    <div class="setting__body m-auto" style="width: 96%">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="mb-1" for="scrollBar">Scroll Bar<span class="text-danger">*</span></label>
                                                    <div>
                                                        <label class="switch">
                                                            <input id="scrollBar" class="scrollBarToggle"
                                                                   type="checkbox" {{ $setting->scroll_bar == 1 ? 'checked' : '' }} >
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="mb-1" for="menuBar">Menu Bar<span class="text-danger">*</span></label>
                                                    <div>
                                                        <label class="switch">
                                                            <input id="menuBar" class="menuBarToggle"
                                                                   type="checkbox" {{ $setting->desktop_menu_bar == 1 ? 'checked' : '' }} >
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="mb-1" for="popularTag">Popular Tag<span class="text-danger">*</span></label>
                                                    <div>
                                                        <label class="switch">
                                                            <input id="popularTag" class="popularTagToggle"
                                                                   type="checkbox" {{ $setting->popular_tag == 1 ? 'checked' : '' }} >
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="setting__block mb-4">
                                    <div class="setting__header mb-3">
                                        <h4>Admin Settings</h4>
                                    </div>
                                    <div class="setting__body m-auto" style="width: 96%">
                                        <div class="form-group">
                                            <label class="mb-1" for="inputFirstName">Admin Prefix <span class="text-danger">*</span></label>
                                            <input class="form-control py-4" id="inputFirstName" type="text" name="admin_prefix"
                                                   value="{{ $setting->admin_prefix }}">
                                            <span class="text-warning">(Must fill up it carefully, if you put prefix and press submit, your url will be change with new prefix)</span> <br>
                                            <span class="text-danger">{{ $errors->has('admin_prefix') ? $errors->first('admin_prefix'):''}}</span>
                                        </div>  
                                    </div>
                                </div>
                                
                                <button tupe="submit" class="btn btn-success py-2 text-center float-right">Update</button>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

