<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Photobody;

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


class PhotoController extends Controller
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
        $photos = Photo::orderBy('id','desc')->paginate(20);

        // dd($photos );
                        
        return view('back.photo.photo_index', compact('photos'));
    }

    public function show($id){
        $photo = Photo::find($id);
        $photobodies = Photobody::where('photo_id',$photo->id)->get();
        // dd($photobodies);
        return view('back.photo.photo_show', compact('photo','photobodies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.photo.photo_create');
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
            'title' => 'required|max:200',
            'featured_image' => 'required|max:250',
        ]);

        // dd($request);

        $photo = new Photo;
        $photo->user_id = Auth::user()->id;
        $photo->title = $request->title;
        $photo->slug = make_slug($request->title);
        $photo->featured_image = $request->featured_image;
        $photo->save();

        foreach($request->thumbnail as $index => $photo_detail){
            $photo_body = new Photobody;
            $photo_body->photo_id  = $photo->id;
            $photo_body->thumbnail = $request->thumbnail[$index];
            $photo_body->caption = $request->caption[$index];
            $photo_body->save();
        }


     
        Session::flash('success', 'Successfully Added');
        return Redirect::to(route('photo.index'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $photo = Photo::find($id);
        $photobody = Photobody::where('photo_id',$photo->id)->first();
        $photobodies = Photobody::where('photo_id',$photo->id)->get();
        $photobodies = $photobodies->skip(1);

        return view('back.photo.photo_edit', compact('photo','photobody','photobodies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $photo = Photo::find($id);
        // $request->validate([
        //     'title' => 'required',
        //     'thumbnail' => 'required',
        //     'content' => 'required',
        // ]);
        // $photo->user_id = Auth::user()->id;
        // $photo->person_id = $request->person_id;
        // $photo->title = $request->title;
        // $photo->thumbnail = $request->thumbnail;
        // $photo->thumbnail_caption = $request->thumbnail_caption;
        // $photo->content = $request->content;
        // $photo->save();

        $request->validate([
            'title' => 'required',
            'featured_image' => 'required',
        ]);

        $photobody = Photobody::where('photo_id',$photo->id)->get();

        foreach($photobody as $body){
            $body->delete();
        }

        $photo->user_id = Auth::user()->id;
        $photo->title = $request->title;
        $photo->slug = make_slug($request->title);
        $photo->featured_image = $request->featured_image;
        $photo->save();

        foreach($request->thumbnail as $index => $photo_detail){
            $photo_body = new Photobody;
            $photo_body->photo_id  = $photo->id;
            $photo_body->thumbnail = $request->thumbnail[$index];
            $photo_body->caption = $request->caption[$index];
            $photo_body->save();
        }

        Session::flash('success', 'Successfully Updated');
        return Redirect::to(route('photo.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $photo = Photo::find($id);
        $photobody = Photobody::where('photo_id',$photo->id)->get();
        foreach($photobody as $body){
            $body->delete();
        }

        $photo->delete();
        Session::flash('success', 'Successfully Deleted');
        return Redirect::to(route('photo.index'));
    }
}
