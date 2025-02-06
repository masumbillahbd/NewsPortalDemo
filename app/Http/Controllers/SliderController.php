<?php

namespace App\Http\Controllers;

use App\Models\Slider;
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

class SliderController extends Controller
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
        $slider = Slider::orderby('id','desc')->get();
        return view('back.slider.slider_index', compact('slider'));
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

        $slider =  new Slider();
        $slider->author  = Auth::user()->id;
        $slider->title    = $request->title;
        $slider->link    = $request->link;

        // if($request->hasfile('image')){
        //     $file = $request->file('image');
        //     $fileName = $file->getClientOriginalName();
        //     // $img = Image::make($file->getRealPath());
        //     // $img->crop($request->w, $request->h, $request->x1, $request->y1);
        //     // $img->save(public_path('/profile/' .$fileName));
        //     $image_resize = Image::make($file->getRealPath());       
        //     $image_resize->crop(982, 500);
        //     $image_resize->save(public_path('/img/slider/' .$fileName));
        //     $slider->image = $fileName;
        // }

        if($request->hasfile('image')){
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('/img/slider/'), $fileName);
            $slider->image = $fileName;
        }
            
        $slider->save(); 
        return Redirect()->route('slider.index')->with('success','data save successfully');
    }

  

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {   
        $sliders = Slider::orderby('id','desc')->get();
        $slider = Slider::find($id);
        return view('back.slider.slider_edit', compact('sliders', 'slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request , $id)
    {
        $slider = Slider::find($id);


        $request->validate([
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $slider->author  = Auth::user()->id;
        $slider->title    = $request->title;
        $slider->link    = $request->link;

        if($request->hasfile('image')){
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('/img/slider/'), $fileName);
            $slider->image = $fileName;
        }
        
        $slider->save(); 
        return Redirect()->route('slider.index')->with('success','data update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $slider = Slider::find($id);

        $image_path         = public_path("\img\slider\\") .$slider->image;

        // dd($image_path);

        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        else{
            $slider->delete();
            //abort(404);
        }

        $slider->delete(); 
        return Redirect()->route('slider.index')->with('success','data destroy successfully');
    }
}
