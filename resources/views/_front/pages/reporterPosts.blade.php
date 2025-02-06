@extends('layouts.frontend')
@section('meta_info')
    <?php $settings = \App\Models\Setting::find(1); ?>
    <title>{{ $reporter->name }} | {{ $settings->site_title }}</title>
    <meta name="keywords" content="{{ $settings->meta_keywords }}"/>
    <meta name="description" content="{{ $settings->meta_description }}">
    <meta name="classification" content="Magazine, Newspaper, Artical"/>
    <meta property="og:title" content="{{ $reporter->name }} | {{ $settings->meta_title }}"/>
    <meta property="og:description" content="{{ $settings->meta_description }}">
    <meta property="og:image"
          content="{{ $reporter->photo ? asset('reporter/'.$reporter->photo) : asset('defaults/avatar01.png')  }}"/>
    <meta property="og:url" content="{{ $settings->site_url }}"/>
    <meta property="og:site_name" content="{{ $settings->site }}">
    <meta name="twitter:url" content="{{ $settings->site_url }}"/>
    <meta name="twitter:title" content="{{ $reporter->name }} | {{ $settings->site_title }}"/>
    <meta name="twitter:description" content="{{ $settings->meta_description }}"/>
    <meta name="twitter:image"
          content="{{ $reporter->photo ? asset('reporter/'.$reporter->photo) : asset('defaults/avatar01.png')  }}"/>
@endsection


@section('extra_css')
    <style>

    </style>
@endsection


@section('main_content')
    <section class="reporter__post pt-0">
        <div class="ads__banner bg__grey py-3 m-auto" align="center">
            <div class="container">
                <img src="/ads/1677944913.gif" class="ads__file">
            </div>
        </div>
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-12 my-5">
                    <div class="profile__info text-center">
                        <div class="photo mb-3">
                            <img src="{{ $reporter->photo ? asset('reporter/'.$reporter->photo) : asset('defaults/avatar01.png')  }}">
                        </div>
                        <div class="name">
                            <h3>{{$reporter->name}}</h3>
                            <h4>{{$reporter->designation}}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="reporters__post__content">
                <div class="heading">
                    <h4>প্রকাশিত প্রবন্ধসমূহ</h4>
                </div>
                <?php $posts = posts_by_reporter($reporter->id, 5); ?>
                @if($posts)
                    <div class="row">
                        @foreach($posts as $post)
                            <div class="col-md-2 col-6">
                                <div class="link-hover-homepage position-relative mb-3">
                                    <a href="{{ news_url($post) }}"><img
                                                src="{{$settings->lazy_image ? asset($settings->lazy_image) : asset('/defaults/lazy-default.jpg')}}"
                                                data-src="{{ $post->featured_image }}"
                                                alt="{!! $post->headline !!}"
                                                class="img-responsive lazy">
                                        <h4 class="pt-2">{{ Str::limit($post->headline, 45) }}</h4>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-12 mt-3">
                        {{$posts->links()}}
                    </div>
                @endif
            </div>
        </div>
    </section>




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

@endsection

@section('extra_js')

@endsection