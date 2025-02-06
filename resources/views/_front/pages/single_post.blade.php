@extends('layouts.frontend')
@section('page_title', $post->headline . ' | ' . $category->name . ' | '  )
@section('meta_info')
    @php
        $settings = \App\Models\Setting::find('1');
        $postIdFNP = $post->id;
    @endphp
    <title>{{ $post->headline }}</title>
    <meta name="keywords" content="@foreach($post->Tag as $tag){{$tag->name}}, @endforeach"/>
    <meta name="description" content="{{$post->excerpt}}"/>
    <meta itemscope itemtype="{{ news_url($post) }}"/>
    <meta property="og:title" content="{{ $post->headline }} | {{ $settings->site }}"/>
    <meta property="og:description" content="{{$post->excerpt}}">
    <meta property="og:image"
          content="{{ !empty($post->sm_image)?asset('/fb_share/'.$post->sm_image):$post->featured_image }}">
    <meta property="og:image:width" content="640"/>
    <meta property="og:image:height" content="360"/>
    <meta property="og:url" content="{{ news_url($post) }}">
    <meta property="og:image:type" content="image/jpeg"/>
    <meta property="og:image:alt" content="{{$post->headline}}">
    <meta property="og:type" content="website">
    <meta name="twitter:url" content="{{ news_url($post) }}"/>
    <meta name="twitter:title" content="{{ $post->headline }} | {{ $settings->site }}"/>
    <meta name="twitter:description" content="{{$post->excerpt}}"/>
    <meta name="twitter:image"
          content="{{ !empty($post->sm_image)?asset('/fb_share/'.$post->sm_image):$post->featured_image }}"/>
    <meta property="ia:markup_url" content="{{ news_url($post) }}"/>
    <meta property="ia:markup_url_dev" content="{{ news_url($post) }}"/>
    <meta property="ia:rules_url" content="{{ news_url($post) }}"/>
    <meta property="ia:rules_url_dev" content="{{ news_url($post) }}"/>
    <link rel="canonical" href="{{ news_url($post) }}"/>

