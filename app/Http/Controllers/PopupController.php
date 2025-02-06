<?php

namespace App\Http\Controllers;

use App\Models\Popup;
use Illuminate\Http\Request;

use DateTime;
use Auth;
use Image;

use File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Pagination\CursorPaginator;

class PopupController extends Controller
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
        return view("back.popup.create");
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
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $popup =  new Popup();
        $popup->name    = $request->name;
        $popup->link    = $request->link;
        $popup->position    = $request->position;
        $popup->status    = $request->status;
        if($request->hasfile('image')){
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('/img/popup/'), $fileName);
            $popup->image = $fileName;
        }
        $popup->save();
        return Redirect()->route('popup.index')->with('success','Inserted successfully');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Popup  $popup
     * @return \Illuminate\Http\Response
     */
    public function edit( $popup)
    {
        $popup = Popup::find($popup);
        return view('back.popup.edit', compact('popup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Popup  $popup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $popup)
    {
        $popup = Popup::find($popup);
        $request->validate([
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $popup->name    = $request->name;
        $popup->link    = $request->link;
        $popup->position    = $request->position;
        $popup->status    = $request->status;
        if($request->hasfile('image')){
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('/img/popup/'), $fileName);
            $popup->image = $fileName;
        }
        $popup->save();
        return Redirect()->route('popup.index')->with('success','Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Popup  $popup
     * @return \Illuminate\Http\Response
     */
    public function destroy( $popup)
    {
        $popup = Popup::find($popup);
        $image_path         = public_path("/img/popup/").$popup->image;
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        $popup->delete();
        return Redirect()->route('popup.index')->with('success','Deleted successfully');
    }
}
