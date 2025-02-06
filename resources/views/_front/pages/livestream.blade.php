@extends('layouts.frontend')

@section('meta_info')
    @php
        $settings = \App\Models\Setting::find('1');
    @endphp
    <title>Livestream | {{ $settings->site_title }}</title>
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

@section('extra_css')
<link href="//vjs.zencdn.net/5.8/video-js.min.css" rel="stylesheet">
<script src="//vjs.zencdn.net/5.8/video.min.js"></script>
    
    <style>
        
    </style>
@endsection


@section('main_content')

    <section class="home__top pt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <?php $livestream = livestream();?>
                    @if(!empty($livestream->content) && $livestream->status == 1 )
                    <div class=" mb-3">
                        {!! $livestream->content !!}
                    </div>   
                    <video id="player" class="video-js vjs-default-skin" height="360" width="640" controls preload="none">
    <source src="http://localhost:8080/hls/stream.m3u8" type="application/x-mpegURL" />
</video>
                    @else
                    <?php $video = video_query(1);?>
                        @if(!empty($video))
                            <div class="panel-body">
                                {!! embed_video($video) !!}
                            </div>
                            <hr>
                            <span class="info__txt">এখন চলছে</span>
                            <div class="vedio__title mb-3"><h2>{{ $video->title }}</h2></div>
                            <p>প্রকাশিত: {{ bangla_published_time($video->created_at) }}</p>
                        @endif
                    @endif   
                </div>
            </div>
        </div>
    </section>
    
 
   
@endsection


@section('extra_js')

<script>
    var player = videojs('#player');
</script>
@endsection