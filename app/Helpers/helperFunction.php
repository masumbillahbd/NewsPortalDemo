<?php
use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Ad;
use App\Models\Menu;
use App\Models\Post;
use App\Models\User;
use App\Models\Page;
use App\Models\Photo;
use App\Models\Ramadan;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Photobody;
use App\Models\Viewcount;
use App\Models\Livestream;
use App\Models\SubCategory;
use App\Models\VideoGallery;

function setting(){
    return Setting::orderBy('id','desc')->first();
}
function checkNewsPopupStatus($post_id=0,$session_id=''){
    return DB::table('popup_disable')->where('post_id', $post_id)->where('session_id', '=', $session_id)->first();
}

function today_ramadan($division=''){
    date_default_timezone_set('Asia/Dhaka');
    $date = date('Y-m-d');
    return Ramadan::where([['date',$date],['division',$division]])->first();
}
function today_one_ramadan(){
    date_default_timezone_set('Asia/Dhaka');
    $date = date('Y-m-d');
    return Ramadan::where('date',$date)->first();
}
function ramadan(){
    return Ramadan::orderby('position','asc')->get();
}
function livestream(){
    return Livestream::orderBy('id','desc')->first();
}
function popular_post_by_date($take=10){
    $current_date = date("Y-m-d H:i:s");
    $date = date_create(date("Y-m-d H:i:s")); 
    date_sub($date,date_interval_create_from_date_string("30 days"));
    return Post::where('post_status', '1')->orderBy('view_count','desc')->take($take)->get();
}
function popular_post_by_category($category_id, $take=10){
    $current_date = date("Y-m-d H:i:s");
    $date = date_create(date("Y-m-d H:i:s")); 
    date_sub($date,date_interval_create_from_date_string("30 days"));
    return  Category::find($category_id)->Posts()->where('post_status', '1')->orderBy('view_count','desc')->take($take)->get();
}
function popular_tags($take=8){
    $date = Carbon::today()->subDays(3);
    return DB::select("select DISTINCT  tag_id from post_tag where  created_at >= '".$date."' LIMIT $take ");
}
if(!function_exists('view_counter')){
    function view_counter(){
        $today = Carbon::today()->toDateString();
        $Viewcount = Viewcount::where('date', $today)->first();
        if($Viewcount != null){
            $Viewcount->view = $Viewcount->view + 1;
            $Viewcount->save();
        }else{
            $Viewcount = new Viewcount();
            $Viewcount->date = $today;
            $Viewcount->view = $Viewcount->view + 1;
            $Viewcount->save();
        }
    }
}

function post_updated_by($id = 0){
    $user = User::where('id',$id)->first();
    if ($user != null) {
        return $user->name;
    }
    return null;
}
function post_updated_time($time = 0){
    if ($time != null) {
        return Carbon::createFromFormat('Y-m-d H:i:s', $time)->format('H:i/d M Y');
    }
    return null;
}

function menu_query($take=5, $skip=0, $order='asc'){
    if($take == 1){
        return Menu::OrderBy('position', $order)->skip($skip)->first();
    }else{
        return Menu::OrderBy('position', $order)->skip($skip)->take($take)->get();
    }
    return null;
}
function page_query($take=1,$skip=0,$order='desc'){
    if($take == 1){
        return Page::OrderBy('id', $order)->skip($skip)->first();
    } else {
        return Page::OrderBy('id', $order)->skip($skip)->take($take)->get();
    }
    return null;
}
function page_url($slug){
    $page = Page::where('slug',$slug)->first();
    if(!empty($page)){
        return route('single.page', ['slug' => $page->slug ]);
    }
    return null;   
}

function photo_query($take=1, $skip=0, $order='desc'){   
    if($take == 1){
        return Photo::orderBy('id', $order)->skip($skip)->first();
    }else{
        return Photo::orderBy('id', $order)->skip($skip)->take($take)->get();
    }
    return null;
}
function multiple_photo($photo_id){
    return Photobody::where('photo_id',$photo_id)->get();
}

function post_scroll_query($take=10, $skip=0, $order='desc'){
    return Post::where([['post_status', '1'],['scroll', '1']])->orderBy('id', $order)->select('id','headline','post_status','created_at')->skip($skip)->take($take)->get();
}
function post_query($take=10, $skip=0,$order='desc'){
    return Post::where('post_status', '1')->orderBy('id', $order)->select('id','headline','sub_headline','excerpt','featured_image','post_status','created_at')->skip($skip)->take($take)->get();
}

function ad_by_position($position = 1){
    return Ad::where('position', $position)->first();
}
function ad_query($take=1, $skip=0, $order='asc'){
    if($take == 1){
        return Ad::orderBy('position', $order)->skip($skip)->first();
    } else {
        return Ad::orderBy('position', $order)->skip($skip)->take($take)->get();
    }
    return null;
}

