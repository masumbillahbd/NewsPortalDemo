<?php

namespace App\Http\Controllers;

use App\Models\Breakingnews;
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

class BreakingnewsController extends Controller
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
        $breakingnews = Breakingnews::orderBy('id','desc')->paginate(20);
        return view('back.breakingnews.index', compact('breakingnews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'news_text' => 'required'
        ]);

        $breaking_news = new Breakingnews();
        $breaking_news->news_text = $request->news_text;
        $breaking_news->news_link = $request->news_link;
        $breaking_news->save();

        Session::flash('success', 'Successfully Added');
        return Redirect::to(route('breakingnews.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Breakingnews  $breakingnews
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {   
        $edit = Breakingnews::find($id);
         $breakingnews = Breakingnews::orderBy('id','desc')->paginate(20);
        return view('back.breakingnews.edit', compact('edit', 'breakingnews'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Breakingnews  $breakingnews
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $request->validate([
            'news_text' => 'required'
        ]);

        $breaking_news = Breakingnews::find($id);
        $breaking_news->news_text = $request->news_text;
        $breaking_news->news_link = $request->news_link;
        $breaking_news->save();

        Session::flash('success', 'Successfully Updated');
        return Redirect::to(route('breakingnews.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Breakingnews  $breakingnews
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $breaking_news = Breakingnews::find($id);
        $breaking_news->delete();
        Session::flash('success', 'Successfully Deleted');
        return Redirect::to(route('breakingnews.index'));
    }
}