@endsection
@section('extra_css')
    <style>
        /*read more*/
        .single_page .story-content {
            margin-top: 15px;
        }

        .single_page .also-read-text {
            color: var(--bs-black);
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 4px;
        }

        .single_page .story-content-inner {
            border: 1px solid #eee;
            padding: 10px 12px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .single_page .story-content-inner .link {
            width: 100%;
        }

        .single_page .story-content-inner .link .heading {
            float: left;
            width: 81%;
            font-size: 19px;
            text-align: left;
            padding-right: 5px;
            color: var(--bs-blue);
        }

        .single_page .story-content-inner .link .image {
            width: 18%;
            float: right;
        }

        .single_page .user-info {
            display: inline-flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .single_page .mailme {
            background: #647d0029;
            padding: 22px 60px;
            margin-bottom: 20px;
            font-size: 19px;
            font-weight: 500;
        }

        .single_page .pub__photo img {
            border-radius: 50%;
            width: 55px !important;
            height: 55px;
            margin-right: 3px;
            margin-top: 0px;
        }

        .single_page .printBtn333 {
            background: white;
            color: #7a7a7a;
            border-radius: 4px;
            border: solid 1px #ccc;
            transition: opacity 0.2s ease-in, top 0.2s ease-in;
            display: inline-block;
            font-size: 14px;
            height: 32px;
            line-height: 32px;
            margin-left: 0;
            padding: 0 10px;
            cursor: pointer !important;
        }

        .single_page.ads__top__banner {
            border-bottom: 1px solid #ddd;
        }

        .single_page.ads__top__banner img {
            width: 75%;
        }

        .single_page .follow__btn i {
            font-size: 25px;
            padding: 8px 2px;
            color: #fff;
        }

        .single_page .follow__btn {
            float: right;
            position: relative;
            top: -15px;
            background: transparent;
            padding: 5px 10px;
            border-left: 5px solid var(--bs-danger);
        }

        .single_page .follow__btn span {
            font-weight: 300;
            color: var(--bs-white);
            position: relative;
            top: -3px;
        }

        .single_page .content_body .share-btn .shr__txt {
            height: 30px;
            background: var(--bs-yellow);
            display: flex;
            padding: 3px 12px;
            font-size: 19px;
            margin-right: 4px;
            border-radius: 4px;
            font-weight: 500;
        }

        .single_page .comment .cmnt__bar {
            background: var(--bs-deepred);
            height: 11px;
            position: relative;
            top: -19px;
            z-index: 3;
            left: 0;
            right: 0;
        }

        .single_page .comment p {
            position: relative;
            z-index: 9;
            background: var(--bs-gray-200);
            display: inline;
        }

        .comment {
            background: var(--bs-gray-200);
            padding: 20px;
        }

        .single_page .comment p:before {
            content: '';
            width: 36px;
            height: 12px;
            display: inline-block;
            background: var(--bs-deepred);
            margin-right: 11px;
            top: 0px;
            position: relative;
        }

        .single_page.more_news .cmnt__bar {
            background: var(--bs-gray-300);
            height: 11px;
            position: relative;
            top: -30px;
            z-index: 3;
            left: 0;
            right: 0;
        }

        .single_page.more_news .heading {
            position: relative;
            z-index: 4;
            padding: 0 10px;
            background: var(--bs-white);
            display: inline-block;
            margin: 8px 22px;
        }

        .single_page .content-ad-block360 {
            margin-top: 15px;
            padding-top: 3px;
        }

        .single_page .content-ads-title-360 {
            text-align: center !important;
        }

        .single_page .content p {
            text-align: justify;
        }
        /*//podcast*/
        .podcast audio{
                width: 100%;
                    margin-top: 8px;
        }

        @media (max-width: 991px) {
            .single_page .sidebar .follow__btn a {
                margin: 0 5px;
            }

            .single_page .sidebar .follow__btn span {
                top: 10px;
            }

            .single_page.more_news .cmnt__bar {
                top: -27px;
            }
        }
    </style>
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
                <?php $ad = ad_by_position(11); ?>
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

    <section class="single_page">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="single__page__heading">
                        <a href="{{ category_url($category->id) }}">{{ $category->name }}</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="follow__btn d-flex d-none d-sm-none d-md-block d-lg-block">
                        <a href="{{ $settings->facebook }}" class="facebook" target="_blank"
                           style="background: #226ed3;"><i
                                    class="bx bxl-facebook"></i></a>
                        <a href="{{ $settings->twitter }}" class="twitter" target="_blank"
                           style="background: #1d9bf0"><i
                                    class="bx bxl-twitter"></i></a>
                        <a href="{{ $settings->youtube }}" class="youtube" target="_blank"
                           style="background: #ff0000"><i
                                    class="bx bxl-youtube"></i></a>
                        <a href="#" class="instagram social__icon" target="_blank" style="background: #c038be"><i
                                    class="bx bxl-instagram"></i></a>
                        <a href="#" class="linkedin social__icon d-none" style="background: #0077b5; padding: 0;"><i
                                    class="bx bxl-linkedin social__icon" target="_blank"></i></a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-9">

                    <div class="heading__top">
                        <div class="sub-headline PSubTitle pb-1">
                            <h5>{!! $post->sub_headline !!}</h5>
                        </div>
                        <div class="single-page-headline PTitle pb-4">
                            <h1><b>{!! $post->headline !!}</b></h1>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="reporter__block mb-3" style="width: 85%;">
                                <div class="publisher__info PPublisTime">
                                    <span class="publisher__name PrintPublisTime d-block">
{{--                                        <b>{{ $post->publisher_name }}</b>--}}
                                        @if(!empty($post->reporter_id))
                                            <a href="{{ route('reporter.post',['id'=>$post->reporter->id]) }}"><b>{{ $post->reporter->name }}</b></a>
                                        @endif
                                    </span>
                                    <hr style="border-top: 1px solid #bbb">
                                    <p> প্রকাশিত:

                                        {{engMonth_to_banMonth_replace(ampa_replace(e_to_b_replace(Carbon\Carbon::parse($post->created_at)->format('d F Y H:m a'))))}}
                                        <br>

                                        @if($post->last_update_by != null)
                                            আপডেট: {{engMonth_to_banMonth_replace(e_to_b_replace(Carbon\Carbon::parse($post->last_update_at)->format('d F Y')))}} <?php echo ampa_replace(e_to_b_replace(date("g:i a", strtotime($post->last_update_at)))); ?> @endif
                                    </p>
                                </div>
                                <div class="share-btn w-100 mb-3">
                                    <div class="sharethis-inline-share-buttons" style="width: 90%; float:  left"></div>
                                    <div class="print-btn" style="width: 10%; float:  right">
                                        <button id="printFunc" class="printBtn333">
                                            <i class="bi bi-printer"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="content mt-3 mt-md-0 mt-lg-0">
                                <div class="content_body">
                                    @if( Str::of($post->video_url)->trim()->isEmpty())
                                        <img src="{{$settings->lazy_image ? asset($settings->lazy_image) : asset('/defaults/lazy-default.jpg')}}"
                                             data-src="{{ $post->featured_image }}"
                                             class="img-responsive lazy PImg"
                                             alt="{{ $post->featured_image_caption }}">
                                    @else
                                        <div class="video">
                                            <div class="panel-body">
                                                {!! postVideoStream($post->video_from,$post->video_id) !!}
                                            </div>
                                        </div>
                                    @endif
                                    @if(!empty($post->podcast))
                                    <div class="podcast mt-3">
                                        <span>এই খবরটি পডকাস্টে শুনুনঃ</span>
                                        <audio controls autoplay >
                                          <source src="horse.ogg" type="audio/ogg">
                                          <source src="{{ asset('/podcast/'.$post->podcast) }}" type="audio/mpeg">
                                        Your browser does not support the audio element.
                                        </audio>
                                    </div>
                                    @endif
                    
                                    <div class="content_text ">
                                        <div class="PContent singleContent360">
                                            <p><b>{!! $post->excerpt !!}</b></p>
                                            {!! $post->post_content !!}
                                        </div>
                                        <div class="tag mb-4">
                                            <p>
                                                @if(!empty($post->user_id))
                                                    <b>{{ $post->user->short_name }}</b>
                                                @endif
                                            </p>
                                        </div>

                                        <div align="center"
                                             class="google-ads-banner-4 mb-3 d-none d-md-block d-lg-block">
                                        </div>
                                        <div align="center"
                                             class="google-ads-banner-4 mb-3 d-block d-md-none d-lg-none">
                                        </div>

                                        <div class="tag mb-4">
                                            <p>
                                                @foreach($post->Tag as $tag)
                                                    <a href="{{ tag_url($tag->name) }}">{{ $tag->name }}</a>
                                                @endforeach
                                            </p>
                                        </div>


                                        <div class="social__media text-center d-none">
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <span>সোস্যাল মিডিয়ায় আমরা</span>
                                                </div>
                                                <div class="col-md-4 my-2">
                                                    <div class="fb-like" data-href="https://www.facebook.com/"
                                                         data-width="" data-layout="button_count" data-action="like"
                                                         data-size="small" data-share="true"></div>
                                                </div>
                                                <div class="col-md-4 my-2">
                                                    <script src="https://apis.google.com/js/platform.js"></script>

                                                    <div class="g-ytsubscribe" data-channelid="UCj6dO9EW1kTEGbBwNNo1jeQ"
                                                         data-layout="full" data-count="hidden"></div>

                                                    {{--                                                <a href="https://youtube.com/c/Campuslive24news?sub_confirmation=1"></a>--}}
                                                </div>
                                                <div class="col-md-4 my-2">
                                                    <a href="https://twitter.com/campuslive24?ref_src=twsrc%5Etfw"
                                                       class="twitter-follow-button" data-show-count="false">Follow
                                                        @campuslive24</a>
                                                    <script async src="https://platform.twitter.com/widgets.js"
                                                            charset="utf-8"></script>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="comment">
                                            <p class="mb-0"><b>মন্তব্য করুন:</b></p>
                                            <div class="cmnt__bar d-none"></div>
                                            <div id="fb-root"></div>
                                            <script async defer crossorigin="anonymous"
                                                    src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v8.0&appId=348966578805818&autoLogAppEvents=1"></script>
                                            <div class="fb-comments" data-href="{{ url()->current() }}"
                                                 data-numposts="10"
                                                 data-width=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="sidebar">
                        <div class="fb__page d-block d-md-none d-lg-none text-center my-4">
                            <div class="fb-page" data-href="{{ $settings->facebook }}" data-tabs=""
                                 data-width="" data-height="" data-small-header="false"
                                 data-adapt-container-width="true"
                                 data-hide-cover="false" data-show-facepile="true"></div>
                        </div>
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
                        <div class="follow__btn d-flex  d-sm-none d-md-none d-lg-none text-center my-4"
                             style="float: none">
                            <span>আমাদের ফলো করুন - </span>
                            <a href="{{ $settings->facebook }}" class="facebook" target="_blank"
                               style="background: #226ed3;"><i
                                        class="bx bxl-facebook"></i></a>
                            <a href="{{ $settings->twitter }}" class="twitter" target="_blank"
                               style="background: #1d9bf0"><i
                                        class="bx bxl-twitter"></i></a>
                            <a href="{{ $settings->youtube }}" class="youtube" target="_blank"
                               style="background: #ff0000"><i
                                        class="bx bxl-youtube"></i></a>
                            <a href="#" class="instagram social__icon" target="_blank" style="background: #c038be"><i
                                        class="bx bxl-instagram"></i></a>
                            <a href="#" class="linkedin social__icon d-none" style="background: #0077b5; padding: 0;"><i
                                        class="bx bxl-linkedin social__icon" target="_blank"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="single_page more_news pt-5 pb-1">
                    <h4 class="heading"><b>সম্পর্কিত খবর</b></h4>
                    <div class="cmnt__bar"></div>
                    <div class="singlePageRelPost2"></div>

                </div>
            </div>
        </div>
    </section>

    @php $NPopupCheck = checkNewsPopupStatus($postIdFNP,session()->getId()) @endphp
    @if(empty($NPopupCheck))
    @php $posts =  posts_by_category($category->id,5,9) @endphp
    @if(!empty($posts->count()))
        <div class="side-popup-news-wrapper">
            <div id="side-popup-news-content">
                <div id="newsPopupDisBtn" data-leadId="{{$postIdFNP}}" class="d-flex align-items-center">
                    <span class="close-icon position-relative"><i class="bi bi-x"></i></span>
                    <h3>এই খবরগুলি মিশ করেছেন</h3>
                    <input type="hidden" name="session_id" id="session_id" value="{{ session()->getId() }}">
                </div>
                <div class="side-popup-news-item-box">
                    
                    
                        @foreach($posts as $postItem)
                            <div class="link-hover-homepage position-relative bg__fff mb">
                                <a href="{{ news_url($postItem) }}">
                                    <div class="media-left" style="width: 45%;">
                                        <img src="{{ $postItem->featured_image }}" alt="{{ $postItem->headline }}"
                                             class="{{ $postItem->featured_image }}">
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading">{{ Str::limit($postItem->headline, 45) }}</h4>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                </div>
            </div>
        </div>
        @endif
    @endif

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

    <script type="text/javascript">
        window.onload = function () {
            setTimeout(function () {
                $("div#side-popup-news-content").css({"right": "0px"});
            }, 5000);
            
            $('#newsPopupDisBtn').on('click', function (e) {
            // $("div#side-popup-news-content").css({"right": "-350px"});
            e.preventDefault();
            let post_id = $(this).attr('data-leadId');
            let session_id = $("#session_id").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('newsPopupStatus') }}",
                data: {'post_id': post_id, 'session_id': session_id},
                success: function (data) {
                    $("div#side-popup-news-content").css({"right": "-350px"});
                }
            });
            })
        
            let category_id = {{$category->id}};
            let post_id = {{$postIdFNP}};

            $.ajax({
                url: "{{ route('latestNews') }}",
                method: "GET",
                success: function (res) {
                    $('.latestNews').html(res);
                }
            });

            $.ajax({
                url: "{{ route('popularNewsByCat') }}/" + category_id,
                method: "GET",
                success: function (res) {
                    $('.popularNewsByCat').html(res);
                }
            });
            
            

            

            $.ajax({
                url: "{{ route('singlePageRelPost1') }}/" + category_id,
                method: "GET",
                success: function (res) {
                    $('.singlePageRelPost1').html(res);
                }
            });

            $.ajax({
                url: "{{ route('singlePageRelPost2') }}/" + category_id +'/'+ post_id,
                method: "GET",
                success: function (res) {
                    $('.singlePageRelPost2').html(res);
                }
            });

            $.ajax({
                url: "{{ route('singlePageRelPost3') }}/" + category_id,
                method: "GET",
                success: function (res) {
                    $('.singlePageRelPost3').html(res);
                }
            });

        };
    </script>
