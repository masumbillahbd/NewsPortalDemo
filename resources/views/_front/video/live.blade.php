@extends('layouts.front')

@section('meta_info')
    <meta name="title" content="News Flash 71 | Live Streaming"/>
    <meta name="keywords" content=""/>
    <meta name="description" content="">
    <meta name="classification" content="Magazine, Newspaper, Artical"/>
    <meta property="og:title" content="News Flash 71 | Live Streaming"/>
    <meta property="og:description" content="">
    <meta property="og:image" content="https://newsflash71.com/img/fb_logo_nf.jpg"/>
    <meta property="og:url" content="https://newsflash71.com"/>
	<meta property="og:site_name" content="News Flash 71">

@endsection


@section('extra_css')
    
@endsection

@section('extra_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script>
        $(document).ready(function () {

            $(".video-carousel").owlCarousel({
                loop: true,
                margin: 10,
                dots: false,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 5
                    }
                }
            });


            $(".photo-carousel").owlCarousel({
                loop: true,
                center: true,
                margin: 30,
                autoplay: true,
                dots: false,
                nav: true,
                autoplayTimeout: 8500,
                smartSpeed: 450,
                navText: ['<i class="glyphicon glyphicon-arrow-left"></i>', '<i class="glyphicon glyphicon-arrow-right"></i>'],
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 1
                    },
                    1170: {
                        items: 1
                    }
                }
            });


        });
    </script>

    <script>
        function openPage(pageName, elmnt, color) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].style.backgroundColor = "";
            }
            document.getElementById(pageName).style.display = "block";
            elmnt.style.backgroundColor = color;
        }

        // Get the element with id="defaultOpen" and click on it
        // document.getElementById("defaultOpen").click();
    </script>
@endsection

@section('main_content')

    <div class="top-banner-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <?php $single_ad = \App\Ad::where("order", 10)->first(); ?>
                    @if($single_ad)
                        @if(strlen( $single_ad->content ) > 8)
                            <div class="advrts">
                                {!! $single_ad->content  !!}
                            </div>
                        @endif
                    @endif

                </div>
                <div class="col-md-4">
                    <?php $single_ad = \App\Ad::where("order", 2)->first(); ?>
                    @if($single_ad)
                        @if(strlen( $single_ad->content ) > 8)

                            <div class="advrts">
                                {!! $single_ad->content  !!}
                            </div>

                        @endif
                    @endif
                </div>
                <div class="col-md-4">
                    <?php $single_ad = \App\Ad::where("order", 3)->first(); ?>
                    @if($single_ad)
                        @if(strlen( $single_ad->content ) > 8)

                            <div class="advrts">
                                {!! $single_ad->content  !!}
                            </div>

                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
	
	
	<div class="live-window-play">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">                
             @if($code)
                        @if($status)
                                <div class="row" style="margin-bottom: 50px;">
                                        <div class="">
                                            <div class="panel-heading" align="left">
                                            <img style="width: 70px;" src="{{ url('/img/live.gif') }}"/>    
                                            </div>
                                            <div class="panel-body" style="padding: 0">
                                                <div class="embed-responsive embed-responsive-16by9">
												{!! html_entity_decode($code) !!}
                                                </div>
                                            </div>
                                        </div>
            </div>
            @endif
         @endif                       
            </div>
            </div>
            
        </div>
    </div>
	
	
@endsection


