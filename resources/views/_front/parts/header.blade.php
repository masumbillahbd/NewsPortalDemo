<?php $settings = \App\Models\Setting::find(1); ?>
<style>
    p{
        color: #000000de !important;
    }
    /*==================
    Single Page Side-Pop Session
    ==============================*/
    div#side-popup-news-content {
        position: fixed;
        bottom: 0;
        right: -350px;
        height: 300px;
        width: 280px;
        color: #fff;
        border-top: 4px solid #505050;
        border-left: 4px solid #505050;
        z-index: 9999999;
        overflow-y: auto;
        background: #fff;
        transition: 0.9s;
    }

    div#side-popup-news-content .close-icon {
        width: 30px;
        height: 33px;
        background: #f10000;
        font-size: 27px;
        cursor: pointer;
        z-index: 999;
        padding: 0px 2px;
        top: -3px;
    }

    div#side-popup-news-content .media-left {
        padding-right: 5px;
    }

    #newsPopupDisBtn h3 {
        line-height: 1;
        font-size: 21px;
        padding: 4px 4px 6px;
        margin-bottom: 0;
        color: #fff;
    }

    #newsPopupDisBtn {
        background: #5a5a5a;
        margin-bottom: 5px;
    }

    .side-popup-news-item-box .link-hover-homepage:hover img {
        transform: scale(1);
    }

    .side-popup-news-item-box .link-hover-homepage img {
        opacity: 1;
        width: 106px;
        margin-left: 5px;
    }

    .side-popup-news-item-box .link-hover-homepage .media-body h4 {
        margin-bottom: 0;
        font-size: 16px !important;
        line-height: 1.3;
    }

    .side-popup-news-item-box .link-hover-homepage {
        margin-bottom: 6px;
        border-bottom: 1px solid #efefef;
        padding-bottom: 1px;
    }

    @media (max-width: 991px) {
        div#side-popup-news-content {
            right: -250px;
            height: 270px;
            width: 225px;
        }

        #newsPopupDisBtn h3 {
            font-size: 15px;
        }

        .side-popup-news-item-box .link-hover-homepage img {
            width: 87px;
            margin-top: 2px;
        }

        .side-popup-news-item-box .link-hover-homepage .media-body h4 {
            font-size: 14px !important;
        }

        /*.side-popup-news-item-box .link-hover-homepage .media-left{*/
        /*    width: 35% !important;*/
        /*}*/
        .side-popup-news-item-box .link-hover-homepage {
            height: 58px;
            overflow: hidden;
        }
    }

    /*============= Home Page Start ==============*/

    .sub__heading {
        color: var(--bs-red);
    }

    .lead__title {
        font-weight: 600;
    }

    .block__row__4 .overlay_block_2 .border__right:last-child {
        border-right: none;
    }

    .full__row__11 .block__main .link-hover-homepage {
        background: #794bff1c;
        padding: 10px;
        border-radius: 8px;
        box-shadow: 0 4px 7px hsl(0deg 0% 0% / 19%);
        height: 349px;
        overflow: hidden;
    }

    .full__row__11 .block__main .link-hover-homepage img {
        height: 111px;
        width: 111px;
        border: 2px solid var(--bs-blue);
        padding: 2px;
        border-radius: 50%;
        object-fit: cover;
        margin-top: 15px;
    }

    .full__row__11 .block__main .link-hover-homepage h4 {
        font-size: 16px !important;
        line-height: 1.3em;
    }

    .full__row__11 .block__main .link-hover-homepage .sub__heading {
        display: block;
        margin-top: 10px;
    }

    .cat__bar__hm__all {
        width: 20px;
        height: 4px;
        background: #ff0000;
    }

    .full__row__excludive .media {
        float: left;
    }

    .full__row__excludive .media-title span {
        color: #ff7878;
        font-weight: 300;
        font-size: 16px;
        letter-spacing: 1px;
        text-shadow: 0px 0px 21px var(--bs-black);
        background: var(--bs-black) 00096;
        padding: 1px 6px;
        border-radius: 3px;
    }

    .full__row__excludive {
        background: transparent;
        border-bottom: 1px solid transparent;
    }

    .full__row__excludive .media-title h4 {
        line-height: 1.3;
        color: #fff;
    }

    .full__row__excludive .media img {
        width: 100%;
    }

    .video-block-main .video-top-content:hover h3, .full__row__9 .block__main:hover h3 {
        color: var(--bs-deepyellow) !important
    }

    .district__block .form-group .form-control, .district__block .btn__n__search button {
        height: 51px;
        padding: 12px 15px;
        font-size: 19px;
    }

    .district__block form {
        background: #006fa742;
        padding: 9px 20px 2px;
        border-radius: 4px;
    }

    .district__block .category-heading {
        margin-bottom: 8px;
    }

    .online__vote .heading {
        background: transparent;
        padding: 4px 9px 1px;
        border-top: 6px solid #0092cd;
        border-bottom: 2px solid #0092cd;
        margin-bottom: 13px !important;
    }

    .online__vote .heading a {
        background: transparent;
        padding: 0;
        font-size: 23px;
        color: #0092cd;
        display: inline-block;
        padding-right: 10px;
    }

    .online__vote .body {
        border: 1px solid #0092cd30;
    }

    .online__vote .body h4 {
        font-size: 17px !important;
    }

    .online__vote span {
        border: 1px solid #0092cd30;
        display: block;
        border-radius: 39px;
        padding: 6px 10px;
        height: 37px;
        margin-bottom: 10px;
    }

    .online__vote .btn__vote .btn__submit {
        display: inline-block;
        text-align: center;
        background: #0092cd42;
        border-radius: 41px;
        margin-bottom: 10px;
        color: #0088bf;
        padding: 5px 23px;
    }

    .full__row__9 .block__main .media .media-title h3 {
        color: var(--bs-white);
    }

    .full__row__9 .cat__block__main .link-hover-homepage {
        border-bottom: 1px solid #ddd;
        padding-bottom: 8px;
    }

    .full__row__3 .border__right:last-child {
        border-right: none;
    }

    li.active a {
        color: var(--bs-black);
    }

    .navbar .active, .navbar .active:focus, .navbar a:hover, .navbar li:hover > a {
        color: var(--bs-black);
    }

    .sub__cat__page h3 {
        margin-top: 16px;
        font-size: 18px;
        margin-left: 10px;
        color: #565656;
    }

    .latest-popular .news {
        height: 400px;
    }

    .popularNews__hm .list-content {
        max-height: 444px;
        overflow-y: scroll;
        border: 1px solid #c5332d;
    }

    .popularNews__hm {
        padding: 7px 0px;
        display: block;
    }

    .popularNews__hm .heading {
        background-color: #efefef;
        border: none;
        border-radius: 0;
        text-align: left;
        color: #fff;
        padding: 0px;
    }

    .popularNews__hm .heading h4 {
        background: #c5332d;
        padding: 10px 16px 7px;
        line-height: 1;
        width: 87px;
        color: #fff;
    }

    .popularNews__hm .item {
        padding: 8px;
    }

    .popularNews__hm .item img {
        height: 51px;
        width: 100%;
        object-fit: cover;
        border-radius: 3px;
        margin-top: 6px;
    }

    .link-hover-homepage img {
        opacity: .9;
    }

    .link-hover-homepage:hover img {
        opacity: 1;
    }

    .lead__middle__block .link-hover-homepage {
        overflow: hidden;
        margin-bottom: 6px;
        background: 0 0 !important;
        height: auto !important;
        border-bottom: 1px solid #e7e7e7;
        padding-bottom: 2px;
        padding-top: 1px;
    }

    .btn-success {
        color: #0abb75;
        background-color: rgba(10, 187, 117, 0.15);
        border: none;
    }

    .btn-success:hover {
        color: #fff;
        background-color: #0abb75;
        border-color: #0abb75;
    }

    /*.lead__single__content {*/
    /*    position: absolute;*/
    /*    bottom: 0;*/
    /*    z-index: 3;*/
    /*    text-shadow: 0 1px 2px rgb(0 0 0 / 60%);*/
    /*    right: 0% !important;*/
    /*    left: 0% !important;*/
    /*    padding: 50px 19px 6px;*/
    /*    margin: 0;*/
    /*    background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0) 0, var(--bs-black)000c9 90%);*/
    /*}*/

    .lead__single__content:hover h3 {

    }

    .lead__single__content h3 {
        color: var(--bs-black);;
        font-weight: 600;
    }

    time {
        font-size: 13px;
        display: block;
    }

    .slick-dots {
        display: none !important;
    }

    .last__row__2 .link-hover-homepage .caption {
        position: absolute;
        bottom: 7px;
        left: 2px;
        right: 0;
        background-image: linear-gradient(0deg, rgba(0, 0, 0, .85), transparent 48%);
        padding-top: 100px;
    }

    .last__row__2 .link-hover-homepage .caption h4 {
        line-height: 1.2em;
        color: var(--bs-white);
        text-shadow: 0 1px 2px rgba(0, 0, 0, .6);
    }

    .last__row__2 .block__child .media-left {
        width: 35%;
    }

    .last__row__2 .block__child .link-hover-homepage {
        box-shadow: 0px 1px 7px #dbdbdb;
        padding: 4px 4px 0;
        height: 64px;
        overflow: hidden;
    }

    .last__row__2 .block__child .link-hover-homepage h4 {
        font-size: 16px !important;
        line-height: 1.4;
    }

    .last__row__2 .item__lead .link-hover-homepage:hover h4, .homePageExcludive .link-hover-homepage:hover .media-title h4, .homePageExclusive .link-hover-homepage:hover .media-title h4 {
        color: var(--bs-deepyellow) !important;
    }

    .latest-popular .item:hover h6 {
        color: var(--bs-blue);
    }

    .link-hover-homepage:hover h2, .link-hover-homepage:hover h5 {
        color: var(--bs-deepred) !important;
    }

    .link-hover-homepage:hover h4, .link-hover-homepage:hover a, .block__row__4 .block__lead:hover h3 {
        color: var(--bs-deepred) !important;
    }

    .full__row.row__3 .caption{
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: linear-gradient(transparent, var(--bs-black));
        padding: 13px 11px;
        margin-bottom: 0;
    }
    .full__row.row__3 .border__right:last-child {
        border-right: none;
    }
    .full__row.row__3 .css__block__4 {
        border-bottom: 1px solid #e9e9e9;
        margin-bottom: 14px;
    }
    .full__row.row__3 .css__block__4:last-child{
        border-bottom: none;
    }

    @media (max-width: 991px) {
        .full__row__11 .block__main .link-hover-homepage {
            height: 254px;
            margin-bottom: 25px;
        }

        .navbar > ul > li:hover {
            background: transparent !important;
        }

        .home__top .lead__single__content {
            position: relative;
            bottom: 0;
            z-index: 3;
            text-shadow: none;
            right: 0% !important;
            left: 0% !important;
            padding: 10px 0;
            margin: 0;
            background-image: none;
        }

        .home__top .lead__single__content span {
            color: var(--bs-red);
            font-size: 18px;
        }

        .home__top .lead__single__content h3 {
            color: var(--bs-black);
            font-weight: 600;
        }

        .link-hover-homepage:hover h3 {
            color: var(--bs-orange);
        }

        .last__row__2 .block__child .link-hover-homepage {
            height: 82px;
            overflow: hidden;
        }

        .block__row__4 .business__block__content {
            margin-top: 15px;
        }
    }

    /*============= Home Page End ==============*/

    /*============= Header Start ============*/
    .navbar .dropdown ul {
        left: 0px;
        top: calc(100% + 30px);
        /*box-shadow: 0 0 30px rgb(127 137 161 / 45%);*/
        box-shadow: none;
        background: #c5332d;
        transition: none;
        border-radius: 0;
        border: none;
        padding-bottom: 0;
    }

    .navbar .dropdown-menu li a {
        color: #fff !important;
    }

    .navbar .dropdown-menu li a:hover {
        background: #222222;
    }

    /*============= Header End ============*/

    /*============= Video Start ============*/
    .section_all_cat_vdo .caption {
        box-shadow: 0 2px 4px -1px rgba(0, 0, 0, .2), 0 4px 5px 0 rgba(0, 0, 0, .14), 0 1px 10px 0 rgba(0, 0, 0, .12) !important;
        padding: 7px 7px 0px;
        height: 80px;
        overflow: hidden;
    }

    .section_all_cat_vdo .item i {
        position: absolute;
        background: var(--bs-red);
        width: 41px;
        height: 41px;
        padding: 7px 9px;
        border-radius: 50%;
        font-size: 27px;
        left: 5px;
        top: 5px;
        box-shadow: 0 0 9px var(--bs-black);
        color: var(--bs-white);
    }

    .home__video {
        background: #323232;
    }

    /*============= Video End ============*/

    .link-hover-homepage:hover h3 {
        color: var(--bs-red);
    }

    .cat__pg__top__1 .section__page__lead img {
        width: 100%;
        height: 374px;
        object-fit: cover;
    }

    .publisher__name:before {
        content: '';
        width: 36px;
        height: 12px;
        display: inline-block;
        background: #c3c3c3;
        margin-right: 11px;
        top: 0px;
        position: relative;
    }

    .single__page__heading a {
        font-size: 21px;
        color: var(--bs-deepred);
        font-weight: 300;
        border-bottom: 1px solid var(--bs-deepred);
        line-height: 1;
    }

    .single__page__heading a:hover {
        color: var(--bs-deepred);
        border-bottom: 1px solid var(--bs-deepred);
    }

    .section_page .section_heading a:hover {
        color: var(--bs-blue);
    }

    .btn-success {
        color: var(--bs-litegreen);
    }

    .link-hover-homepage:hover a {
        color: var(--bs-blue) !important;
    }

    .bg__grey {
        background: var(--bs-gray-200);
    }

    footer a {
        font-weight: 300;
        line-height: 1;
        color: var(--bs-black) !important;
    }

    footer p {
        font-weight: 500;
        line-height: 1;
        color: var(--bs-black) !important;
        margin-bottom: 10px;
    }

    .footer__menu a {
        float: left;
    }

    footer a:hover {
        color: var(--bs-deepyellow);
    }

    footer hr {
        color: rgb(164 174 198 / 84%);
    }

    footer .brand__icon {
        color: var(--bs-white);
    }

    footer .brand__icon img {
        width: auto;
    }

    footer .social i {
        font-size: 29px;
        padding-top: 11px;
    }

    footer .footer__menu a:after {
        content: '';
        width: 1px;
        height: 11px;
        background: #b34848;
        display: inline-block;
        margin-top: 0px;
        margin-left: 6px;
        margin-right: 6px;
    }

    footer .editors__info h4 {
        color: var(--bs-black);
    }

    /*=========Home Page Photo Gallery ==========*/
    /*.photo__gallery__section .img__lead img {*/
    /*    width: 100%;*/
    /*    height: 349px;*/
    /*    object-fit: cover;*/
    /*    border-right: none;*/
    /*}*/
    .photo__gallery__section .img__lead img {
        width: 100%;
        height: auto;
        object-fit: cover;
        border-right: none;
    }

    .category-heading-special a {
        font-size: 27px;
        color: #ffffff;
        margin-bottom: 8px;
        font-weight: 700;
    }

    .photo__gallery__section .single__img .photo__title {
        bottom: 18px;
        z-index: 3;
        text-shadow: 0 1px 2px rgb(0 0 0 / 60%);
        right: 0;
        left: 0;
        padding: 50px 13px 10px;
        margin-right: 0;
        text-align: left;
        background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0) 0, var(--bs-black) 000 c9 90%);
        font-size: 24px;
    }

    .photo__gallery__section .single__img a {
        color: var(--bs-white);
    }

    .photo__gallery__section .single__img:hover a {
        color: var(--bs-deepred) !important;
    }

    .photo__gallery__section .single__img i {
        position: absolute;
        left: 6px;
        top: 6px;
        color: #fff;
        background: #f00000;
        font-size: 26px;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        padding: 8px 12px;
        z-index: 999;
    }

    .photo__gallery__section .photo__item__4 i {
        left: 6px;
        top: 6px;
        color: #fff;
        background: #f00000;
        font-size: 14px;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        padding: 8px 12px;
        z-index: 999;
    }

    .photo__gallery__section .img-3rd-block img {
        width: 553px;
        height: 300px;
        object-fit: cover;
        border-bottom: 2px solid #fff;
    }

    .photo__gallery__section .img-3rd-block.single__img .photo__title {
        bottom: 2px;
        margin-right: 0;
    }

    .photo__gallery__section .img-2nd-block img {
        width: 100%;
        height: 199px;
        object-fit: cover;
    }

    .photo__gallery__section .main__photo {
        background: #e5e5e5;
        height: 479px;
    }

    .main__photo .photo__title2 a {
        color: var(--bs-black) !important;
        font-size: 25px;
        padding: 15px 15px;
    }

    .photo__gallery__section .photo__item__4 .item {
        background: #e5e5e5;
        border-radius: 0;
        height: 232px;
    }

    .photo__gallery__section .photo__item__4 .item .photo__title2 a {
        line-height: 1.2;
        font-size: 18px !important;
        padding: 6px;
        margin-bottom: 0;
        color: var(--bs-black);
    }

    .photo__gallery__section .photo__item__4 .item:hover a {
        color: var(--bs-deepred) !important;
    }

    /*=========== Breaking News =============*/
    /*.breaking__news .news__ticker .heading .bi.bi-quote {*/
    /*    font-size: 41px;*/
    /*    position: relative;*/
    /*    color: #fff700;*/
    /*    top: -1px;*/
    /*    right: -9px;*/
    /*}*/

    /*.breaking__news .news__ticker .heading {*/
    /*    font-size: 23px;*/
    /*    color: var(--bs-white);*/
    /*    font-weight: 600;*/
    /*    margin-top: 6px;*/
    /*}*/

    /*.news__ticker {*/
    /*    background-color: var(--bs-deepred);*/
    /*    height: 35px;*/
    /*    line-height: 1;*/
    /*}*/

    /*.breaking__news .news__ticker .breaking-content {*/
    /*    margin-left: -82px;*/
    /*    margin-top: 3px;*/
    /*}*/

    /*.news__ticker .news-scroll ul li {*/
    /*    list-style: circle;*/
    /*    display: inline-block;*/
    /*    padding-left: 10px;*/
    /*    color: #fff;*/
    /*    font-size: 22px;*/
    /*    margin-bottom: 0;*/
    /*    font-family: 'SolaimanLipi', Arial, sans-serif !important;*/
    /*    line-height: 1;*/
    /*}*/
    /*.breaking__news .news__ticker .d-flex .news-scroll {*/
    /*    padding: 4px 0 7px;*/
    /*}*/
    .breaking__news a {
        color: var(--bs-black);
        font-size: 19px;
    }

    .breaking__news {
        background: #ffebeb;
        height: 34px;
        margin-top: 12px;
        margin-left: 14px;
    }

    .breaking__news .scroll__news .title {
        background-color: #dc3545;
        font-family: arial;
        font-size: 16px;
        position: absolute;
        top: 0px;
        margin-top: 0px;
        margin-left: 0px;
        padding-top: 6px;
        padding-left: 10px;
        z-index: 3;
        width: 184px;
        height: 34px;
        color: #fff;
    }

    .breaking__news .scroll__news .title:before {
        content: "";
        position: absolute;
        display: block;
        width: 0px;
        height: 34px;
        top: 0;
        left: -12px;
        border-left: 12px solid transparent;
        border-right: 0px solid transparent;
        border-bottom: 34px solid #dc3545;
    }

    .breaking__news .scroll__news .title:after {
        content: "";
        position: absolute;
        display: block;
        width: 0px;
        height: 34px;
        right: -12px;
        top: 0;
        border-right: 12px solid transparent;
        border-left: 0px solid transparent;
        border-top: 34px solid #dc3545;
    }

    /*-------------------------
    News Ticker
    ---------------------------*/
    .newsticker {
        padding: 5px 0 4px !important;
        border-bottom: 1px solid #464646;
        border-top: 1px solid #464646;
        margin: 15px 0;
        position: relative;
    }

    .newsticker .scroll-news {
        line-height: 1.3;
        display: flex;
        align-items: center;
        height: 31px;
    }

    .newsticker .scroll-news::before {
        content: "সবশেষ";
        float: left;
        color: var(--bs-white);
        font-size: 20px;
        position: absolute;
        z-index: 1;
        font-weight: 500;
        line-height: 1;
        top: 1px;
        padding: 9px 10px;
        background: var(--bs-deepred);
    }

    .newsticker .scroll-news ul li a {
        font-size: 19px;
        line-height: 1;
        padding-top: 2px;
    }

    /*=============== Ads Section Start ==============*/
    .ads__banner img {
        width: 75%;
    }

    .ads__section .matter__square, .ads__section .matter__banner {
        width: 80%;
        margin: 0 auto;
    }

    .ads__section.single_page {
        background: var(--bs-gray-200);
    }

    /*=============== Ads Section End ==============*/
    @media (max-width: 991px) {
        .mb__mbl {
            margin-bottom: 15px;
        }

        #topbar {
            height: auto;
        }

        .nav__scrollbar__mbl {
            display: block !important;
            overflow: auto;
            white-space: nowrap;
            padding: 0 5px 9px;
            margin: 10px 0;
        }

        .nav__scrollbar__mbl a {
            display: inline-block;
            color: var(--bs-black);
            text-align: center;
            padding: 9px 14px 6px;
            text-decoration: none;
            font-weight: 300;
            border-radius: 2px;
            background: #e9e9e9;
            margin: 0 7px;
            line-height: 1;
        }

        ::-webkit-scrollbar {
            height: 1px;
            width: 7px;
        }

        ::-webkit-scrollbar-thumb {
            background: #ffbc00;
            border-radius: 8px;
        }

        #searchOpenBtn {
            width: auto;
            height: auto;
            padding-top: 6px;
            border-radius: 0;
            padding-left: 0;
            margin-left: 0;
            border: none;
            background: transparent;
            font-size: 19px;
        }

        footer .copyright {
            text-align: center;
        }

        footer {
            padding-bottom: 15px;
        }

        h4 {
            font-size: 17px !important;
            font-weight: 400 !important;
            line-height: 1.5em;
            color: var(--bs-black);
        }

        .lead_5 h4 {
            width: 80%;
        }

        .ads__mbl img {
            width: 80%;
            margin: 0 auto;
        }

        .mbl__menu__option .search-bar {
            width: 78%;
            margin: 0 auto;
            position: absolute;
            left: 0%;
            right: 0;
            top: 0;
        }

        .mbl__menu__option .search-input {
            width: 100%;
            color: #2c3e50;
            border: 1px solid #dbdbdb;
            border-radius: 5px;
            box-shadow: 0px 0px 5px #c7c7c7;
        }

        .mbl__menu__option {
            border-bottom: none;
        }

        .searchIcon {
            border-radius: 0 5px 5px 0;
        }

        footer .editors__info, footer .social, footer .border {
            text-align: center;
            display: block;
            margin: 0 auto;
        }

        .searchIcon {
            right: 0px;
        }

        .breaking__news .news__ticker .breaking-content {
            margin-left: -15px !important;
            margin-top: 14px !important;
        }

        .news__ticker {
            background-color: #1a8f3c;
            height: 60px !important;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 9999;
        }

        .breaking__news .news__ticker .heading {
            font-size: 19px !important;
            margin-top: 11px;
        }

        .news__ticker .news-scroll ul li {
            font-size: 18px !important;
            font-family: 'SolaimanLipi', Arial, sans-serif !important;
            margin-top: 2px;
        }

        .#gt94s9pvprek1683785938157.widget-visible {
            display: none !important;
        }
    }

    .news__ticker .d-flex .news-scroll {
        padding: 7px 0 7px;
    }

    .news__ticker .d-flex .news-scroll ul {
        margin: 0;
        padding: 0;
    }

    .news__ticker .news-scroll ul li {
        text-decoration: none;
    }

    .news__ticker .news-scroll ul li p {
        color: #fff;
        font-size: 20px;
        margin-bottom: 0;
        font-family: 'SolaimanLipi', Arial, sans-serif !important;
    }

    .contact-info span {
        font-size: 17px;
        line-height: 1.31;
    }

    .header__ads__top .matter__banner img {
        max-width: 70%;
        margin: 0 auto;
        display: block;
    }

    .latestNews::-webkit-scrollbar, .popularNews::-webkit-scrollbar, .popularNews__hm::-webkit-scrollbar {
        width: 6px;
    }

    .latestNews::-webkit-scrollbar-track, .popularNews::-webkit-scrollbar-track, .popularNews__hm::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px #ddd;
        border-radius: 3px;
        margin: 0 10px 10px 0;
    }

    .latestNews::-webkit-scrollbar-thumb, .popularNews::-webkit-scrollbar-thumb, .popularNews__hm::-webkit-scrollbar-thumb {
        border-radius: 3px;
        -webkit-box-shadow: inset 0 0 12px #aeaeae;
    }

    /*===========================================================
       New Design Start
       ============================================================*/
    img {
        transition: transform .2s ease-out;
        overflow-clip-margin: content-box;
        overflow: clip;
    }

    body {
        font-family: 'SolaimanLipi', Arial, sans-serif !important;
        position: relative;
    }
    .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
        padding-left: 2px;
    }
    .h1, .h2, .h3, .h4, .h5, .h6, a, body, h1, h2, h3, h4, h5, h6 {
        font-family: 'SolaimanLipi', Arial, sans-serif !important;
        color: var(--bs-black);
    }

    .navbar > ul > li {
        white-space: nowrap;
        padding: 5px 6px;
        display: inline-flex;
    }

    .navbar > ul > li:after {
        content: "";
        background: #8b8b8b;
        display: block;
        width: 1px;
        height: 14px;
        position: relative;
        top: 8px;
        margin-left: 14px;
    }

    .navbar > ul > li:last-child:after {
        display: none;
    }

    .navbar .dropdown ul a {
        padding: 6px 20px 7px;
        font-weight: 300;
        line-height: 1;
        transition: none;
        margin-bottom: 5px;
        font-size: 19px;

    }

    .navbar a, .navbar a:focus {
        color: var(--bs-black);
    }

    .site__menu {
        background: var(--bs-white);
        padding: 10px 0;
        border-top: 1px solid #ccc;
        border-bottom: 2px solid #ccc;
    }

    .navbar > ul > .dropdown:hover a {
        color: var(--bs-white);
    }

    /*.navbar .live__btn a:before{*/
    /*    content: '';*/
    /*    width: 8px;*/
    /*    height: 8px;*/
    /*    display: inline-block;*/
    /*    background: var(--bs-deepred);*/
    /*    margin-right: 11px;*/
    /*    top: 0px;*/
    /*    position: relative;*/
    /*    border-radius: 50%;*/
    /*}*/

    #header .logo img {
        max-height: 92px;
        margin: 0;
        transition: .4s linear;
        width: auto;
    }

    .search-bar {
        width: 295px;
        top: 0px;
        z-index: 99;
        right: 12px;
        position: relative;
    }

    .search-input {
        outline: 0;
        background: #f9f9f9;
        width: 100%;
        height: 39px;
        margin: 0;
        padding: 0px 10px;
        font-family: sans-serif;
        font-size: 15px;
        color: #2c3e50;
        border: 1px solid var(--bs-black);
        border-radius: 47px;
    }

    .searchCloseBtn, .searchIcon {
        background: transparent;
        position: absolute;
        border: none;
        outline: 0;
        height: 41px;
        z-index: 10;
        padding: 0px 10px;
        font-family: sans-serif;
        font-size: 20px;
        margin: 0;
        color: #ff0000c7;
        right: 3px;
    }

    a:hover {
        color: #ef0000;
        text-decoration: none;
    }

    time {
        display: none;
    }

    .category-heading a {
        background: transparent;
        padding: 1px 0 0 2px;
        font-size: 23px;
        color: var(--bs-black) 000;
        display: inline-block;
        padding-right: 10px;
    }

    .full__row__3 .col_4_left_img_block .css__block__4 {
        border-bottom: 1px solid #fff;
        margin-bottom: 14px;
    }

    .full__row__3 .col_4_left_img_block .css__block__4:last-child {
        border-bottom: none;
        margin-bottom: 0px;
    }

    .full__row__3 .cat__lead {
        background: #fff;
    }

    .full__row__excludive .media-title {
        position: absolute;
        left: 2px;
        right: 0;
        bottom: 7px;
        background-image: linear-gradient(transparent, var(--bs-black));
        padding: 0 15px;
    }

    .category-heading {
        margin-bottom: 18px;
        overflow: hidden;
        position: relative;
    }

    .category-heading a:after {
        content: '\f285';
        display: inline-block;
        color: var(--bs-red);
        margin-right: 11px;
        top: 2px;
        position: relative;
        font-family: bootstrap-icons;
        font-size: 17px;
        font-weight: bold;
        left: 7px;
    }


    .cat__border::before {
        position: absolute;
        content: '';
        width: 100%;
        border-top: 4px solid rgb(211 211 211);
        top: 10px;
        display: inline-block;
        vertical-align: bottom;
    }

    .cat__border::after {
        position: absolute;
        content: '';
        width: 100%;
        border-top: 4px solid rgb(211 211 211);
        top: 18px;
        display: inline-block;
        vertical-align: bottom;
    }

    .district__block .btn-primary {
        color: #fff;
        background-color: #d90000;
        border-color: #d90000;
    }

    .district__block .btn-primary:hover {
        color: #fff;
        background-color: #b50000;
        border-color: #b50000;
    }

    .more__btn {
        display: block;
        background: #e9e9e9;
        line-height: 1;
        padding: 7px;
        border-radius: 1px;
    }

    .last__row__2.r3 .more__btn {
        display: block;
        background: #cf0000;
        line-height: 1;
        padding: 7px;
        border-radius: 1px;
    }

    .more__btn a {
        color: var(--bs-deepred);
    }

    .last__row__2.r3 .more__btn a {
        color: var(--bs-white);
    }

    .last__row__2.r3 .block__child .link-hover-homepage {
        box-shadow: none;
        padding-bottom: 0;
        height: 71px;
        overflow: hidden;
        margin-bottom: 8px !important;
        border-bottom: 1px solid #fff;
    }

    .last__row__2.r3 .block__child .link-hover-homepage:last-child {
        border-bottom: none !important;
    }

    .last__row__2.r3 .block__child {
        background: #f1f1f1;
        padding: 5px;
    }

    .home__video .category-heading a {
        color: #fff;
    }

    .vdopg .bi, .video-block-main .bi {
        position: absolute;
        background: var(--bs-red);
        width: 45px;
        height: 45px;
        padding: 5px 11px;
        border-radius: 50%;
        font-size: 27px;
        left: 5px;
        top: 5px;
        box-shadow: 0 0 9px var(--bs-black);
        color: var(--bs-white);
        z-index: 999;
    }

    .video-block-main .video-list-2 .item h4 {
        line-height: 1.2;
        font-size: 18px !important;
        padding: 6px;
        margin-bottom: 0;
        color: #fff;
    }

    .video-block-main .video-list-2 .item .bi {
        position: absolute;
        background: var(--bs-red);
        width: 32px;
        height: 32px;
        padding: 1px 6px;
        border-radius: 50%;
        font-size: 23px;
        left: 5px;
        top: 5px;
        box-shadow: 0 0 9px var(--bs-black);
        color: var(--bs-white);
        z-index: 999;
    }

    .video-top-content {
        background: var(--bs-black);
        height: 479px;
    }

    .video-top-content .video__cap h3 {
        font-size: 25px;
        color: #FFF;
        padding: 15px 15px;
    }


    .video-block-main .video-list-2 .video__thumb, .video-block-main .video-top-content .item, .photo__gallery__section .img__lead {
        overflow: hidden;
    }

    .video-block-main .video-list-2 .video__thumb:hover img, .video-block-main .video-top-content .item:hover img, .photo__gallery__section .img__lead:hover img {
        transform: scale(1.03);
    }

    .video-block-main .video-list-2 .item {
        background: var(--bs-black);
        border-radius: 0;
        height: 232px;
    }


    .category-heading-special {
        border-top: 5px solid #9b9b9b;
        padding-top: 9px;
    }

    .link-hover-homepage {
        position: relative;
        overflow: hidden;
    }

    .thumbnail {
        position: relative;
        overflow: hidden;
    }

    .link-hover-homepage:hover img {
        transform: scale(1.03);
    }

    .link-hover-homepage .thumbnail:hover img {
        transform: scale(1.03);
    }


    .namaj-time-body-left {
        float: left;
        width: 50%;
    }

    .namaj-time-body-right {
        float: left;
        width: 50%;
    }

    .namaj-time tr {
        line-height: 16px;
    }

    .menu__btn .bi {
        /*color: #ffffff;*/
        z-index: 999;
        position: relative;
        font-size: 24px;
        border: none;
        padding: 1px 3px;
        border-radius: 2px;
        line-height: 1;
    }

    /*Single Page Start*/
    .more_news .link-hover-homepage {
        box-shadow: 0 2px 1px -1px rgba(0, 0, 0, .2), 0 1px 1px 0 rgba(0, 0, 0, .14), 0 1px 3px 0 rgba(0, 0, 0, .12) !important;
    }

    .more_news .link-hover-homepage .rltd__content__title {
        height: 79px;
    }

    .contact__info svg:after {
        content: "";
        width: 3px;
        height: 10px;
        position: relative;
        margin: 0 10px;
        background: #ccc;
    }

    .contact__info svg {
        margin-right: 4px;
    }

    .not__more__info {
        opacity: 0.4;
        cursor: not-allowed !important;
    }

    footer .footer__url a {
        margin-right: 16px;
        font-size: 15px;
    }

    footer .footer__url a:hover {
        font-weight: bold;
    }

    footer .ofc__address {
        display: flex;
        line-height: 1.3;
    }

    @media (min-width: 992px) {
        .top__container {
            padding: 15px 0 15px;
        }
    }

    @media (max-width: 991px) {
        .navbar > ul > li:after {
            display: none;
        }

        .site__menu {
            background: transparent !important;
            padding: 0 !important;
            border: none !important;
        }

        .menu__btn {
            display: none;
        }

        .navbar > ul > li {
            white-space: nowrap;
            padding: 1px 6px;
            display: block;
        }

        .navbar .dropdown:hover > ul {
            border: none;
            margin-bottom: 19px;
            margin-left: 32px;
        }

        #header .logo img {
            max-height: 42px;
            margin: 0;
            transition: .4s linear;
            width: auto;
        }

        #header {
            padding: 7px 0;
        }

        .more_news h5 {
            font-size: 1.0rem;
        }

        footer .widget {
            text-align: center;
            margin-bottom: 10px;
        }

        footer .footer__url ul {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        footer .footer__url ul a {
            margin: 0 5px;
            font-weight: 300;
        }
    }

    /*//desktop-menu*/
    #bodyblur {
        background-color: rgba(0, 0, 0, .2);
        height: 100vh;
        left: 0;
        position: fixed;
        right: 0;
        top: 0;
        width: 100vw;
        z-index: 9999;
        display: none;
    }

    nav#desktop-menu {
        position: fixed;
        left: -255px;
        height: 100%;
        width: 250px;
        color: #fff;
        z-index: 9999;
        transition: .5s;
        background: #fff;
        box-shadow: 1px 1px 1px #525252;
        text-align: left;
        top: 0;
    }

    #desktop-menu-close {
        position: relative;
        z-index: 9;
        top: 0;
        left: 0;
        color: #fff;
        cursor: pointer;
        width: 250px;
        height: 40px;
    }

    #desktop-menu-open {
        cursor: pointer;
    }

    #desktop-menu-close .bi-x {
        font-size: 37px;
        position: absolute;
        right: 4px;
        top: 1px;
        color: red;
        background: transparent;
        border: 1px solid transparent;
        height: auto;
        line-height: 1;
    }

    /*#closeNav{
       width: 30px;
        height: 30px;
        position: absolute;
        top: 3px;
        right: 3px;
       background: black;
        border-radius: 50%;
    }
    #closeNav .one{
    cursor: pointer;
       position: absolute;
       top: 50%;
       right: 0%;

    }
    .close-icon{
         width: 30px;
       height: 30px;
       border-radius: 50%;
       background: black;
       top: 2px;
       position: absolute;
       right: 2px;
       }*/
    /*nav#myNav .main-menu{
       margin:0;
       padding:10px;
    }*/
    /*nav#myNav .main-menu .menu-item{
       list-style:none;
    }
    nav#myNav .main-menu .menu-item a{
       display:block;
       padding: 10px 10px 10px 4px;
       background:#fff;
       color:var(--bs-black);
       text-decoration:none;
       text-align:left;
       font-size:20px;
    }
    nav#myNav .main-menu .menu-item a .icon{
       color: var(--bs-black);
       float: right;
       cursor: pointer;
    }
    nav#myNav .main-menu .menu-item a:hover{
       background: #e2e2e26e;
       color: #1a237e;
    }
    nav#myNav .main-menu .menu-item ul.sub-menu{
       display: none;
    }

    nav#myNav .main-menu .menu-item:hover ul.sub-menu{
        display: block;
        transition: 0.3s;
    }

    nav#myNav .main-menu .menu-item ul.sub-menu{
       padding: 0px;
    }
    nav#myNav .main-menu .menu-item ul.sub-menu li.sub-item a{
       font-size: 17px;
       padding-left: 9px;
    }*/

    .desktop-menu .main-menu {
        height: 100vh;
        overflow-y: scroll;
    }

    .desktop-menu .main-menu::-webkit-scrollbar {
        width: 6px
    }

    .desktop-menu .main-menu::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px #ddd;
        border-radius: 0
    }

    .desktop-menu .main-menu::-webkit-scrollbar-thumb {
        border-radius: 0;
        -webkit-box-shadow: inset 0 0 12px #cf0000
    }

    /*new*/
    .desktop-menu > ul {
        margin: 0;
        padding-left: 0;
    }

    .desktop-menu > ul > li {
        margin: 0;
        padding: 0;
        text-transform: uppercase;
        font-size: 13px;
        line-height: 1;
        position: relative;
    }

    .desktop-menu > ul > li > a {
        display: block;
        padding: 16px 0 15px 24px;
        border-bottom: 1px solid #e1e1e1;
        color: var(--bs-black);
        font-weight: 500;
        margin-bottom: 0;
        text-decoration: none;
        font-size: 18px;
    }

    .desktop-menu > ul > li > a:hover {
        color: #db0000;
    }

    /*.desktop-menu .main-menu .menu-item:before {*/
    /*    content: '';*/
    /*    width: 8px;*/
    /*    height: 8px;*/
    /*    display: inline-block;*/
    /*    background: #f63f29;*/
    /*    margin-right: 11px;*/
    /*    top: 20px;*/
    /*    position: relative;*/
    /*    left: 12px;*/
    /*}*/

    .desktop-menu > ul > li > i {
        position: absolute;
        right: 0;
        top: 6px;
        font-size: 18px;
        padding: 8px 15px;
        z-index: 2;
        color: var(--bs-black);
        cursor: cell;
    }

    .desktop-menu > ul > li > ul {
        list-style: none;
        padding-left: 32px;
        display: none;
        border-bottom: 1px solid #e1e1e1;
        margin-bottom: 1px;
        animation-timing-function: linear;
    }

    .desktop-menu > ul > li > ul:hover {
        opacity: 1;
        transform: translateY(0);
    }

    .desktop-menu > ul > li > ul > li {
        border-bottom: 1px solid #f3f3f3;
        margin-bottom: 1px;
        display: contents;
    }

    .desktop-menu > ul > li > ul > li:last-child {
        border-bottom: none;
        margin-bottom: none;
    }

    .desktop-menu > ul > li > ul > li > a {
        display: block;
        padding: 10px 0;
        font-size: 17px;
        color: var(--bs-black);
        text-transform: none;
        text-decoration: none;
    }

    /*===============
    Home Page Top New
    ==============================*/
    .keyword__block {
        background: #f7a62a1a;
        margin-bottom: 32px;
        border-bottom: 2px solid #f7a62a61;
    }

    .keyword__banner img {
        height: 64px;
        object-fit: cover;
    }

    .keyword__block .border__right {
        border-right: 1px solid #ffd99c !important;
    }

    .keyword__block .child__block h4 {
        font-size: 17px !important;
    }

    .keyword__block .block__lead h4 {
        font-size: 21px !important;
    }

    .keyword__block .child__block .link-hover-homepage:nth-child(3), .keyword__block .child__block .link-hover-homepage:nth-child(4) {
        margin-bottom: 0 !important;
    }

    .sec__lead h4, .sec__lead h3 {
        font-weight: 600;
        padding-left: 3px;
    }

    .sec__lead .left__block .media img, .sec__lead .middle__block2 img, .sec__lead .right__block .media img, .keyword__block .child__block img {
        width: 195px;
        height: 70px;
        object-fit: cover;
    }

    .sec__lead .border__right {
        border-right: 2px solid var(--bs-gray-500);
    }

    .sec__lead .border__left {
        border-left: 2px solid var(--bs-gray-500);
    }

    .middle__block2.border__btm {
        border-bottom: 1px solid var(--bs-black);
    }

    .sec__lead .left__block .category__heading {
        background: #dd762b;
        margin-bottom: 10px;
        padding: 6px 10px 3px;
        border-radius: 22px;
        text-align: center;
    }

    .sec__lead .left__block .category__heading a {
        color: var(--bs-white);
        font-size: 1.6em;
    }
    .sec__lead .right__block .category__heading {
        background: #9b090c;
        margin-bottom: 10px;
        padding: 6px 10px 3px;
        border-radius: 22px;
        text-align: center;
    }

    .sec__lead .right__block .category__heading a {
        color: var(--bs-white);
        font-size: 1.6em;
    }

    .right__block .link-hover-homepage:last-child, .left__block .link-hover-homepage:last-child {
        padding-bottom: 0 !important;
        margin-bottom: 0 !important;
        border-bottom: none !important;
    }

    .middle__block3 .border__right:last-child {
        border-right: none !important;
    }

    @media only screen and (max-width: 700px) {
        #desktop-menu {
            width: 90%;
        }
    }

    @media only screen and (min-width: 700px) {
        #desktop-menu {
            width: 290px;
        }
    }

    @media only screen and (max-width: 991px) {
        #desktop-menu-open i {
            display: none;
        }
    }