function posts_by_category($category_id, $take=10, $skip=0){
    $cat = Category::find($category_id);
    if(!empty($cat)){
        if($take == 1){
            return Category::find($cat->id)->posts()->select('posts.id','posts.headline','posts.sub_headline','posts.excerpt','posts.featured_image','posts.post_status','posts.created_at')->where('post_status', '1')->orderBy('created_at', 'desc')->skip($skip)->first();
        }else{
            return Category::find($cat->id)->posts()->select('posts.id','posts.headline','posts.sub_headline','posts.excerpt','posts.featured_image','posts.post_status','posts.created_at')->where('post_status', '1')->orderBy('created_at', 'desc')->skip($skip)->take($take)->get();
        }
    }
    return null;
}
 
function posts_by_reporter($reporter_id, $take=10, $skip=0){
    return Post::where([['post_status', '1'],['reporter_id', $reporter_id]])->orderBy('created_at', 'desc')->select('id','headline','sub_headline','excerpt','featured_image','post_status','created_at')->skip($skip)->take($take)->paginate(20);
}

function posts_by_sub_category($sub_category_id, $take=10, $skip=0){
    $sub_cat = SubCategory::find($sub_category_id);
    if(!empty($sub_cat)){
        $subCatId = $sub_cat->id;
        if($take == 1) {
            return SubCategory::find($subCatId)->posts()->select('posts.id','posts.headline','posts.sub_headline','posts.excerpt','posts.featured_image','posts.post_status','posts.created_at')->where('post_status', '1')->orderBy('created_at', 'desc')->skip($skip)->take($take)->get();
        }else{
            return SubCategory::find($subCatId)->posts()->select('posts.id','posts.headline','posts.sub_headline','posts.excerpt','posts.featured_image','posts.post_status','posts.created_at')->where('post_status', '1')->orderBy('created_at', 'desc')->skip($skip)->take($take)->get();
        }
        if (!empty($posts_by_subcategory)) {
            return $posts_by_subcategory;
        }
        return $posts_by_subcategory = null;
    }
    return $posts_by_subcategory = null;
} 

function posts_by_tag($tag_id, $take = 8, $skip = 0){
    if ($take == 1) {
        $posts = Tag::find($tag_id)->Posts()->select('posts.id','posts.headline','posts.sub_headline','posts.excerpt','posts.featured_image','posts.post_status','posts.created_at')->where('post_status', '1')->orderBy('created_at', 'desc')->skip($skip)->take($take)->get();
    } else {
        $posts = Tag::find($tag_id)->Posts()->select('posts.id','posts.headline','posts.sub_headline','posts.excerpt','posts.featured_image','posts.post_status','posts.created_at')->where('post_status', '1')->orderBy('created_at', 'desc')->skip($skip)->take($take)->get();
    }
    if (!empty($posts)) {
        return $posts;
    }
    return $posts = null;
}

function category_slug($id){
    return Category::find($id)->slug;
}

function category_name($id){
    return Category::findOrFail($id)->name;
}

function tag_name($id){
    return Tag::findOrFail($id)->name;
}

function category_url($id){
    return route('category.posts', ['category_slug' => Category::find($id)->slug ]);
}

function sub_category_url($sub_cat){
    $sub_cat = SubCategory::where('slug',$sub_cat)->first();
    $cat = Category::where('id', $sub_cat->category_id)->first();
    if ($sub_cat){
        return route('sub_cat.post', ['cat' => $cat->slug,'sub_cat' => $sub_cat->slug]);
    }
    return null;
}

function tag_url($name){
    return route('tag.posts',['name' =>$name]);
}

function sticky_posts_by_position($take=null, $skip=null){
    if($take == null){
        $sticky_post = Post::join('lead_posts', 'posts.id', '=', 'lead_posts.post_id')->select('posts.id','posts.headline','posts.sub_headline','posts.excerpt','posts.featured_image','posts.post_status')->orderBy('lead_posts.position', 'ASC')->where('post_status', 1)->get();
    }else{
        if($skip == null){
            $sticky_post = Post::join('lead_posts', 'posts.id', '=', 'lead_posts.post_id')->select('posts.id','posts.headline','posts.sub_headline','posts.excerpt','posts.featured_image','posts.post_status')->orderBy('lead_posts.position', 'ASC')->where('post_status', 1)->take($take)->skip(0)->get();
        }else{
            $sticky_post = Post::join('lead_posts', 'posts.id', '=', 'lead_posts.post_id')->select('posts.id','posts.headline','posts.sub_headline','posts.excerpt','posts.featured_image','posts.post_status')->orderBy('lead_posts.position', 'ASC')->where('post_status', 1)->take($take)->skip($skip)->get();
        }
    }
    if($take == 1){
        $sticky_post = Post::join('lead_posts', 'posts.id', '=', 'lead_posts.post_id')->select('posts.id','posts.headline','posts.sub_headline','posts.excerpt','posts.featured_image','posts.post_status')->orderBy('lead_posts.position', 'ASC')->where('post_status', 1)->first();
    }
    return $sticky_post;
}

