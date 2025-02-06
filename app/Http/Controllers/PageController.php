<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Http\Requests;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Support\Facades\Response;
use Auth;
class PageController extends Controller
{
    public $user_info;
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $user = $this->user_info=Auth::user(); 
            if ($user->role== 'editor'||$user->role== 'user'){
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
        $pages = Page::orderby('id','desc')->get();
        return view('back.pages.page_index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.pages.page_create');
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
            'title' => 'required|max:150|unique:pages',
            'content' => 'required|max:30000',
        ]);

        $page = new Page();
        $page->user_id = Auth::user()->id;
        $page->title = $request->title;
        $page->slug = make_slug($request->title);
        $page->url = $request->url;
        $page->content = $request->content;
        $page->meta_title = $request->meta_title;
        $page->meta_description = $request->meta_description;
        $page->keywords = $request->keywords;

        $page->save();
        return Redirect()->route('page.index')->with('success',  'Page inserted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $page = Page::find($id);

        return view('back.pages.page_edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $page = Page::find($id);
        
        $request->validate([
            'title' => 'required|max:150|unique:pages,title,'.$page->id.',id',
            'content' => 'required|max:30000',
        ]);

        $page->user_id = Auth::user()->id;
        $page->title = $request->title;
        $page->slug = make_slug($request->title);
        $page->url = $request->url;
        $page->content = $request->content;
        $page->meta_title = $request->meta_title;
        $page->meta_description = $request->meta_description;
        $page->keywords = $request->keywords;

        $page->save();
        return Redirect()->route('page.index')->with('success',  'Page updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $page = Page::find($id);
        $page->delete();
        return Redirect()->route('page.index')->with('success',  'Page deleted successfully');
    }


    public function imageMarge(){
        return view('back.pages.image_marge');
    }

    public function imageMargeStore(Request $request){


        if($request->hasfile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $image =  date('Ymd_His').'.'.$extension;
            $path  = public_path('img');
            $file->move($path, $image);
            $image =  public_path('img/'.$image);
            $bannger =  public_path('img/og_banner1.png');
            // dd($image);
            list($image_width, $image_height, $image_type, $image_attr) = getimagesize($image);
            list($bannger_width, $bannger_height, $bannger_type, $bannger_attr) = getimagesize($bannger);
            $height_distance = $image_height - $bannger_height;
            $height_distance =   $height_distance - 0;   
            // print_r($height_distance);
            $image = imagecreatefromstring(file_get_contents($image));
            $bannger = imagecreatefromstring(file_get_contents($bannger));
            imagecopymerge($image, $bannger, 0, $height_distance, 0, 0, $bannger_width, $bannger_height, 100);
            Header( "Content-type: image/jpg");
            $merge_name = time();
            imagejpeg($image, public_path('img/'.$merge_name.'.jpg'));
        





            

            // $data->slide_image = $fileName;
            // $file = $request->file('logo');
            // $org_name = $file->getClientOriginalName();
            // // dd($org_name);
            // $fileName =  date('Ymd_His').'_'.$org_name;

            // $image_resize = Image::make($file->getRealPath());              
            // // $image_resize->resize(300, 300);
            // $image_resize->crop(300, 300, 150, 150);
            // $image_resize->save(public_path('brands/' .$fileName));
            // $brand->logo = $fileName;
        }

        // if($request->hasfile('image')){
            
        //     $file = $request->file('image');
        //     $fileName = $file->getClientOriginalName();
        //     // dd($fileName);
        //     move_uploaded_file($fileName, 'public/img');

        // }

    }
}
