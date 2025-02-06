@extends('layouts.frontend')

@section('meta_info')
    @php
        $settings = \App\Models\Setting::find('1');
    @endphp
    <title>@if(!empty($sub_category->name)){{$sub_category->name}}@endif | {{ $settings->site_title }}</title>
    <meta name="title" content="{{ $settings->site_title }}"/>
    <meta name="keywords" content="{{ $settings->meta_keywords }}"/>
    <meta name="description" content="{{ $settings->meta_description }}">
    <meta name="classification" content="Magazine, Newspaper, Artical"/>
    <meta property="og:title" content="{{ $settings->meta_title }}"/>
    <meta property="og:description" content="{{ $settings->meta_description }}">
    <meta property="og:image" content="{{ url($settings->meta_image) }}"/>
    <meta property="og:url" content="{{ $settings->site_url }}"/>
    <meta property="og:site_name" content="{{ $settings->site }}">
    <meta name="twitter:url" content="{{ $settings->site_url }}"/>
    <meta name="twitter:title" content="{{ $settings->site_title }}"/>
    <meta name="twitter:description" content="{{ $settings->meta_description }}"/>
    <meta name="twitter:image" content="{{ url($settings->meta_image) }}"/>
@endsection

@php $url = URL::current(); $urls = explode('/', $url); $lasturl = end($urls);    @endphp

@section('extra_css')
    <style>
        .sub__cat .sub span:last-child::after {
            display: none;
        }

        .sub__cat .sub span:after {
            background-color: var(--bs-blue);
            margin: 0 11px;
        }
    </style>

@endsection

@section('main_content')
    <section class="section_page sub__cat">
        <div class="container-bg">
            <div class="container">
                <div class="row hidden">
                    <div class="col-md-12">
                        <div class="section_heading sub__cat__page d-flex pt-3 pb-4">
                            <a href="{{ sub_category_url($sub_category->slug) }}">{{ $sub_category->name }}</a>
                        </div>
                        <div class="sub pb-4">
                            <?php $sub_categories = $category->SubCategory->all();  ?>
                            @foreach($sub_categories as $sub_cat)
                                @if($sub_cat->slug == $lasturl)
                                    <span style="color:red;">{{ $sub_cat->name }}</span>
                                @else
                                    <span>
                                    <a class="activesubcat"
                                       href="{{ route('sub_cat.post', ['cat' => $category->slug, 'sub_cat' => $sub_cat->slug]) }}">{{ $sub_cat->name }}</a></span>
                                @endif
                            @endforeach
                            <?php unset($sub_categories, $category); ?>
                        </div>
                    </div>
                </div>
                <div class="cat__pg__top__1">
                    <div class="row">
                        <div class="border__right col-md-6">
                            <?php $post = posts_by_sub_category($sub_category->id, 1);  ?>
                            @if(!empty($post))
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
                            @else
                                <p class="text-center">দু:খিত! কোন সংবাদ পাওয়া যায় নি...</p>
                            @endif
                            <?php unset($post); ?>
                        </div>
                        <div class="col-md-3">
                            <div class="sidebar">
                                <div class="content__col">
                                    <?php $posts = posts_by_sub_category($sub_category->id, 2, 1); ?>
                                    @if($posts)
                                        @foreach($posts as $post)
                                            <div class="border__btm">
                                                <div class="link-hover-homepage">
                                                    <a href="{{ news_url($post) }}"><img
                                                                src="{{ $post->featured_image }}"
                                                                class="img-responsive" alt="{{ $post->headline }}">
                                                        <h4 class="pt-2">{!! $post->headline !!}</h4>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    <?php unset($posts); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="sidebar">
                                <div class="ads ads_6" align="center">
                                    <img src="/photos/5/818d5020-6a1e-44c7-a857-732f05234915.jpg"
                                         class="img-responsive">
                                </div>
                                <div class="latest mt-3">
                                    <div class="latest-popular">
                                        <ul class="nav nav-pills mb-2" id="pills-tab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="pills-home-tab"
                                                        data-bs-toggle="pill"
                                                        data-bs-target="#pills-home" type="button" role="tab"
                                                        aria-controls="pills-home" aria-selected="true">সর্বশেষ
                                                </button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                                        data-bs-target="#pills-profile" type="button" role="tab"
                                                        aria-controls="pills-profile" aria-selected="false">জনপ্রিয়
                                                </button>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                                 aria-labelledby="pills-home-tab">
                                                <div class="news latestNews">
                                                    @include('_front._render.latestNews')
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                                 aria-labelledby="pills-profile-tab">
                                                <div class="news popularNews">
                                                    @include('_front._render.popularNews')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-9">
                        <div class="cat-block-2">
                            <?php $posts = posts_by_sub_category($sub_category->id, 2, 3); ?>
                            @if($posts)
                                <div class="row">
                                    @foreach($posts as $post)
                                        <div class="col-md-4 col-xs-6">
                                            <div class="lead_8_content1">
                                                <div class="thumbnail">
                                                    <div class="link-hover-homepage">
                                                        <a href="{{ news_url($post) }}">
                                                            <img src="{{ $post->featured_image }}"
                                                                 class="img-responsive" alt="{{ $post->headline }}">
                                                        </a>
                                                        <div class="body__content__child">
                                                            <a href="{{ news_url($post) }}">
                                                                <h5 class="pt-3 px-2">{{ Str::limit($post->headline, 75) }}</h5>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <?php unset($posts); ?>
                        </div>
                    </div>
                    <div class="col-md-3">

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('extra_js')

@endsection