<?php

namespace App\Http\Controllers;

use App\Models\Headline;
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

class HeadlineController extends Controller
{
    public $user_info;
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $user = $this->user_info=Auth::user(); 
            if ($user->role== 'editor'|| $user->role== 'user'){
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
        $headlines = Headline::orderby('id','desc')->paginate(20);
        return view('back.headline.index', compact('headlines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.headline.create');
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
            'title' => 'required',
            'type' => 'required',
        ]);

        $headline = new Headline;
        // $video->user_id = Auth::user()->id;
        $headline->title = $request->title;
        $headline->type = $request->type;
        $headline->save();
        Session::flash('success', 'Successfully Added');

        return Redirect::to(route('headline.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Headline  $headline
     * @return \Illuminate\Http\Response
     */
    public function show(Headline $headline)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Headline  $headline
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {   
        $headline = Headline::find($id);
        return view('back.headline.edit', compact('headline'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Headline  $headline
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'type' => 'required',
        ]);

        $headline = Headline::find($id);
        // $video->user_id = Auth::user()->id;
        $headline->title = $request->title;
        $headline->type = $request->type;
        $headline->save();
        Session::flash('success', 'Successfully Updated');

        return Redirect::to(route('headline.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Headline  $headline
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $headline = Headline::find($id);
        $headline->delete();
        Session::flash('success', 'Successfully Deleted');
        return Redirect::to(route('headline.index'));
    }
}
