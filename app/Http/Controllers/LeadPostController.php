<?php

namespace App\Http\Controllers;

use App\Models\LeadPost;
use App\Models\Breakingnews;
use App\Models\VideoGallery;
use App\Models\Category;
use App\Models\Division;
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

class LeadPostController extends Controller
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
        $lead_posts = LeadPost::orderBy('position', 'asc')->skip(20)->take(PHP_INT_MAX)->get();
        if($lead_posts->count() > 0){
            foreach($lead_posts as $lead){
                $lead->delete();
            }
        }
        $lead_posts = LeadPost::orderBy('position', 'asc')->take(20)->get();
        return view('back.lead_post.index', compact('lead_posts'));
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
            'position' => 'required|max:2|unique:lead_posts',
            'post_id' => 'required|unique:lead_posts'
        ]);

        // whereDate( 'created_at', '<=', now()->subDays(30))->delete();

        
        $lead_post = new LeadPost();
        $lead_post->position = $request->position;
        $lead_post->post_id = $request->post_id;
        $lead_post->save();

        Session::flash('success', 'Successfully Added');

        return Redirect::to(route('leadpost.index'));

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LeadPost  $leadPost
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $leadPostEdit = LeadPost::find($id);
        return view('back.lead_post.edit', compact('leadPostEdit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LeadPost  $leadPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'position' => 'required|max:2|unique:lead_posts',
            'post_id' => 'required|unique:lead_posts'
        ]);

        $lead_post = LeadPosts::find($id);
        $lead_post->position = $request->position;
        $lead_post->post_id = $request->post_id;
        $lead_post->save();
        Session::flash('success', 'Successfully Added');
        return Redirect::to(route('leadpost.index'));
    }

    public function destroy($id)
    {
        LeadPost::find($id)->delete();
        Session::flash('success', 'Successfully Deleted');
        return Redirect::to(route('leadpost.index'));
    }
    public function updatePosition(Request $request){
//        return $request->position;

        foreach ($request->position as $key => $id){
            $lead_post = LeadPost::findOrFail($id);
            $lead_post->update(['position' => $key+1]);
        }
        return response()->json(array(
            'success' => true,
        ));
    }

}
