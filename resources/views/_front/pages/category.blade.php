@extends('layouts.frontend')
@section('meta_info')
    <?php $settings = \App\Models\Setting::find(1); ?>
    <title>{{ $category->name }} | {{ $settings->site_title }}</title>
    <meta name="keywords" content="{{ $settings->meta_keywords }}"/>
    <meta name="description" content="{{ $settings->meta_description }}">
    <meta name="classification" content="Magazine, Newspaper, Artical"/>
    <meta property="og:title" content="{{ $category->name }} | {{ $settings->meta_title }}"/>
    <meta property="og:description" content="{{ $settings->meta_description }}">
    <meta property="og:image" content="{{ url($settings->meta_image) }}"/>
    <meta property="og:url" content="{{ $settings->site_url }}"/>
    <meta property="og:site_name" content="{{ $settings->site }}">
    <meta name="twitter:url" content="{{ $settings->site_url }}"/>
    <meta name="twitter:title" content="{{ $category->name }} | {{ $settings->site_title }}"/>
    <meta name="twitter:description" content="{{ $settings->meta_description }}"/>
    <meta name="twitter:image" content="{{ url($settings->meta_image) }}"/>
    <meta name="twitter:creator" content="">
@endsection


@section('extra_css')
    <style>
        #load_more {
            margin: 25px 0;
        }

        .section_page .link-hover-homepage:hover h4, .section_page .link-hover-homepage:hover a {
            color: var(--bs-blue) !important;
        }
    </style>
@endsection


