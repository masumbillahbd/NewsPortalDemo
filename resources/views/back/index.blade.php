@extends('layouts.backend')
@section('title')
    Admin | Dashboard
@endsection
<style>
    .sitemap a {
        color: #fff !important;
    }

    .short__url a:after {
        content: '';
        width: 7px;
        height: 7px;
        display: inline-block;
        background: var(--light);
        margin: 0 12px 0 16px;
        top: 0px;
        position: relative;
        border-radius: 50%;
    }

    .short__url a:last-child::after {
        display: none;
    }

    .category a, .video a, .user a{
        color: var(--light) !important;
    }
</style>
@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="bg-grad-2 text-white rounded-lg mb-4 overflow-hidden"
                         style="margin-bottom: 0 !important;">
                        <div class="px-3 pt-3">
                            <div class="opacity-50">
                                <span class="fs-12 d-block">TOTAL</span> <a class="text-white" href="{{ route('post.index') }}">
                                Posts</a> 
                            </div>
                            <div class="h3 fw-700 mb-3"></div>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                            <path fill="rgba(255,255,255,0.3)" fill-opacity="1"
                                  d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
                        </svg>
                    </div>
                    <div class="sitemap px-3 py-1 short__url">
                        <a href="{{ route('post.index') }}">View All</a>
                        <a href="/sitemap.xml" target="_blank" class="pe-2">Sitemap</a>
                        <a href="/rss.xml" target="_blank">Rss</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="bg-grad-3 text-white rounded-lg mb-4 overflow-hidden"
                         style="margin-bottom: 0 !important;">
                        <div class="px-3 pt-3">
                            <div class="opacity-50">
                                <span class="fs-12 d-block">TOTAL</span> {{ \App\Models\Category::all()->count() }}
                                Categories
                            </div>
                            <div class="h3 fw-700 mb-3"></div>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                            <path fill="rgba(255,255,255,0.3)" fill-opacity="1"
                                  d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
                        </svg>
                    </div>
                    <div class="category px-3 short__url py-1">
                        <a href="{{ route('category.index') }}">Category</a>
                        <a href="{{ route('sub_category.index') }}">Sub Category</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="bg-grad-3 text-white rounded-lg mb-4 overflow-hidden"
                         style="margin-bottom: 0 !important;">
                        <div class="px-3 pt-3">
                            <div class="opacity-50">
                                <span class="fs-12 d-block">TOTAL</span>{{ \App\Models\VideoGallery::all()->count() }}
                                Videos
                            </div>
                            <div class="h3 fw-700 mb-3"></div>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                            <path fill="rgba(255,255,255,0.3)" fill-opacity="1"
                                  d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
                        </svg>
                    </div>
                    <div class="video px-3 short__url py-1">
                        <a href="{{ route('video.index') }}">View All</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="bg-grad-3 text-white rounded-lg mb-4 overflow-hidden"
                         style="margin-bottom: 0 !important;">
                            <div class="px-3 pt-3">
                                <div class="opacity-50">
                                    <span class="fs-12 d-block">TOTAL</span> {{ \App\Models\User::all()->count() }}
                                    User
                                </div>
                                <div class="h3 fw-700 mb-3"></div>
                            </div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                            <path fill="rgba(255,255,255,0.3)" fill-opacity="1"
                                  d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
                        </svg>
                    </div>
                    <div class="user px-3 short__url py-1">
                        <a href="{{ route('admin.index') }}">Users</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
