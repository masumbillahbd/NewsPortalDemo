<?php

namespace App\Http\Controllers;

use App\Models\Post;
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
use Illuminate\Pagination\CursorPaginator;

class ReadMoreController extends Controller
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
        $posts = Post::orderby('id','desc')->take(300)->get();
        // dd($posts);
        $readmore = ReadMore::orderby('id','desc')->take(300)->get();
        return view('back.readmore.create',compact('posts','readmore'));
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
        // dd($request);
        $request->validate([
            'leader' => 'required',
            'post_id' => 'required',
        ]);
        
        $readmore = new ReadMore();
        $readmore->leader = $request->leader;
        $readmore->post_id = $request->post_id;
        $readmore->save();
        Session::flash('success', 'Successfully Added');
        return Redirect::route('readmore.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReadMore  $readMore
     * @return \Illuminate\Http\Response
     */
    public function show(ReadMore $readMore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReadMore  $readMore
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {   

        $edit = ReadMore::findOrFail($id);
        $posts = Post::orderby('id','desc')->take(300)->get();
        $readmore = ReadMore::orderby('id','desc')->take(300)->get();
        return view('back.readmore.edit',compact('edit','posts','readmore'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReadMore  $readMore
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {   
        $request->validate([
            'leader' => 'required',
            'post_id' => 'required',
        ]);

        $readmore = ReadMore::findOrFail($id);

        $readmore->leader = $request->leader;
        $readmore->post_id = $request->post_id;
        $readmore->save();
        Session::flash('success', 'Successfully Updated');
        return Redirect::route('readmore.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReadMore  $readMore
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $readmore = ReadMore::findOrFail($id);
        $readmore->delete();
        Session::flash('success', 'Successfully Deleted');
        return Redirect::route('readmore.index');
    }
}