function make_slug($title){
    $title = preg_replace('[\‘]', '', $title);
    $title = preg_replace('[\’]', '', $title);
    $title = preg_replace('[/]', '', $title);
    $title = preg_replace('[,]', '', $title);
    $title = preg_replace('[\?]', '', $title);
    $title = preg_replace('[\!]', '', $title);
    $title = preg_replace('[\']', '', $title);
    $title = preg_replace('[\"]', '', $title);
    $title = preg_replace('[\:]', '', $title);
    $title = preg_replace('[\.]', '', $title);
    $title = preg_replace('[\)]', '', $title);
    $title = preg_replace('[\(]', '', $title);
    $title = str_replace(' ', '-', $title);
    $title = preg_replace('[-+]', '-', $title);
    $title = rtrim($title, "-");
    $title = strip_tags($title);
    $title = strtolower($title);
    return $title;
}

function video_query($take=1, $skip=0, $order='desc'){
    if($take == 1) {
        return VideoGallery::orderBy('created_at', $order)->select('id','thumbnail','title')->skip($skip)->first();
    }else{
        return VideoGallery::orderBy('created_at', $order)->select('id','thumbnail','title')->skip($skip)->take($take)->get();
    }
}
function all_video_query($order = 'desc', $show = 24){
    return VideoGallery::orderBy('id', $order)->paginate($show);
}

function single_video_query(){
    return VideoGallery::orderBy('created_at', 'desc')->first();
}

function Percent($total, $ans_count){
    if ($total == 0 or $ans_count == 0) {
        return 0;
    } else {
        $x = $total / $ans_count;
        $x = 100 / $x;
        $x = (int)$x;
        return $x;
    }
}
function todays_date() {
    $enDate = new \EasyBanglaDate\Types\BnDateTime('now', new \DateTimeZone('Asia/Dhaka'));
    $bdDate = new \EasyBanglaDate\Types\BnDateTime('now', new \DateTimeZone('Asia/Dhaka'));
    $bdDate = $bdDate->modify('+0 day');
    echo $enDate->getDateTime()->format('l, jS F Y, ') . $bdDate->format('jS F Y');
}
function todays_eng_date() {
    $enDate = new \EasyBanglaDate\Types\BnDateTime('now', new \DateTimeZone('Asia/Dhaka'));
    $bdDate = new \EasyBanglaDate\Types\BnDateTime('now', new \DateTimeZone('Asia/Dhaka'));
    $bdDate = $bdDate->modify('+0 day');
    echo $enDate->getDateTime()->format('l, jS F Y');
}
function todays_ban_date() {
    $enDate = new \EasyBanglaDate\Types\BnDateTime('now', new \DateTimeZone('Asia/Dhaka'));
    $bdDate = new \EasyBanglaDate\Types\BnDateTime('now', new \DateTimeZone('Asia/Dhaka'));
    $bdDate = $bdDate->modify('+0 day');
    echo $bdDate->format('jS F Y');
}

function e_to_b_int($input){
    $bn_digits=array('০','১','২','৩','৪','৫','৬','৭','৮','৯');
    return str_replace(range(0, 9),$bn_digits, $input);
}
function ampa_replace($input){
    $ban_month=array("এএম","পিএম");
    $eng_month=array("am","pm");
    return str_replace($eng_month,$ban_month, $input);
}

function news_url($post, $cat = null){
    if($cat == null){
        $cat_slug = $post->Category()->first()->slug;
    }else{
        $cat_slug = $cat->slug;
    }
    return route('single.post', ['category' => $cat_slug, 'id' => $post->id]);
}

function news_url_for_readmore($post, $cat = null){
    $post = Post::where('id',$post)->first();
    if($cat == null){
        $cat_slug = $post->Category()->first()->slug;
    }else{
        $cat_slug = $cat->slug;
    }
    return route('single.post', ['category' => $cat_slug, 'id' => $post->id]);
}

function photo_url($photo) {
    return route('single.photo.gallery', ['category' => Photo::find($photo->id)->Category()->first()->slug, 'id' => $photo->id, 'title' => make_slug($photo->title)]);
}
function photo_category_url($category){
    return route('category.photo.gallery', ['category'=>Category::find($category->id)->slug]);
}

function video_url($video) {
    return route('single.video.gallery', ['id' => $video->id, 'title' => make_slug($video->title)]);
}

