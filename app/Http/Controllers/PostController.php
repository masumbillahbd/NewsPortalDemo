<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\LeadPost;
use App\Models\Post;
use App\Models\Draft;
use App\Models\Tag;
use App\Models\Setting;
use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use App\Models\Banner;
use App\Models\ReadMore;

use DateTime;
use Auth;
use Image;

use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PostController extends Controller{
    public function trashpost_index(){
        $pageNumber = 10;
        $trashposts = DB::table('trashposts')->orderBy('created_at', 'desc')->paginate(20);
        return view('back.trashpost.index', compact('trashposts'));
    }
    public function trashpost_view($id){
        $trashpost = DB::table('trashposts')->where('id',$id)->first();
        return view('back.trashpost.view', compact('trashpost'));
    }
    public function trashpost_destroy($id){
        DB::table('trashposts')->where('id',$id)->delete();
        Session::flash('success', 'Successfully Deleted');
        return Redirect::back();
    }
    public  function search(Request $request){
        // $tag = DB::table('tags')->pluck('name');
        $query = $request->value;
        $post = Post::where('id', $query)->first();
        if(!empty($post)){
            $posts = Post::where('id', $query)->paginate(20);
        }else{
            $posts = Post::where('headline', 'LIKE', '%' . $query . '%')
                ->orWhere('post_content', 'LIKE', '%' . $query . '%')
                ->orWhere('id', 'LIKE' . $query )
                ->paginate(20);
        }
        $posts->appends($request->all());
        return view('back.post.post_search', compact('posts', 'query'));
    }
    public function index()
    {

      
        // $posts = Post::whereRaw("DATE_FORMAT(publish_time, '%Y-%m-%d %H:%i') = ?", [Carbon::now()->format('Y-m-d H:i')])->get();
        // dd($posts, Carbon::now()->format('Y-m-d H:i'));

        $lead_posts = LeadPost::orderBy('position', 'asc')->skip(20)->take(PHP_INT_MAX)->get();
        if($lead_posts->count() > 0){
            foreach($lead_posts as $lead){
                $lead->delete();
            }
        }
        $posts = Post::orderby('id','desc')->paginate(20);

        if(Auth::user()->role == 'user'){
            return Redirect::route('post.user');
        }
        return view('back.post.post_index', compact('posts'));
    }

    public function store(Request $request)
    { 
        $request->validate([
            'headline' => 'required',
            'post_content' => 'required',
            'excerpt' => 'required',
            'category_id' => 'required',
        ]);
        
        $sticky_position = preg_replace('/[^\p{L}\p{N}\s]/u', '', $request->sticky_position);

       
        $date_time = date('Y-m-d-H-i-s');
        if($request->draft == 'draft'){
            $request->publisher_name ? $writer_name = $request->publisher_name : $writer_name = Auth::user()->name;
            $slug = make_slug($request->headline);
            $request->excerpt ? $excerpt = $request->excerpt : $excerpt = strip_tags(substr($request->post_content, 0, 400));
           
            $post = new Draft;
            
            $post->user_id = Auth::user()->id;
            $post->publisher_name = $writer_name;
            $post->headline = $request->headline;
            $post->sub_headline = $request->sub_headline;

            $post->slug = $slug;
            $post->excerpt = $excerpt;
            $post->post_content = $request->post_content;
            if($request->featured_image){
                $post->featured_mini = $request->featured_image;
                $post->featured_image = $request->featured_image;
            }else{
                $post->featured_image = '/defaults/lazy_logo.jpg';
            }
                
            $post->featured_image_caption = $request->featured_image_caption;
            $post->sticky = $request->sticky ? 1 : 0;
            $post->watermark = $request->watermark ? 1 : 0;
            $post->post_status = $request->post_status ? 0 : 1;
            $post->reporter_photo = $request->reporter_photo;
    
            $post->special = $request->special;

            $post->save();
            
            if ($request->category_id) {
                $post->Category()->attach($request->category_id);
            }

            if ($request->tag_list) {
                $tags = explode(',', $request->tag_list);
                foreach ($tags as $tag) {
                    $item = Tag::firstOrCreate(['name' => $tag]);
                    $post->Tag()->attach($item->id);
                }
            }
            Session::flash('success', 'Successfully Draft Added');

            return Redirect::route('draft.index');
        }else{
         
        $request->publisher_name ? $writer_name = $request->publisher_name : $writer_name = Auth::user()->name;
        $slug = make_slug($request->headline);
        $request->excerpt ? $excerpt = $request->excerpt : $excerpt = strip_tags(substr($request->post_content, 0, 400));
       
        $post = new Post;
        
        $post->user_id = Auth::user()->id;
        $post->publisher_name = $writer_name;
        $post->rss = $request->rss == 'on' ? 1:0;
        $post->scroll = $request->scroll == 'on' ? 1:0;
        $post->reporter_id = $request->reporter_id;
        $post->headline = $request->headline;
        $post->sub_headline = $request->sub_headline;
        //video
        $post->video_url = $request->video_url;
        $post->video_from = $request->video_from;
        $post->video_id = $request->video_id;
        $post->video_thumbnail = $request->video_thumbnail;

        $post->slug = $slug;
        $post->excerpt = $excerpt;
        $post->post_content = $request->post_content;
        
        if($request->hasfile('podcast')){
            $file = $request->file('podcast');
            $fileName = time().'_podcast.'.$file->getClientOriginalExtension();
            $file->move(public_path('/podcast/'), $fileName);
            $post->podcast = $fileName;
        }
       
        if($request->featured_image){
            $post->featured_mini = $request->featured_image;
            $post->featured_image = $request->featured_image;
            
            // social media banner
            // $banner = $request->banner;
            // if($banner != null){
            //     $main_img = $f_image;
            //     $marge_img = $banner;
            //     $dst_img = getimagesize($main_img);
            //     $src_img = getimagesize("$marge_img");
            //     $src_img_posi_dis = $dst_img[1] - $src_img[1];
            //     $src_img_posi =   $src_img_posi_dis-0;
            //     $marge_img = imagecreatefromstring(file_get_contents($marge_img));
            //     $main_img = imagecreatefromstring(file_get_contents($main_img));
            //     imagecopymerge($main_img, $marge_img,  0, $src_img_posi, 0, 0, $src_img[0], $src_img[1], 100);
            //     // Header( "Content-type: image/png");
            //     Header( "Content-type: image/jpeg");
            //     $merge_name = time();
            //     //imagepng($main_img, public_path('fb_share/'.$merge_name.'.png'));
            //     imagejpeg($main_img, public_path('fb_share/'.$merge_name.'.jpeg'));
            //     // $post->sm_image =  $merge_name.'.png';
            //     $post->sm_image =  $merge_name.'.jpeg'; 
            // }
        }else{
            $post->featured_image = '/defaults/lazy_logo.jpg';
        }
            
        $post->featured_image_caption = $request->featured_image_caption;
        $post->sticky = $request->sticky ? 1 : 0;
        $post->watermark = $request->watermark ? 1 : 0;
        $post->post_status = $request->post_status ? 0 : 1;
        $post->reporter_photo = $request->reporter_photo;
   
        $post->special = $request->special;

        $post->save();
        
        if ($request->category_id) {
            $post->Category()->attach($request->category_id);
        }
        if ($request->sub_category_id) {
            $post->subCategory()->attach($request->sub_category_id);
        }
        if ($request->division_id) {
            $post->Division()->attach($request->division_id);
        }
        
        if ($request->district_id) {
            $post->District()->attach($request->district_id);
        }
        
        if ($request->upazila_id) {
            $post->Upazila()->attach($request->upazila_id);
        }

        if ($request->tag_list) {
            $tags = explode(',', $request->tag_list);
            foreach ($tags as $tag) {
                $item = Tag::firstOrCreate(['name' => $tag]);
                $post->Tag()->attach($item->id);
            }
        }

        $lead_post_position = LeadPost::where('position', $sticky_position)->first();
        $lead_post_item = LeadPost::where('post_id', $post->id)->first();
        if ($request->sticky) {
            if ($lead_post_item) {
                $lead_post_item->delete();
            }
            if ($lead_post_position) {
                $leadposts = LeadPost::orderBy('position', 'asc')->get();
                foreach ($leadposts as $leadpost) {
                    if ($leadpost->position == $lead_post_position->position || $leadpost->position > $lead_post_position->position) {
                        $leadpost->position = $leadpost->position + 1;
                        $leadpost->save();
                    }
                }
            }
        } else {
            if ($lead_post_item) {
                $lead_post_item->delete();
            }
        }
        if (!empty($sticky_position)) {
            $lead_post = new LeadPost();
            $lead_post->position = $sticky_position;
            $lead_post->post_id = $post->id;
            $lead_post->save();
        }
        

        Session::flash('success', 'Successfully Added');
        if(Auth::user()->role == 'user'){
            return Redirect::route('post.user');
        }
        return Redirect::route('post.create');
        }

    }

    public function edit($id){
        $divisions = Division::all();
        $post = Post::find($id);
        $categories = Category::orderBy('position','asc')->get();
        return view('back.post.post_edit', compact('divisions','post', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'headline' => 'required',
            'post_content' => 'required',
            'excerpt' => 'required',
            'category_id' => 'required'
        ]);

        if(!empty($request->publish_time)){
            $publish_time = Carbon::parse($request->publish_time)->format('Y-m-d H:i');
        }else{
            $publish_time = null;
        }

        // dd($request->all(),$publish_time);

        
        $sticky_position = preg_replace('/[^\p{L}\p{N}\s]/u', '', $request->sticky_position);
        $post = Post::find($id);
        $post->rss = $request->rss == 'on' ? 1:0;
        $post->scroll = $request->scroll == 'on' ? 1:0;
        $post->reporter_id = $request->reporter_id;
        // $post->publish_time = $publish_time ?? null;
        $post->publish_time = $publish_time ? Carbon::parse($publish_time)->toDateTimeString() : null;
        $date_time = date('Y-m-d-H-i-s');
        if($request->hasfile('podcast')){
            $file = $request->file('podcast');
            $fileName = time().'_podcast.'.$file->getClientOriginalExtension();
            $file->move(public_path('/podcast/'), $fileName);
            $post->podcast = $fileName;
        }
        
        $lead_post_position = LeadPost::where('position', $sticky_position)->first();
        $lead_post_item = LeadPost::where('post_id', $post->id)->first();
        if ($request->sticky) {
            if ($lead_post_item) {
                $lead_post_item->delete();
            }
            if ($lead_post_position) {
                $leadposts = LeadPost::orderBy('position', 'asc')->get();
                foreach ($leadposts as $leadpost) {
                    if ($leadpost->position == $lead_post_position->position || $leadpost->position > $lead_post_position->position) {
                        $leadpost->position = $leadpost->position + 1;
                        $leadpost->save();
                    }
                }
            }
        } else {
            if ($lead_post_item) {
                $lead_post_item->delete();
            }
        }
        if (!empty($sticky_position)) {
            $lead_post = new LeadPost();
            $lead_post->position = $sticky_position;
            $lead_post->post_id = $post->id;
            $lead_post->save();
        }

        $slug = make_slug($request->headline);
        $request->excerpt ? $excerpt = $request->excerpt : $excerpt = strip_tags(substr($request->post_content, 0, 200));

        $post->headline = $request->headline;
        $post->last_update_by = Auth::user()->id;
        $post->last_update_at = date('Y-m-d H:i:s');
        $post->sub_headline = $request->sub_headline;
        $post->slug = $slug;
        $post->excerpt = $excerpt;
        $post->post_content = $request->post_content;
        
        if($request->featured_image){
            $post->featured_mini = $request->featured_image;
            $post->featured_image = $request->featured_image;
        }

        $post->featured_image_caption = $request->featured_image_caption;
        $post->sticky = $request->sticky ? 1 : 0;
        $post->post_status = $request->post_status ? 0 : 1;
        $post->watermark = $request->watermark ? 1 : 0;
        $post->reporter_photo = $request->reporter_photo;
        
        //video
        $post->video_url = $request->video_url;
        $post->video_from = $request->video_from;
        $post->video_id = $request->video_id;
        $post->video_thumbnail = $request->video_thumbnail;
        
        $post->special = $request->special;
        $post->category()->detach();
        $post->subCategory()->detach();
        $post->Tag()->detach();
        $post->division()->detach();
        $post->district()->detach();
        $post->upazila()->detach();
        $post->save();
        
        if($request->category_id) {
            $post->Category()->sync($request->category_id);
        }
        if ($request->sub_category_id) {
            $post->subCategory()->sync($request->sub_category_id);
        }
        
        if ($request->division_id) {
            $post->division()->sync($request->division_id);
        }
        
        if ($request->district_id) {
            $post->district()->sync($request->district_id);
        }
        
        if ($request->upazila_id) {
            $post->upazila()->sync($request->upazila_id);
        }
        $tag_list = [];
        if ($request->tag_list) {
            $tags = explode(',', $request->tag_list);
            foreach ($tags as $tag) {
                if ($item = Tag::where('name', $tag)->first()) {
                    array_push($tag_list, $item->id);
                } else {
                    $item = Tag::firstOrCreate(['name' => $tag]);
                    array_push($tag_list, $item->id);
                }
            }
        }
        $post->Tag()->sync($tag_list);
        Session::flash('success', 'Successfully Updated');
        if(Auth::user()->role == 'user'){
            return Redirect::route('post.user');
        }
        return Redirect::route('post.index');
    }

    public function destroy($id){
        $post = Post::find($id);
        DB::table('trashposts')->insert(
            ['post_id' => $post->id,'user_id' => $post->user_id,'deleted_by' => Auth::user()->id,'publisher_name' => $post->publisher_name,'headline' => $post->headline,'single_page_headline' => $post->single_page_headline,'sub_headline' => $post->sub_headline,'slug' => $post->slug,'excerpt' => $post->excerpt,'facebook_description' => $post->facebook_description,'post_content' => $post->post_content,'featured_image' => $post->featured_image,'featured_mini' => $post->featured_mini,'sticky' => $post->sticky,'post_status' => $post->post_status,'reporter_photo' => $post->reporter_photo,'last_update_by' => $post->last_update_by,'view_count' => $post->view_count,'featured_image_caption' => $post->featured_image_caption,'sm_image' => $post->sm_image,'rss' => $post->rss,'created_at' => $post->created_at,'updated_at' => $post->updated_at]
        );
        $post->Tag()->detach();
        $post->category()->detach();
        $post->district()->detach();
        $post->division()->detach();
        $post->upazila()->detach();
        $lead_post_item = LeadPost::where('post_id', $post->id)->first();
        if ($lead_post_item) {
            $lead_post_item->delete();
        }
        $post->delete();
        Session::flash('success', 'Successfully Deleted');
        return Redirect::back();
    }


    public function duplicate($id){
        $post = Post::findOrFail($id);
        $category = '';
        foreach($post->Category as $category){
            $category =$category->id;
        }
        $rand_code = '_copy';
        $newPost = $post->replicate();
        $newPost->headline = $post->headline.' '.$rand_code;
        $newPost->slug = $post->slug.'-'.$rand_code;
        $newPost->created_at = Carbon::now();
        $newPost->save();
        if(!empty($category)){
            $category = $category;
        }else{
            $category = Category::first()->id;
        }
        $newPost->category()->sync($category, false);
        return Redirect()->route('post.index')->with('success',  'Post duplicate successfully');
    }
    
    public function post_filter(Request $request){
        $category_id = $request->category_id;
        if($category_id != null){
            $posts = Category::find($category_id)->posts()->where('post_status', 1)->orderBy('id', 'desc')->paginate(20);
            $posts->appends($request->all());
        }else if($request->sort_by == 'asc'){
            $posts = Post::where('post_status', 1)->orderBy('id', 'asc')->paginate(20);
            $posts->appends($request->all());
        }
        else if($request->sort_by == 'desc'){
            $posts = Post::where('post_status', 1)->orderBy('id', 'desc')->paginate(20);
            $posts->appends($request->all());
        }
        else{
            $posts = Post::orderby('id', 'desc')->paginate(20);
            $posts->appends($request->all());
        }
        return view('back.post.post_filter', compact('posts','category_id'));
    }
    
    public function publicationStatus(Request $request){
        $post = Post::find($request->id);
        $post->post_status = $request->post_status;
        $post->save();
        return response()->json(['success'=>'Publication status change successfully.']);
    }
    public function tagLiveSearch(Request $request, $keyword){
        $tags = DB::table('tags')->select('name')->where('name','LIKE',$keyword.'%')->get();
        return Response::json($tags);
    }


    public function user_post(){   
        $user_id = Auth::user()->id;
        $posts = Post::orderby('id','desc')->where('user_id', $user_id)->Paginate(20);
        return view('back.post.user_post', compact('posts'));
    }

    
    public function AjaxDistrict(Request $request){
        $division_id = $request->id;
        $districts = Division::find($division_id)->district()->orderBy('slug', 'asc')->get();
        return Response::json($districts);
    }
    public function AjaxUpazila(Request $request){
        $district_id = $request->id;
        $upazila = DB::table('upazilas')->where('district_id', $district_id)->get();
        return Response::json($upazila);
    }
    
    public function create(){   
        $divisions = Division::all();
        $categories = Category::orderBy('position','asc')->get();
        $banners = Banner::where('status',1)->orderBy('id','asc')->get();
        return view('back.post.post_create', compact('divisions','categories','banners'));
    }
    
    
    public function categorySubCategoyAJAX($category_id){
        $sub_category  = SubCategory::where('category_id',$category_id)->get();
        return Response::json($sub_category);
    }

}
