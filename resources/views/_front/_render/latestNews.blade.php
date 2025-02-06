@if(!empty($posts))
<?php  $settings = \App\Models\Setting::find('1'); ?>
@foreach($posts as $post)
    <div class="row row-cols-1 no-gutters mb-4 item">
        <div class="col-4">
            <a href="{{ news_url($post) }}">
                <img src="{{$settings->lazy_image ? asset($settings->lazy_image) : asset('/defaults/lazy-default.jpg')}}" data-src="{{ !empty($post->featured_mini) ? $post->featured_mini : $post->featured_image }}" alt="{{ $post->headline }}" class="img-responsive lazy"/>
            </a>
        </div>
        <div class="col-8 align-self-center px-2">
            <a href="{{ news_url($post) }}">
                <h6>{{ $post->headline}}</h6>
            </a>
        </div>
    </div>
@endforeach
@endif