function video_category_url($category){
    return route('category.video.gallery', ['category'=>Category::find($category->id)->slug]);
}

function publisher_photo($post) {
    return '<img src="'. $post->reporter_photo .'" alt="" style="width: 70px">';
}

function postVideoStream($site,$video_id) {
    if($site == 'youtube'){
        $embed_code = '<div class="ratio ratio-16x9"><iframe src="https://www.youtube.com/embed/'.$video_id.'" frameborder="0" allow="encrypted-media" allowfullscreen></iframe></div>';
    }elseif($site == 'facebook'){
        $embed_code = '<div class="ratio ratio-16x9"><iframe src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2FPlayStation%2Fvideos%2F'.$video_id. '%2F&show_text=0&width=560" style="border:none;overflow:hidden" scrolling="no" allowTransparency="true" allowFullScreen="true" ></iframe></div>';
    }else{
        $embed_code = "Sorry, Something is Wrong. Please play another video.";
    }
    return $embed_code;
}

function embed_video($video) {
    if ($video->streaming_site == 'youtube') {
        $embed_code = '<div class="ratio ratio-16x9"><iframe src="https://www.youtube.com/embed/'.$video->video_id.'" frameborder="0" allow="encrypted-media" allowfullscreen></iframe></div>';
    } elseif( $video->streaming_site == 'facebook') {
        $embed_code = '<div class="ratio ratio-16x9"><iframe src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2FPlayStation%2Fvideos%2F'. $video->video_id . '%2F&show_text=0&width=560" style="border:none;overflow:hidden" scrolling="no" allowTransparency="true" allowFullScreen="true"></iframe></div>';
    } else {
        $embed_code = "Sorry, Something is Wrong. Please play another video.";
    }
    return $embed_code;
}

if (! function_exists('words')) {
    function words($value, $words = 100, $end = ''){
        return \Illuminate\Support\Str::words($value, $words, $end);
    }
}

function special_news($take){
    return Post::where('post_status', '1')->where('special', 1)->orderBy('id', 'desc')->select('id','headline','sub_headline','excerpt','featured_image','post_status','created_at')->take($take)->get();
}

function e_to_b_replace($input){
    $bn_digits=array('০','১','২','৩','৪','৫','৬','৭','৮','৯');
    return str_replace(range(0, 9),$bn_digits, $input);
}

function engMonth_to_banMonth_replace($input){
    $ban_month=array("জানুয়ারি","ফেব্রুয়ারি","মার্চ","এপ্রিল","মে","জুন","জুলাই","আগষ্ট","সেপ্টেম্বর","অক্টোবর","নভেম্বর","ডিসেম্বর");
    $eng_month=array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    return str_replace($eng_month,$ban_month, $input);
}
function day_replace($day) {
    $ban_day=array("শনিবার","রবিবার","সোমবার","মঙ্গলবার","বুধবার","বৃহস্পতিবার","শুক্রবার");
    $eng_day=array("Saturday","Sunday","Monday","Tuesday","Wednesday","Thursday","Friday");
    return str_replace($eng_day,$ban_day, $day);
}
function bangla_published_time($time) {
    return e_to_b_replace( engMonth_to_banMonth_replace($time->format('j F Y, H:i') ) );
}

function bn_ago_time($timestamp){
    $time_ago = strtotime($timestamp);
    $current_time = time();
    $time_deff = $current_time - $time_ago;
    $seconds = $time_deff;
    $minutes = round($seconds / 60);
    $hours = round($seconds / 3600);
    $days = round($seconds / 86400);
    $weeks = round($seconds / 604800);
    $months = round($seconds / 2629440);
    $years = round($seconds / 31553280);

    if($seconds <= 60){
        return 'একটু আগে';
    }else if($minutes <= 60){
        if($minutes == 1){
            return 'এক মিনিট আগে';
        }else{
            return $minutes.'মিনিট আগে';
        }
    }else if($hours <= 24){
        if($hours == 1){
            return 'এক ঘন্টা আগে';
        }else{
            return $hours.' ঘন্টা আগে';
        }
    }else if($days <= 7){
        if($days == 1){
            return 'এক দিন আগে';
        }elseif($days == 7){
            return 'এক সপ্তাহ আগে';
        }
        else{
            return $days.' দিন আগে';
        }
    }else if($weeks <= 4.3){
        if($weeks == 1){
            return 'এক সপ্তাহ আগে';
        }else{
            return $weeks.' সপ্তাহ আগে';
        }
    }else if($months <= 12){
        if($months == 1){
            return 'এক মাস আগে';
        }else{
            return $months.' মাস আগে';
        }
    }else{
        if($years == 1){
            return 'এক বছর আগে';
        }else{
            return $years.' বছর আগে';
        }
    }
}