@section('main_content')
    <section class="section_page pt-0">
        <div class="ads__banner bg__grey py-3 m-auto" align="center">
            <div class="container">
                <img src="/ads/1677944913.gif" class="ads__file">
            </div>
        </div>
        @if($category->id == 9)
            <div class="district__block mt-4">
                <div class="container">
                    <form action="{{ route('search_all_bd_news') }}" method="get">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group mt-2 mb-3">
                                    <?php $divisions = App\Models\Division::orderBy('name', 'asc')->get();?>
                                    <select class="form-control form-select" aria-label="Default select example"
                                            id="division_list"
                                            name="division_id" required>
                                        <option selected="" value="">বিভাগ</option>
                                        @foreach($divisions as $division)
                                            <option value="{{$division->id}}">{{$division->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mt-2 mb-3">
                                    <select class="form-control form-select" aria-label="Default select example"
                                            id="district_list"
                                            name="district_id">
                                        <option selected="" value="">জেলা</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mt-2 mb-3">
                                    <select class="form-control form-select" aria-label="Default select example"
                                            id="upazila_list"
                                            name="upazila_id">
                                        <option selected="" value="">উপজেলা</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="d-grid gap-2 btn__n__search mt-2 mb-3">
                                    <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> খুঁজুন
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section_heading pt-4 pb-4">
                        <a href="{{ category_url($category->id) }}">{{ $category->name }}</a>
                    </div>
                    <div class="sub pb-4">
                        @foreach($category->SubCategory->all() as $sub_cat)
                            <a href="{{ route('sub_cat.post', ['cat' => $category->slug, 'sub_cat' => $sub_cat->slug]) }}">{{ $sub_cat->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="cat__pg__top__1">
                <div class="row">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="section__page__lead border__right col-md-8 mb-3 mb-md-0 mb-lg-0">
                                <?php $post = posts_by_category($category->id, 1); ?>
                                @if($post)
                                    <div class="link-hover-homepage position-relative">
                                        <a href="{{ news_url($post) }}"><img
                                                    src="{{$settings->lazy_image ? asset($settings->lazy_image) : asset('/defaults/lazy-default.jpg')}}"
                                                    data-src="{{ $post->featured_image }}"
                                                    alt="{!! $post->headline !!}"
                                                    class="img-responsive lazy">
                                            <div class="lead__single__content">
                                                <span>{!! $post->sub_headline !!}</span>
                                                <h3 class="pt-2">{!! $post->headline !!}</h3>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <div class="sidebar">
                                    <div class="content__col">
                                        <?php $post = posts_by_category($category->id, 1, 1); ?>
                                        @if($post)
                                            <div class="link-hover-homepage">
                                                <a href="{{ news_url($post) }}"><img
                                                            src="{{$settings->lazy_image ? asset($settings->lazy_image) : asset('/defaults/lazy-default.jpg')}}"
                                                            data-src="{{ $post->featured_image }}"
                                                            class="img-responsive lazy"
                                                            alt="{{ $post->headline }}">
                                                    <h4 class="pt-2">{!! $post->headline !!}</h4>
                                                </a>
                                                <p class="pt-2 excerpt">{{ Str::limit($post->excerpt, 90) }}</p>
                                                <time class="px-1"><?php $ago_time = bn_ago_time($post->created_at); $create_time = e_to_b_replace($ago_time);?> {{ $create_time }}</time>
                                            </div>
                                        @endif
                                        <?php unset($post, $post); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <?php $posts = posts_by_category($category->id, 3, 2); ?>
                            @foreach($posts as $post)
                                <div class="col-md-4">
                                    <div class="content__col">
                                        <div class="link-hover-homepage">
                                            <a href="{{ news_url($post) }}"><img
                                                        src="{{$settings->lazy_image ? asset($settings->lazy_image) : asset('/defaults/lazy-default.jpg')}}"
                                                        data-src="{{ $post->featured_image }}"
                                                        class="img-responsive lazy" alt="{{ $post->headline }}">
                                                <h4 class="py-2">{!! $post->headline !!}</h4>
                                            </a>
                                            <p>{{ Str::limit($post->excerpt, 120) }}</p>
                                            <time><?php $ago_time = bn_ago_time($post->created_at); $create_time = e_to_b_replace($ago_time);?> {{ $create_time }}</time>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <?php unset($posts); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="sidebar">
                            <div class="ads__square ads_6 ads__mbl my-3" align="center">
                                <span>বিজ্ঞাপন</span>
                                <?php $ad = ad_by_position(13); ?>
                                @if(!empty($ad))
                                    @if(!empty($ad->url))
                                        <a href="{{$ad->url}}" target="_blank">
                                            <img src="{{ asset('ads/'.$ad->photo)}}"/>
                                        </a>
                                    @else
                                        <img src="{{ asset('ads/'.$ad->photo)}}"/>
                                    @endif
                                @endif
                                <?php unset($ad) ?>
                            </div>
                            {{--                            <div class="latest mt-3">--}}
                            {{--                                <div class="latest-popular">--}}
                            {{--                                    <ul class="nav nav-pills mb-2" id="pills-tab" role="tablist">--}}
                            {{--                                        <li class="nav-item" role="presentation">--}}
                            {{--                                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"--}}
                            {{--                                                    data-bs-target="#pills-home" type="button" role="tab"--}}
                            {{--                                                    aria-controls="pills-home" aria-selected="true">সর্বশেষ--}}
                            {{--                                            </button>--}}
                            {{--                                        </li>--}}
                            {{--                                        <li class="nav-item" role="presentation">--}}
                            {{--                                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"--}}
                            {{--                                                    data-bs-target="#pills-profile" type="button" role="tab"--}}
                            {{--                                                    aria-controls="pills-profile" aria-selected="false">জনপ্রিয়--}}
                            {{--                                            </button>--}}
                            {{--                                        </li>--}}
                            {{--                                    </ul>--}}
                            {{--                                    <div class="tab-content" id="pills-tabContent">--}}
                            {{--                                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"--}}
                            {{--                                             aria-labelledby="pills-home-tab">--}}
                            {{--                                            <div class="news latestNews">--}}
                            {{--                                                @include('_front._render.latestNews')--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}

                            {{--                                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"--}}
                            {{--                                             aria-labelledby="pills-profile-tab">--}}
                            {{--                                            <div class="news popularNews">--}}
                            {{--                                                @include('_front._render.popularNews')--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}

                            <div class="popular__home mb-3">
                                <div class="popularNews__hm">
                                    <div class="heading w-100">
                                        <h4 class="mb-0">জনপ্রিয়</h4>
                                    </div>
                                    <div class="list-content mb-5">
                                        <div class="popularNewsByCat me-2">
                                            @include('_front._render.popularNewsByCat')
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="ads ads__sidebar mb-4">
                            </div>
                            <div class="ads ads__sidebar mb-4">
                            </div>
                            <div class="sb_content">
                                <div class="singlePageRelPost1"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </section>


    <div class="container mt-1">
        <div class="row">
            <div class="col-md-3 col-lg-3">
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="content-body">
                    <div class="pb-1" id="load_more_post">
                        {{ csrf_field() }}
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3">
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript">
        lazyload();
        window.onload = (function (el) {
            lazyload();
        });
        window.onscroll = function (el) {
            lazyload();
        };

        function lazyload() {
            var lazyImage = document.getElementsByClassName('lazy');

            for (var i = 0; i < lazyImage.length; i++) {
                if (elementInViewport(lazyImage[i])) {
                    lazyImage[i].setAttribute('src', lazyImage[i].getAttribute('data-src'));
                }
            }
        }

        function elementInViewport(el) {
            var rect = el.getBoundingClientRect();
            return (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                rect.right <= (window.innerWidth || document.documentElement.clientWidth)
            );
        }
    </script>
    <script>
        $(document).ready(function () {

            var _token = $('input[name="_token"]').val();
            var total_click = 0;
            load_data('', _token);

            function load_data(id = "", _token) {
                let category_id = {{$category->id}};
                $.ajax({
                    url: "{{ route('loadmore.category.post') }}/" + category_id,
                    method: "POST",
                    data: {id: id, _token: _token, total_click: total_click},
                    success: function (data) {
                        $('#load_more_button').remove();
                        $('#load_more_post').append(data);
                    }
                })
            }

            $(document).on('click', '#load_more_button', function () {
                total_click++;
                var id = $(this).data('id');
                $('#load_more_button').html('আরও <i style="padding:0 2px;" class="fa fa-spinner"></i>');
                load_data(id, _token);
            });

        });
    </script>
@endsection

@section('extra_js')
    <script>
        $(document).ready(function () {
            //ajax district
            $('#division_list').on('change', function (e) {
                var division_id = e.target.value;

                $("#district_list").empty();
                $("#district_list").append('<option selected  value="">জেলা</option>');
                $("#upazila_list").empty();
                $("#upazila_list").append('<option selected  value="">উপজেলা</option>');

                if (division_id) {
                    $.ajax({
                        url: "{{ route('division.district.news') }}/" + division_id,
                        type: "get",
                        dataType: "json",

                        success: function (data) {
                            $("#district_list").empty();
                            $("#district_list").append('<option selected  value="">জেলা</option>');
                            $.each(data, function (key, value) {
                                $('#district_list').append('<option value="' + value.id + '">' + value.name + '</option>')
                            })
                        }
                    })
                } else {
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

                if (district_id) {
                    $.ajax({
                        url: "{{ route('district.upazila.news') }}/" + district_id,
                        type: "get",
                        dataType: "json",

                        success: function (data) {
                            // alert('ok');
                            $("#upazila_list").empty();
                            $("#upazila_list").append('<option selected  value="">উপজেলা</option>');
                            $.each(data, function (key, value) {
                                $('#upazila_list').append('<option value="' + value.id + '">' + value.name + '</option>')
                            })
                        }
                    })
                } else {
                    $("#upazila_list").empty();
                    $("#upazila_list").append('<option selected  value="">উপজেলা</option>');
                }
            });
        });
    </script>



    <script>
        window.onload = function () {
            let catID = {{$category->id}};
            $.ajax({
                url: "{{ route('latestNews') }}",
                method: "GET",
                success: function (res) {
                    $('.latestNews').html(res);
                }
            });

            $.ajax({
                url: "{{ route('popularNewsByCat') }}/"+ catID,
                method: "GET",
                success: function (res) {
                    $('.popularNewsByCat').html(res);
                }
            });

        };
    </script>
@endsection