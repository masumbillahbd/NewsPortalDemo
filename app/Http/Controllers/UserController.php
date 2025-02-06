<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\GeneralSetting;
use Auth;
use Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use DB;
use Illuminate\Support\Facades\Session;
class UserController extends Controller
{

    public $user_info;
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $user = $this->user_info=Auth::user(); 
            if ($user->role == 'manager admin' || $user->role== 'editor'|| $user->role== 'user'){
                return redirect(route('dashboard.admin.index'))->with("danger", "Forbidden You don't have permission to access");
            } else {
                 return $next($request);
            }
        });
    }
    

    protected function index(){
      return view('back.user.user_index');
    }

    protected function create(){
      return view('back.user.user_create');
    }

    
    protected function store(Request $request){
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password|min:8',
        ]);


        $user = new User();

        $user->name = $request->name;
        $user->short_name = $request->short_name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->status = 1;
        $user->password = Hash::make($request->password);

        // if($request->hasfile('photo')){
        //     $file = $request->file('photo');
        //     $fileName = $file->getClientOriginalName();
        //     // $img = Image::make($file->getRealPath());
        //     // $img->crop($request->w, $request->h, $request->x1, $request->y1);
        //     // $img->save(public_path('/profile/' .$fileName));
        //     $image_resize = Image::make($file->getRealPath());       
        //     $image_resize->resize(200, 200);
        //     $image_resize->save(public_path('/profile/' .$fileName));
        //     $user->photo = $fileName;
        // }

        if($request->hasfile('photo')){
            $file = $request->file('photo');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('/profile/'), $fileName);
            $user->photo = $fileName;
        }

        $user->save();
        return Redirect()->back()->with('success',  'User inserted successfully');
      
    }

    protected function edit($id){
      $user = User::find($id);
      return view('back.user.user_edit', compact('user'));
    }


    protected function update(Request $request, $id){
      $user = User::find($id);

        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users,email,'.$user->id.',id',
            'role' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password|min:8',
        ]);

        $user->name = $request->name;
        $user->short_name = $request->short_name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->status = 1;
        $user->password = Hash::make($request->password);

        // if($request->hasfile('photo')){
        //     $file = $request->file('photo');
        //     $fileName = $file->getClientOriginalName();
        //     $image_resize = Image::make($file->getRealPath());       
        //     $image_resize->resize(200, 200);
        //     $image_resize->save(public_path('/profile/' .$fileName));
        //     $user->photo = $fileName;
        // }

        if($request->hasfile('photo')){
            $file = $request->file('photo');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('/profile/'), $fileName);
            $user->photo = $fileName;
        }

        $user->save();
        return Redirect()->route('user.index')->with('success',  'User updated successfully');
    }

    protected function destroy($id){
      $user = User::find($id);
    //   $user->delete();
        return Redirect()->route('user.index')->with('success',  'User deleted successfully');
    }

    

    //admin
    protected function admin_index(){
        $admins = User::where([['email','!=','masumdhaka99@gmail.com'],['email','!=','it.anwarul@gmail.com']])->get();
        return view('back.user.admin.admin_index', compact('admins'));
    }

    protected function admin_create(){
        return view('back.user.admin.admin_create');
    }

    protected function admin_store(Request $request){

        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password|min:8',
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->short_name = $request->short_name;
        $user->email = $request->email;
        $user->status = 1;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);
        if($request->hasfile('photo')){
            $file = $request->file('photo');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('/profile/'), $fileName);
            $user->photo = $fileName;
        }

        $user->save();
        return Redirect()->route('admin.index')->with('success',  'inserted successfully');
    }

    protected function admin_edit($id){
        $admin = User::find($id);
        return view('back.user.admin.admin_edit', compact('admin'));
    }

    protected function admin_update(Request $request, $id){
        $user = User::find($id);
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users,email,'.$user->id.',id',
            'role' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password|min:8',
        ]);

        $user->name = $request->name;
        $user->short_name = $request->short_name;
        $user->email = $request->email;
        $user->status = 1;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);

        if($request->hasfile('photo')){
            $file = $request->file('photo');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('/profile/'), $fileName);
            $user->photo = $fileName;
        }
        $user->save();
        return Redirect()->route('admin.index')->with('success',  'updated successfully');
    }

    protected function admin_destroy($id){
        $user = User::find($id);
        
        $post = $user->post->count();
        $ad = $user->ad->count();
        $category = $user->category->count();
        $subCategory = $user->subCategory->count();
        $subMenu = $user->subMenu->count();
        // $photo = $user->photo->count();
        $page = $user->page->count();
        $menu = $user->menu->count();
        $videoGallery = $user->videoGallery->count();
        
        $total_relation = $post + $ad + $category + $subCategory + $subMenu  + $page + $menu + $videoGallery;
        if($total_relation == 0) {
            $user->delete();
            Session::flash('success', 'Successfully Deleted');
        }else{
            Session::flash('danger', 'don\'t Deleted. This record related another records');
        }
        return Redirect()->route('admin.index');
    }



    //staff
    protected function staff_index(){
        $staffs = User::whereIn('role', ['accountant', 'manager'])->get();
        return view('back.user.staff.staff_index', compact('staffs'));
    }

    protected function staff_create(){
        return view('back.user.staff.staff_create');
    }

    protected function staff_store(Request $request){

        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password|min:8',
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);

        // if($request->hasfile('photo')){
        //     $file = $request->file('photo');
        //     $fileName = $file->getClientOriginalName();
        //     $image_resize = Image::make($file->getRealPath());       
        //     $image_resize->resize(200, 200);
        //     $image_resize->save(public_path('/profile/' .$fileName));
        //     $user->photo = $fileName;
        // }

        if($request->hasfile('photo')){
            $file = $request->file('photo');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('/profile/'), $fileName);
            $user->photo = $fileName;
        }

        $user->save();
        return Redirect()->route('staff.index')->with('success',  'Staff inserted successfully');
    }

    protected function staff_edit($id){
        $staff = User::find($id);
        return view('back.user.staff.staff_edit', compact('staff'));
    }

    protected function staff_update(Request $request, $id){
        $user = User::find($id);
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users,email,'.$user->id.',id',
            'role' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password|min:8',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);

        // if($request->hasfile('photo')){
        //     $file = $request->file('photo');
        //     $fileName = $file->getClientOriginalName();
        //     $image_resize = Image::make($file->getRealPath());       
        //     $image_resize->resize(200, 200);
        //     $image_resize->save(public_path('/profile/' .$fileName));
        //     $user->photo = $fileName;
        // }

        if($request->hasfile('photo')){
            $file = $request->file('photo');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('/profile/'), $fileName);
            $user->photo = $fileName;
        }
        $user->save();
        return Redirect()->route('staff.index')->with('success',  'Staff updated successfully');
    }

    protected function staff_destroy($id){
        $staff = User::find($id);
        // $staff->delete();
        return Redirect()->route('staff.index')->with('success',  'Staff deleted successfully');
    }

   

    // status toggle button 
    public function changeUserStatus(Request $request)
    {   
        $user = User::find($request->id);
        $user->status = $request->status;
        $user->save();
        return response()->json(['success'=>'Change admin status successfully.']);
    }



    
}