</style>

<div class="top__ads d-none">

</div>

<!-- ======= Top Bar ======= -->
<section id="topbar" class="align-items-center d-flex">
    <div class="container d-flex justify-content-center justify-content-md-between d-none" style="position: relative;">
        <div class="contact-info ps-3">
            <i class="bi bi-envelope d-flex align-items-center d-none"><a
                        href="mailto:{{ $settings->site_email }}">{{ $settings->site_email }}</a></i>
            <span class="d-flex align-items-center date__time">{{ todays_eng_date() }} <br> {{ todays_ban_date() }}</span>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
            <a href="{{ $settings->facebook }}" class="facebook social__icon" target="_blank"
               style="background: #226ed3;"><i
                        class="bx bxl-facebook"></i></a>
            <a href="{{ $settings->twitter }}" class="twitter social__icon" target="_blank" style="background: #1d9bf0"><i
                        class="bx bxl-twitter"></i></a>
            <a href="{{ $settings->youtube }}" class="youtube social__icon" target="_blank" style="background: #ff0000"><i
                        class="bi bi-youtube"></i></a>
            <a href="#" class="instagram social__icon" target="_blank" style="background: #c038be"><i
                        class="bx bxl-instagram"></i></a>
            <a href="#" class="linkedin social__icon d-none" style="background: #0077b5; padding: 0;"><i
                        class="bx bxl-linkedin social__icon" target="_blank"></i></a>
            <a href="/video-gallery/gallery/video" class="btn__video d-none">ভিডিও</a>

        </div>
        <div class="social-links d-flex d-md-none d-lg-none align-items-center justify-content-between">
            <a href="{{ $settings->facebook }}" class="facebook" target="_blank"><i class="bi bi-facebook"></i></a>
            <a href="{{ $settings->youtube }}" class="youtube"><i class="bi bi-youtube"></i></a>
            <a href="{{ $settings->twitter }}" class="twitter" target="_blank"><i class="bi bi-twitter"></i></a>
        </div>
    </div>
