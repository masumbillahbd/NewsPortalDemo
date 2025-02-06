<?php

namespace App\Http\Controllers;

use App\Models\VideoGallery;
use App\Models\Category;
use App\Models\Division;
use App\Models\LeadPost;
use App\Models\Post;
use App\Models\Tag;

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
use Illuminate\Pagination\CursorPaginator;

class VideoGalleryController extends Controller
{
    public $user_info;
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $user = $this->user_info=Auth::user(); 
            if ($user->role== 'user'){
                return redirect(route('dashboard.admin.index'))->with("danger", "Forbidden You don't have permission to access");
            } else {
                 return $next($request);
            }
        });
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = VideoGallery::orderBy('id','desc')->paginate(20);
        return view('back.video.video_index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.video.video_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:250|unique:video_galleries',
            'video_url' => 'required|max:250',
            'video_id' => 'required|max:250',
            'featured_image' => 'required|max:250',
            'streaming_site' => 'required|max:250',
        ]);

        $video = new VideoGallery;
        $video->user_id = Auth::user()->id;
        $video->title = $request->title;
        $video->slug = make_slug($request->title);
        $video->video_url = $request->video_url;
        $video->video_id = $request->video_id;
        $video->thumbnail = $request->featured_image;
        $video->streaming_site = $request->streaming_site;
        $video->save();

        Session::flash('success', 'Successfully Added');
        return Redirect::to(route('video.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VideoGallery  $videoGallery
     * @return \Illuminate\Http\Response
     */
    public function show(VideoGallery $videoGallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VideoGallery  $videoGallery
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {   
        $video = VideoGallery::find($id);
        return view('back.video.video_edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VideoGallery  $videoGallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        
        $video = VideoGallery::find($id);
        $request->validate([
            'title' => 'required|max:250|unique:video_galleries,title,'.$video->id.',id',
            'video_url' => 'required|max:250',
            'video_id' => 'required|max:250',
            'featured_image' => 'required|max:250',
            'streaming_site' => 'required|max:250',
        ]);

        $video = VideoGallery::find($id);
        $video->user_id = Auth::user()->id;
        $video->title = $request->title;
        $video->slug = make_slug($request->title);
        $video->video_url = $request->video_url;
        $video->video_id = $request->video_id;
        $video->thumbnail = $request->featured_image;
        $video->streaming_site = $request->streaming_site;
        $video->save();

        Session::flash('success', 'Successfully Updated');
        return Redirect::to(route('video.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VideoGallery  $videoGallery
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $video = VideoGallery::find($id);
        $video->delete();
        Session::flash('success', 'Successfully Deleted');
        return Redirect::to(route('video.index'));
    }
}
