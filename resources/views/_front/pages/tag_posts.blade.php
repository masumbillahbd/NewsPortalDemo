@extends('layouts.frontend')

<style>

</style>

@section('main_content')
    <section class="tag-page">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <ol class="breadcrumb ps-2">
                        <li>
                            <span style="font-size: 25px;">বিষয়:</span> <a style="font-size: 25px; color: #2b62b5;"
                                                                           href="{{ tag_url($tag->name) }}">{{ $tag->name }}</a>
                        </li>
                    </ol>
                    @foreach($posts as $post)
                        <div class="callout-card">
                            <div class="row"
                                 style="margin-bottom: 15px;border-bottom: 1px solid #ececec; padding-bottom: 15px;">

                                <div class="col-md-3 col-xs-4 col-sm-4">
                                    <a href="{{ news_url($post) }}"><img style="margin: 6px 0;"
                                                                         class="media-object img-responsive"
                                                                         src="{{$post->featured_image}}"
                                                                         alt="{{ $post->headline }}"></a>
                                </div>
                                <div class="col-md-9 col-xs-8 col-sm-8">
                                    <div class="media-body">
                                        <ul class="list-inline ">
                                            <li><h3 class="media-heading"><a
                                                            href="{{ news_url($post) }}">{{ $post->headline }}</a></h3>
                                            </li>
                                            <li class="pull-right"><i
                                                        class="fa fa-clock-o"></i> {{ bangla_published_time($post->created_at) }}
                                            </li>
                                            <li class="clearfix"></li>
                                        </ul>
                                        <p class="hidden-xs"
                                           style="margin: 8px 0 20px 0">{{  Str::limit($post->excerpt, 140) }} <a
                                                    href="{{ news_url($post) }}"><strong>বিস্তারিত</strong></a></p></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                    <div class="row">
                        <div class="col-md-12 text-center">
                            {!! $posts->links() !!}
                        </div>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="ads__square ads_6 ads__mbl mb-3" align="center">
{{--                        <span>বিজ্ঞাপন</span>--}}
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