@endsection
@section('extra_js')
    <script src="{{ asset('/assets/js/pr.js')}}"></script>
    <script src="{{ asset('assets/js/single.js')}}"></script>

    <script>
        $('#printFunc').on("click", function () {
            $('.adcontente01').hide();
            $('.PTitle, .PSubTitle, .PPublisTime, .PImg, .PContent').printThis({
                debug: false,               // show the iframe for debugging
                importCSS: true,            // import parent page css
                importStyle: false,         // import style tags
                printContainer: true,       // print outer container/$.selector
                loadCSS: "{{ asset('/assets/css/pr.css')}}", // path to additional css file - use an array [] for multiple
                pageTitle: "{{ $settings->site }}",              // add title to print page
                removeInline: false,        // remove inline styles from print elements
                removeInlineSelector: "*",  // custom selectors to filter inline styles. removeInline must be true
                printDelay: 333,            // variable print delay
                header: '<div style="border-bottom: 1px solid #eee;margin-bottom:10px;"><img id="PLogo" style="max-width: 290px; padding-bottom: 3px; height: 80px;width:auto" src="/{{ $settings-> logo }}"/></div>',               // prefix to html
                footer: '<address style="border-top: 1px solid #ccc; padding-top: 20px;text-align: center"><strong> সম্পাদক: {{ $settings->cr_text_1 }} </strong><br><strong>যোগাযোগ: </strong> {{ strip_tags($settings->cr_text_2) }}<br><strong>মোবাইল:</strong> {{ $settings->site_mobile }}; <strong>ইমেইল:</strong> {{ $settings->site_email }}<br> </address> <p id="PFooter" style="display:block;border-top:1px solid #eee;text-align:center;padding-top:5px;">© <?php $date = date('Y'); $date = e_to_b_replace($date); echo $date; ?> {{ $settings->site }} | সর্বস্বত্ব স্বত্বাধিকার সংরক্ষিত</p>', // postfix to html
                base: false,                // preserve the BASE tag or accept a string for the URL
                formValues: true,           // preserve input/form values
                canvas: false,              // copy canvas content
                doctypeString: '',       // enter a different doctype for older markup
                removeScripts: false,       // remove script tags from print content
                copyTagClasses: false,      // copy classes from the html & body tag
                beforePrintEvent: null,     // function for printEvent in iframe
                beforePrint: null,          // function called before iframe is filled
                afterPrint: null            // function called before iframe is removed
            });
        });
    </script>


    <!--single page content ads-->
    <?php $inads = \App\Models\InnerAd::where('status', 1)->orderBy('id', 'desc')->first(); ?>
    @if(!empty($inads))
        <script>
            $(document).ready(function () {
                // $(".singleContent360 div").last().append("<h2>Demo</h2>");
                $(".singleContent360 p").first().addClass("selected-div-inner-ad");
                $(".selected-div-inner-ad").next().addClass("content-inner-ads360");
                $(".content-inner-ads360").after().append("<div class='content-ad-block360'> <a href='{{$inads->url}}' target='_blank'>  <center> <p class='content-ads-title-360' style='margin:0px;font-size:13px;color:#838383;margin-top: 5px;'>  বিজ্ঞাপন</p>   <img class='adcontente01' src='{{ asset('/ads/'.$inads->photo)}}'/>  </center> </a> </div>");
            });
        </script>
    @endif
    <?php unset($inads) ?>

    <?php $readmore = \App\Models\ReadMore::where('leader', $post->id)->orderBy('id', 'desc')->first();  ?>
    @if(!empty($readmore))
        @if(!empty($readmore->post->id))
            <script>
                $(document).ready(function () {
                    $(".singleContent360 p").first().addClass("story-element");
                    $(".story-element").next().next().addClass("story-container");
                    $(".story-container").after().append("<div class='story-content'> <div class='also-read-text'>আরও পড়ুন</div> <div class='story-content-inner'><a href='{{  news_url_for_readmore($readmore->post->id) }}' class='link' target='_self'> <h2 class='heading'>{{ $readmore->post->headline }}</h2> <img class='image' src='{{ $readmore->post->featured_image }}'/>  </a></div> </div>");
                });
            </script>
        @endif
    @endif
    <?php unset($readmore) ?>

    <?php $readmore = \App\Models\ReadMore::where('leader', $post->id)->orderBy('id', 'desc')->skip(1)->first();  ?>
    @if(!empty($readmore))
        @if(!empty($readmore->post->id))
            <script>
                $(document).ready(function () {
                    $(".singleContent360 p").first().addClass("story-element");
                    $(".story-element").next().next().next().next().addClass("story-container101");
                    $(".story-container101").after().append("<div class='story-content'> <div class='also-read-text'>আরও পড়ুন</div> <div class='story-content-inner'><a href='{{  news_url_for_readmore($readmore->post->id) }}' class='link' target='_self'> <h2 class='heading'>{{ $readmore->post->headline }}</h2> <img class='image' src='{{ $readmore->post->featured_image }}'/>  </a></div> </div>");
                });
            </script>
        @endif
    @endif
    <?php unset($readmore) ?>


    <?php $readmores = \App\Models\ReadMore::where('leader', $post->id)->orderBy('id', 'desc')->skip(2)->take(5)->get();  ?>
    @if(!empty($readmores))
        @foreach($readmores as $readmore)
            @if(!empty($readmore->post->id))
                <script>
                    $(document).ready(function () {
                        $(".singleContent360 p").first().addClass("story-element");
                        $(".story-element").next().next().next().next().next().next().next().addClass("story-container103");
                        $(".story-container103").after().append("<div class='story-content'> <div class='also-read-text'>আরও পড়ুন</div> <div class='story-content-inner'><a href='{{  news_url_for_readmore($readmore->post->id) }}' class='link' target='_self'> <h2 class='heading'>{{ $readmore->post->headline }}</h2> <img class='image' src='{{ $readmore->post->featured_image }}'/>  </a></div> </div>");
                    });
                </script>
            @endif
        @endforeach
    @endif
    <?php unset($readmores) ?>

    <script>
        
        
    </script>
@endsection
