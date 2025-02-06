@php $settings = setting(); @endphp

<style>
    .footer-logo img {
        width: 135px;
        height: auto;
        float: right;
        line-height: 1;
    }

    .footer-logo .border__footer {
        border-top: 1px solid #d1d1d1;
        width: 100%;
    }

    #footer .footer-links .social-links a {
        font-size: 20px;
        display: inline-block;
        background: #226ed3;
        color: #fff;
        line-height: 1;
        padding: 8px 0;
        margin-right: 4px;
        border-radius: 50%;
        text-align: center;
        width: 36px;
        height: 36px;
        transition: 0.3s;
        margin-bottom: 11px;
    }

    #mobilemenuopen {
        background: none;
        border: none;
        padding-top: 2px;
        font-size: 18px;
        padding-right: 9px;
    }



    .navbar > ul > .dropdown:hover .dropdown:after{
        display: none;
    }
    .navbar > ul > .dropdown:hover {
        background: #c5332d;
    }

    /*#topbar{*/
    /*    display: none !important;*/
    /*}*/

    #searchOpenBtn {
        background: transparent;
        border: none;
        width: auto;
        height: auto;
        padding-left: 0;
        margin-left: 4px;
    }

    footer .nav.social a {
        color: var(--bs-white) !important;
    }

    .breaking__news{
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        margin-top: 0 !important;
    }
    /*------------------------------
    Trending Item
    -------------------------------*/
    .topic__item .heading{
        background: #124b65;
        line-height: 1;
        padding: 7px 7px 5px;
        color: #fff;
        font-size: 17px;
    }
    .topic__item .body a{
        line-height: 1;
        padding: 7px 6px 5px 12px;
        background: #e1e1e1;
        margin-left: 10px;
        font-size: 17px;
    }
    .topic__item .body a:hover {
        background: #ef0000;
        color: #fff;
    }
    .topic__item .body i{
        position: relative;
        font-size: 12px;
        left: -3px;
        line-height: 1;
    }

    .vote-result{
        padding-bottom: 22px;
        padding-left: 0px;
        padding-top: 9px;
    }

    .vote-result h5{
        font-size: 16px;
        float: left;
    }
    .vote-result h5:after{
        content: '';
        width: 1px;
        height: 14px;
        display: inline-block;
        background: #dbdbdb;
        margin-left: 5px;
        top: 3px;
        position: relative;
        margin-right: 8px;
    }
    .vote-result h5:last-child:after{
        display: none;
    }

    /*----------------------------
    Reporter Post
    -----------------------------*/
    .reporter__post .profile__info .photo img{
        width: 220px;
        height: 220px;
        object-fit: cover;
        border-radius: 50%;
        padding: 4px;
        border: 4px solid #f1f1f1;
    }
    .reporters__post__content .heading{
        border-bottom: 2px solid #ededed;
        margin-bottom: 19px;
        padding-bottom: 0px;
    }
    .reporters__post__content .heading h4{
        margin-bottom: 2px;
        font-size: 23px !important;
        font-weight: 500;
    }

    @media (max-width: 991px) {
        .topic__item{
            display: none !important;
        }
        .info {
            text-align: center !important;
        }
        .navbar {
            float: right;
        }

        .copyright img {
            width: auto;
            max-height: 75px;
        }

        .copyright .logo {
            text-align: center !important;
        }

        #mobilemenu {
            width: 100%;
            position: relative;
            z-index: 9999;
            top: -4px;
            float: left;
            text-align: left;
        }

        #mobilemenu form {
            width: 85%;
            float: right;
        }

        #mobilemenu .search-input {
            top: 0;
            right: 0;
            outline: 0;
            background: var(--bs-white);
            height: 35px;
            margin: 0;
            z-index: 10;
            padding: 0 10px;
            font-family: sans-serif;
            font-size: 16px;
            color: #2c3e50;
            border: 1px solid var(--bs-gray-400);
            width: 85%;
            border-radius: 4px 0 0 4px;
        }

        .mobilemenuclose {
            width: 38px;
            height: 35px;
            border: none;
            position: relative;
            right: 5px;
            background: var(--bs-red);
            top: 1px;
            font-size: 20px;
            padding: 0;
            color: var(--bs-white);
            font-weight: 300;
            border-radius: 0 4px 4px 0;
        }

        .mobilemenu form .searchIcon {
            right: 45px;
            border-radius: 0;
            background: var(--bs-litegreen);
            height: 35px;
            border: 1px solid var(--bs-litegreen);
            top: 1px;
            width: 37px;
            padding: 6px;
        }

        .single__video__page .comment {
            width: 100%;
        }

        #mobilemenuopen .bi.bi-search {
            font-size: 17px;
        }
    }

    /*----------------------
    Mega Menu
    -----------------------*/

    .main-menu ul > li{
        width: 15%;
        float: left;
        text-align: left;
    }

