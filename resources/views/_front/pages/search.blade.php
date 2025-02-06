@extends('layouts.frontend')

@section('meta_info')
    @php
        $settings = \App\Models\Setting::find('1');
    @endphp
    <title>@if(!empty($query)){{$query}}@endif | {{ $settings->site_title }}</title>
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
    <meta name="twitter:creator" content="">
@endsection

<style>
    .search__page .btn.btn-search {
        background: var(--bs-blue);
        padding: 7px 15px 5px;
        height: 40px;
        color: var(--bs-white);
    }

    .search__page .well h4 {
        position: relative;
        top: 6px;
        color: var(--bs-blue);
    }
    .search__page .list-group-item {
        position: relative;
        display: block;
        padding: 0.5rem 0;
        color: #212529;
        text-decoration: none;
        background-color: #fff;
        border: none;
        border-bottom: 1px solid #ccc;
    }
</style>


@section('extra_css')

@endsection

@section('main_content')
    <div class="ads__section single_page py-3">
        <div class="container">
            <div class="matter__banner d-none d-md-block d-lg-block text-center">
                <?php $ad = ad_by_position(3); ?>
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

            <div class="matter__square d-block d-md-none d-lg-none text-center">
                <?php $ad = ad_by_position(2); ?>
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
        </div>
    </div>

    <section class="search__page">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="well well-sm text-left position-relative my-4">
                        <h2 style="margin: 0; float: left; margin-right: 15px;">অনুসন্ধান</h2>
                        <h4>বিষয়: "{{ $query }}"</h4>
                    </div>
                </div>
                <div class="col-md-5 my-4">
                    <form action="{{ route('search') }}" class="form-group" role="search" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" name="x" placeholder="অনুসন্ধান...">
                            <span class="input-group-btn">
                                <button class="btn btn-search" type="submit"><i class="bi bi-search"
                                                                                aria-hidden="true"></i></button>
                            </span>
                            <!--<div class="input-group-btn search-panel">
                                <button type="button" class="btn btn-close search_close"><i class="fa fa-times" aria-hidden="true"></i></i></button>
                            </div>-->
                        </div>
                    </form>
                </div>
            </div>

            <hr>
            <div class="row">
                <div class="col-md-8">
                    <div class="list-group">
                        @if($posts)
                            @foreach($posts as $post)
                                <div class="list-group-item py-2">
                                    <div class="media my-2">
                                        <a href="{{ news_url($post) }}">
                                            <h5 class="media-heading"
                                                style="color: #0000CC; text-decoration: underline;margin-bottom: 10px;font-weight: 300;">{{ strip_tags($post->headline) }}</h5>
                                        </a>
                                        <div class="media-left pe-2" style="width: 25%">
                                            <a href="{{ news_url($post) }}">
                                                <img src="{{$settings->lazy_image ? asset($settings->lazy_image) : asset('/defaults/lazy-default.jpg')}}"
                                                     data-src="{{ !empty($post->featured_mini) ? $post->featured_mini : $post->featured_image }}"
                                                     alt="{{ strip_tags($post->headline) }}" class="lazy media-object">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <p class="caption">{{ strip_tags( Str::limit($post->post_content, 300)) }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <nav class="text-left">
                                {!! $posts->links() !!}
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <h3>আর্কাইভ</h3>
                    <hr>
                    <div class="form-inline mb-3">
                        <div class="form-group">
                            <form action="{{ route('Archive') }}" method="get">
                                <input class="form-control" id="textDate" name="postByDate" @if(!empty($date))value="{{$date}}"@endif placeholder="yyyy-mm-dd" required type="date">
                                <button type="submit" class="btn btn-success mt-3 text-center d-block m-auto">দেখুন</button>
                            </form>
                        </div>
                    </div>
                    <div class="popular__home mb-3">
                        <div class="popularNews__hm">
                            <div class="heading w-100">
                                <h4 class="mb-0">জনপ্রিয়</h4>
                            </div>
                            <div class="list-content mb-5">
                                <div class="popularNews me-2">
                                    @include('_front._render.popularNews')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('extra_js')
    <script src="{{asset('assets/vendors/bootstrap-datepicker-1.6.1/js/bootstrap-datepicker.min.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>

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

@endsection