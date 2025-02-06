@extends('layouts.frontend')

@section('meta_info')
    @php
        $settings = \App\Models\Setting::find('1');
    @endphp
    <title>@yield('page_title')@if($upazila_id != null) {{ $active_upazila->name }} | @elseif($upazila_id == null and $district_id != null) {{ $active_district->name }} | @elseif($upazila_id == null and $district_id == null)  {{ $active_division->name }} | @endif  {{ $settings->site_title }}</title>
    <meta name="title" content="@if(!empty($active_district->name)) {{ $active_district->name }}  | @endif  {{ $settings->site_title }}"/>
    <meta name="keywords" content="{{ $settings->meta_keywords }}"/>
    <meta name="description" content="{{ $settings->meta_description }}">
    <meta name="classification" content="Magazine, Newspaper, Artical"/>
    <meta property="og:title" content="@if($upazila_id != null) {{ $active_upazila->name }} | @elseif($upazila_id == null and $district_id != null) {{ $active_district->name }} | @elseif($upazila_id == null and $district_id == null)  {{ $active_division->name }} | @endif {{ $settings->site_title }}"/>
    <meta property="og:description" content="{{ $settings->meta_description }}">
    <meta property="og:image" content="{{ url($settings->meta_image) }}"/>
    <meta property="og:url" content="{{ $settings->site_url }}"/>
    <meta property="og:site_name" content="{{ $settings->site }}">
    <meta name="twitter:url" content="{{ $settings->site_url }}"/>
    <meta name="twitter:title" content="@if($upazila_id != null) {{ $active_upazila->name }} | @elseif($upazila_id == null and $district_id != null) {{ $active_district->name }} | @elseif($upazila_id == null and $district_id == null)  {{ $active_division->name }} | @endif {{ $settings->site_title }}"/>
    <meta name="twitter:description" content="{{ $settings->meta_description }}"/>
    <meta name="twitter:image" content="{{ url($settings->meta_image) }}"/>
    <meta name="twitter:creator" content="">
@endsection

@section('extra_js')
    
<script>
    $(document).ready(function() {
        //ajax district
        $('#division_list').on('change', function (e) {
            var division_id = e.target.value;
            
            $("#district_list").empty();
            $("#district_list").append('<option selected  value="">জেলা</option>');
            $("#upazila_list").empty();
             $("#upazila_list").append('<option selected  value="">উপজেলা</option>');
            
            if(division_id){
            $.ajax({
                url:"{{ route('division.district.news') }}/"+division_id,
                type:"get",
                dataType:"json",
                
                success:function(data){
                  $("#district_list").empty();
                $("#district_list").append('<option selected  value="">জেলা</option>');
                  $.each(data,function(key, value){
                    $('#district_list').append('<option value="' + value.id + '">' + value.name + '</option>')
                  })
                }
              })
            }else{
             $("#district_list").empty();
             $("#district_list").append('<option selected  value="">জেলা</option>');
             $("#upazila_list").empty();
             $("#upazila_list").append('<option selected  value="">উপজেলা</option>');
            }
        });
        
        //ajax upazila
        $('#district_list').on('change', function (e) {
            var district_id = e.target.value;
            
            $("#upazila_list").append('<option selected  value="">উপজেলা</option>');
            
            if(district_id){
            $.ajax({
                url:"{{ route('district.upazila.news') }}/"+district_id,
                type:"get",
                dataType:"json",
                
                success:function(data){
                    // alert('ok');
                    $("#upazila_list").empty();
                    $("#upazila_list").append('<option selected  value="">উপজেলা</option>');
                  $.each(data,function(key, value){
                    $('#upazila_list').append('<option value="' + value.id + '">' + value.name + '</option>')
                  })
                }
              })
            }else{
             $("#upazila_list").empty();
             $("#upazila_list").append('<option selected  value="">উপজেলা</option>');
            }
        });
       
    });
</script> 

@endsection

@section('main_content')

    <section class="district__page pt-5">
        <div class="container">
            <h3 class="div__name">
                @if($upazila_id != null)
                    <p style="color: black;">উপজেলা</p>
                    {{ $active_upazila->name }}
                @elseif($upazila_id == null and $district_id != null)
                <p style="color: black;">জেলা</p>
                    {{ $active_district->name }}
                @elseif($upazila_id == null and $district_id == null)
                    <p style="color: black;">বিভাগ</p>
                    {{ $active_division->name }}
                @endif
            </h3>
            <hr>
            <div class="row">
                <div class="col-md-3 col-lg-3">
                    <div class="well well-sm text-left">
                        <h3 style="margin: 0;color: #00813b;">আমার এলাকার সংবাদ</h3>
                        <span class="border__half mb-2"></span>
                    </div>
                    <form action="{{ route('search_all_bd_news') }}" method="get" class="mt-3">
                        <div class="form-group mt-2 mb-2">
                            <select class="form-select" aria-label="Default select example" id="division_list" name="division_id" required>
                                @if(!empty($active_division))
                                <option selected="" disabled value="{{ $active_division->id }}">{{ $active_division->name }}</option>
                                @else
                                <option selected="" value="">বিভাগ</option>
                                @endif
                                @foreach($divisions as $division)
                                    <option value="{{$division->id}}">{{$division->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-2 mb-2">
                            <select class="form-select" aria-label="Default select example" id="district_list" name="district_id" >
                                @if(!empty($active_district))
                                <option selected="" value="{{ $active_district->id }}">{{ $active_district->name }}</option>
                                @else
                                <option selected="" value="">জেলা</option>
                                @endif
                            </select>
                        </div>

                        <div class="form-group mt-2 mb-2">
                            <select class="form-select" aria-label="Default select example" id="upazila_list" name="upazila_id" >
                                @if(!empty($active_upazila))
                                <option selected="" value="{{ $active_upazila->id }}">{{ $active_upazila->name }}</option>
                                @else
                                 <option selected="" value="">উপজেলা</option>
                                @endif
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> খুঁজুন</button>
                        </div>
                    </form>
                </div>
                
                <div class="col-md-6">
                    <div class="list-group">
                        @if( !empty($all_bd_news->count()) )
                            @foreach($all_bd_news as $post)
                                <div class="callout-card pb-2 mb-4 border__btm">
                                    <div class="row">
                                        <div class="col-md-8 col-8 col-sm-8">
                                            <div class="media-body">
                                                <ul class="list-inline mb-3" style="display: inline-block !important;">
                                                    <li><h4 class="media-heading"><a
                                                                    href="{{ news_url($post) }}"><strong>{{ $post->headline }}</strong></a>
                                                        </h4></li>
                                                    <li class="pull-left"> <i class="bi bi-clock"></i> {{ bangla_published_time($post->created_at) }}
                                                    </li>
                                                    <li class="clearfix"></li>
                                                </ul>
                                                <p class="d-none d-md-block d-lg-block" style="display: inline-block !important;">{{ Str::limit($post->excerpt, 160) }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-4 col-sm-4">
                                            <a href="{{ news_url($post) }}">
                                                <img class="media-object img-responsive"
                                                     src="{{$post->featured_image}}" alt="{{ $post->headline }}">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center">
                                <h3>কিছু পাওয়া যায়নি</h3>
                            </div>

                        @endif
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>

        </div>
    </section>
@endsection