</style>

<footer class="text-inverse pb-3 pt-4" style="background: #f5f5f5 !important;box-shadow: 0px -4px 11px #e3e3e3;">
    <div class="container">
        <div class="row gy-6 gy-lg-0">
            <div class="col-md-6 col-lg-6">
                <div class="widget mb-3">
                    <div class="footer-logo text-center d-none d-md-none d-lg-none">
                        <a href="/" class="logo"><img src="/{{ $settings-> logo }}" alt="{{ $settings->site }}"></a>
                    </div>
                    <div class="editors__info">
                        <h5>প্রধান সম্পাদক ও প্রকাশক<br><b>{{ $settings->cr_text_1 }}</b></h5>
                        <a href="/our-team" target="_blank" class="our__team"><h5>আমরা</h5></a>
                    </div>
                    <hr class="my-3 border" style="width: 205px"/>
                    <nav class="nav social social-white">
                        <a href="{{ $settings->facebook }}" class="facebook me-1 px-1" target="_blank"
                           style="background: #1877f2"><i
                                    class="bx bxl-facebook"></i></a>
                        <a href="{{ $settings->twitter }}" class="twitter me-1 px-1" target="_blank"
                           style="background: #1d9bf0"><i
                                    class="bx bxl-twitter"></i></a>
                        <a href="{{ $settings->youtube }}" class="youtube me-1 px-1" target="_blank"
                           style="background: #ff0000"><i class="bx bxl-youtube"></i></a>
                        <a href="{{ $settings->instagram }}" class="instagram me-1 px-1" target="_blank"
                           style="background: #c038be"><i
                                    class="bx bxl-instagram"></i></a>
                        <a href="{{ $settings->linkedin }}" class="linkedin me-1 px-1" style="background: #0077b5"
                           target="_blank"><i
                                    class="bx bxl-linkedin"></i></a>
                    </nav>
                    <!-- /.social -->
                </div>
                <!-- /.widget -->
            </div>
            <!-- /column -->
            <div class="col-md-4 col-lg-2">

                <!-- /.widget -->
            </div>
            <!-- /column -->
   
            <div class="col-md-12 col-lg-4">
                <div class="widget contact__info">
                    <p class="ofc__address"><a href="/contact-us" style="margin-left: -8px;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pin"
                                 width="28" height="22" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ff2825"
                                 fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"/>
                                <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z"/>
                            </svg>
                        </a>{{ strip_tags($settings->cr_text_2) }}</p>
                    <p>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail-opened"
                             width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ff2825" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M3 9l9 6l9 -6l-9 -6l-9 6"/>
                            <path d="M21 9v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10"/>
                            <path d="M3 19l6 -6"/>
                            <path d="M15 13l6 6"/>
                        </svg>{{ $settings->site_email }}</p>
                    <p>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone" width="20"
                             height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ff2825" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"/>
                        </svg>{{ $settings->site_mobile }}</p>
                    <hr>
                    <div class="widget footer__url">
                        <a href="/privacy-policy">Privacy Policy</a>
                            <a href="/contact-us">Contact Us</a>
                    </div>

                </div>
            </div>
        </div>
        <!--/.row -->
        <hr class="my-3"/>
        <div class="d-md-flex align-items-center justify-content-between copyright">
            <p class="mb-2 mb-lg-0">কপিরাইট © <?php $date = date('Y'); $date = e_to_b_replace($date); echo $date; ?>
                <strong><span> <a href="/">{{ $settings->site_url }}</a></span></strong> | সর্বস্বত্ব স্বত্বাধিকার
                সংরক্ষিত
            </p>
            <nav class="brand__icon social-white text-md-end">
                {{--                <p class="mb-0">Developed with <i class="bi bi-heart-fill" style="color: var(--bs-deepyellow)"></i> by <a--}}
                {{--                            href="https://www.godevsbd.com/" target="_blank">go Devs</a></p>--}}
                <p class="mb-0">Developed by <a
                            href="https://www.godevsbd.com/" target="_blank" style="color: #ff7800 !important;">go
                        Devs</a></p>
            </nav>
            <!-- /.social -->
        </div>
    </div>
</footer>