</section>
{{--<div class="header__ads__top d-none d-md-block d-lg-block py-3">--}}
<div class="header__ads__top d-none">
    <div class="container">
        <div class="matter__banner">
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
    </div>
</div>
<!-- ======= Header ======= -->
<header id="header" class="header">
    <?php  $breakingnews = App\Models\Breakingnews::orderBy('id', 'desc')->get(); ?>
    @if($breakingnews->isNotEmpty())
        <div class="container">
            <div class="breaking__news pt-0 position-relative">
                <div class="scroll__news d-flex">
                    <div class="title">
                        // BREAKING NEWS //
                    </div>
                    <marquee scrollamount="6" scrolldelay="5" direction="left" onmouseover="this.stop()"
                             onmouseout="this.start()">
                        <ul class="list-inline">
                            @foreach($breakingnews as $post)
                                <li class="">
                                    <a style="color:var(--bs-black);"
                                       href="{{$post->news_link}}">{{ $post->news_text }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </marquee>
                </div>
            </div>
        </div>
    @endif

    <div class="breaking__news d-none">
        <style>
            /*.news__ticker .heading span {*/
            /*    position: relative;*/
            /*    top: -9px;*/
            /*    left: 7px;*/
            /*}*/
        </style>
        <?php $ticket = App\Models\Breakingnews::orderBy('id', 'desc')->get(); ?>
        @if(!empty(count($ticket)))
            <div class="news__ticker">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-2 col-lg-2 col-4 col-sm-4">
                            {{--                            <div class="heading"><i class="bi bi-quote"></i><span>ব্রেকিং:</span></div>--}}
                            <div class="heading"><span>ব্রেকিং:</span></div>
                        </div>
                        <div class="col-md-5 col-lg-5 col-8 col-sm-8">
                            <div class="d-flex  justify-content-between align-items-center breaking-content">
                                <marquee class="news-scroll" behavior="scroll" direction="left"
                                         onmouseover="this.stop();"
                                         onmouseout="this.start();">
                                    <ul>
                                        <li class="item">
                                            @foreach($ticket as $post)
                                                <a style="color: #fff"
                                                   href="{{$post->news_link}}">{!! $post->news_text !!}</a>
                                            @endforeach
                                        </li>
                                    </ul>
                                </marquee>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    {{--    <div class="container d-flex align-items-center justify-content-between">--}}
    <div class="site__top d-lg-block d-md-block d-sm-flex col-flex align-items-center justify-content-between">
        <div class="container top__container">
            <div class="row d-flex align-items-center">
                <div class="col-md-3">
                    <div class="contact-info ps-3 d-none d-md-flex">
                        @if($settings->desktop_menu_bar == 1)
                            <span class="menu__btn py-0 me-3" id="desktop-menu-open"><svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-align-right" width="38" height="38"
                                        viewBox="0 0 24 24" stroke-width="1" stroke="#000000" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <path d="M4 6l16 0"/>
  <path d="M10 12l10 0"/>
  <path d="M6 18l14 0"/>
</svg></span>@endif
                        <span class="d-flex align-items-center date__time">{{todays_eng_date()}} <br> {{todays_ban_date()}}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-center">
                        <a href="/dev-page" class="logo"><img src="/{{ $settings-> logo }}"
                                                              alt="{{ $settings->site }}"></a>
                        <a href="/dev-page" class="logo_w"><img src="/{{ $settings-> logo }}"
                                                                alt="{{ $settings->site }}"
                                                                class="img-fluid"></a>
                    </div>
                </div>
                <div class="col-md-3 d-none d-md-block">
                    <div class="social-links my-4 float-end position-relative" style="float: right">
                        {{--                        <a href="{{ $settings->facebook }}" class="facebook social__icon" target="_blank"--}}
                        {{--                           style="background: #226ed3;"><i--}}
                        {{--                                    class="bx bxl-facebook"></i></a>--}}
                        {{--                        <a href="{{ $settings->twitter }}" class="twitter social__icon" target="_blank"--}}
                        {{--                           style="background: #1d9bf0"><i--}}
                        {{--                                    class="bx bxl-twitter"></i></a>--}}
                        {{--                        <a href="{{ $settings->youtube }}" class="youtube social__icon" target="_blank"--}}
                        {{--                           style="background: #ff0000"><i--}}
                        {{--                                    class="bi bi-youtube"></i></a>--}}
                        {{--                        <a href="#" class="instagram social__icon" target="_blank" style="background: #c038be"><i--}}
                        {{--                                    class="bx bxl-instagram"></i></a>--}}
                        {{--                        <a href="#" class="linkedin social__icon d-none" style="background: #0077b5; padding: 0;"><i--}}
                        {{--                                    class="bx bxl-linkedin social__icon" target="_blank"></i></a>--}}
                        {{--                        <a href="/video-gallery/gallery/video" class="btn__video d-none">ভিডিও</a>--}}

                        <div class="search-bar" id="mainSrcBox" style="display: block;">
                            <form method="get" action="{{ route('search') }}">
                                <input type="text" class="search-input" required="" name="x"
                                       placeholder="অনুসন্ধান...">
                                <button class="searchIcon" id="searchIcon" type="submit" name="button"><i
                                            class="bi bi-search"></i>
                                </button>
                                <button class="searchCloseBtn d-none" id="searchCloseBtn" type="button" name="button"><i
                                            class="bi bi-x" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="bodyblur"></div>
        <center class="site__menu">

            <div class="container">
                <nav id="navbar" class="navbar">
                    <ul class="url__li">
                        <li class="mbl__menu__option d-block d-md-none d-lg-none my-5 px-3"
                            style="border-bottom: 1px solid transparent;">
                            <div class="search-bar" id="mainSrcBox">
                                <form method="get" action="{{ route('search') }}">
                                    <input type="text" class="search-input" required="" name="x"
                                           placeholder="অনুসন্ধান...">
                                    <button class="searchIcon" id="searchIcon" type="submit" name="button"><i
                                                class="bi bi-search"></i>
                                    </button>
                                </form>
                            </div>
                        </li>
                        @foreach(\App\Models\Menu::orderBy('position', 'asc')->get() as $key=> $menu)
                            <li class="{{ $menu->subMenu->count() > 0 ? 'dropdown ' : '' }} {{ $key == 0 ? 'active' :'' }}">
                                <a href="{{ $menu->url_path }}" @if($menu->subMenu->count() > 0) class="dropdown-toggle"
                                   data-toggle="dropdown" role="button"
                                   aria-haspopup="true" aria-expanded="false" @endif>
                                    {!! $menu->url_text !!}
                                    {!! $menu->subMenu->count() > 0 ? '<span class="caret"></span>' : '' !!}
                                </a>
                                @if($menu->subMenu->count() > 0)
                                    <ul class="dropdown-menu">
                                        @foreach(\App\Models\SubMenu::where('menu_id',$menu->id)->orderby('position','asc')->get() as $submenu)
                                            <li><a href="{{ $submenu->url_path }}">{{ $submenu->url_text }}</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                        <?php $livestream = livestream();?>
                        @if($livestream->status == 1)
                            <li class="live__btn"><a class="text-danger" href="{{route('livestream.show')}}">Live</a>
                            </li>
                        @endif
                    </ul>
                    <a href="{{ route('video.gallery') }}" class="video__mbl d-block d-md-none d-lg-none mx-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-video" width="28"
                             height="28" viewBox="0 0 24 24" stroke-width="1" stroke="var(--bs-black)000" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M15 10l4.553 -2.276a1 1 0 0 1 1.447 .894v6.764a1 1 0 0 1 -1.447 .894l-4.553 -2.276v-4z"/>
                            <rect x="3" y="6" width="12" height="12" rx="2"/>
                        </svg>
                    </a>
                    <a id="mobilemenuopen" class="d-none d-md-none d-lg-none"><i class="bi bi-search"></i>
                    </a>
                    <div class="mobilemenu  d-md-none d-lg-none" id="mobilemenu" style="display: none;">
                        <form method="get" action="{{ route('search') }}">
                            <input type="text" class="search-input" required="" name="x"
                                   placeholder="কি খুঁজতে চান?">
                            <button class="searchIcon" id="searchIcon" type="submit" name="button"><i
                                        class="fa fa-search"></i>
                            </button>
                            <button class="mobilemenuclose" id="mobilemenuclose" type="button" name="button"><i
                                        class="fa fa-times" aria-hidden="true"></i></button>
                        </form>
                    </div>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav>

                <!--desktop-menu open-->
                <nav class="desktop-menu" id="desktop-menu">
                    <div id="desktop-menu-close">
                        <i class="bi bi-x"></i>
                    </div>
                    <ul class="main-menu">
                        @foreach(\App\Models\Menu::orderBy('position', 'asc')->get() as $key=> $menu)
                            <li class="menu-item"><a
                                        href="{{$menu->url_path}}">{{$menu->url_text}}</a> @if($menu->subMenu->count() > 0)
                                    <i class="bi bi-chevron-down MDDMOI icon"></i> @endif
                                @if($menu->subMenu->count() > 0)
                                    <ul class="sub-menu MDDM">
                                        @foreach(\App\Models\SubMenu::where('menu_id',$menu->id)->orderby('position','asc')->get() as $submenu)
                                            <li class="sub-item"><a
                                                        href="{{$submenu->url_path}}">{{$submenu->url_text}}</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </nav>
                <!--desktop-menu end-->
            </div>

        </center>
    </div>

    <div id="search" class="d-none">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('search') }}" class="form-group" role="search" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" name="x" placeholder="কি খুঁজতে চান?">
                            <span class="input-group-btn">
                                <button class="btn btn-search" type="submit"><i class="fa fa-search"
                                                                                aria-hidden="true"></i></button>
                            </span>
                            <div class="input-group-btn search-panel">
                                <button type="button" class="btn btn-close search_close"><i class="fa fa-times"
                                                                                            aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="nav__scrollbar__mbl d-none">
    <a href="/">প্রচ্ছদ</a>
    <a href="{{ route('Archive') }}">সর্বশেষ</a>
    <?php $menus = menu_query(8, 1); ?>
    @foreach($menus as $menu)
        <a href="{{ $menu->url_path }}">{{ $menu->url_text}}</a>
    @endforeach
    <?php unset($menus); ?>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var nav = document.getElementById("desktop-menu");
    var open = document.getElementById("desktop-menu-open")
    var close = document.getElementById("desktop-menu-close")
    var bodyblur = document.getElementById("bodyblur")
    open.addEventListener("click", function () {
        nav.style.left = "0px";
        bodyblur.style.display = "block";
        // openNav.style.display = "none";
    })
    close.addEventListener("click", function () {
        nav.style.left = "-290px";
        bodyblur.style.display = "none";
        // openNav.style.display = "block";
    })
    $('.MDDMOI').click(function () {
        $(this).next().toggle();
        console.log($(this).attr('class'))
        if ($(this).attr('class') == 'bi bi-chevron-down MDDMOI icon') {
            $(this).removeClass('bi bi-chevron-down MDDMOI icon');
            $(this).addClass('bi bi-chevron-up MDDMOI icon');
        } else if ($(this).attr('class') == 'bi bi-chevron-up MDDMOI icon') {
            $(this).removeClass('bi bi-chevron-up MDDMOI icon');
            $(this).addClass('bi bi-chevron-down MDDMOI icon');
        }
        if ($('.MDDM:visible').length > 1) { // reset all if there is more than one opened
            $('.MDDM:visible').hide(); // hide all
            $(this).next().show(); // now show only the list you want
        }
    })

    $(document).mouseup(function (e) {
        let desktopMenu = $("#desktop-menu");
        let bodyblur = $("#bodyblur");
        if (!desktopMenu.is(e.target) && desktopMenu.has(e.target).length === 0) {
            desktopMenu.css("left", "-290px");
            bodyblur.hide();
        }
    });

</script>
