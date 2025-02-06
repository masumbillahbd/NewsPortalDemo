<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Division;
use App\Models\LeadPost;
use App\Models\Post;
use App\Models\Draft;
use App\Models\Tag;
use App\Models\Viewcount;
use App\Models\Setting;
use App\Models\User;

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

class ReportController extends Controller
{
    public $user_info;
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $user = $this->user_info=Auth::user(); 
            if ( $user->role== 'editor'|| $user->role== 'user'){
                return redirect(route('dashboard.admin.index'))->with("danger", "Forbidden You don't have permission to access");
            } else {
                 return $next($request);
            }
        });
    }
    

    public function user_post(){
        $users = User::orderby('id','asc')->get();
        return view('back.reports.user_post', compact('users'));
    }

    public function user_post_by_date(Request $request){
        $users = User::orderby('id','asc')->get();
        $daterange = $request->date;

        $query = $request->date;
        
        $start_date = substr($daterange, 0,-13);
        $start_date = strtotime($start_date);
        $start_date = date("Y-m-d", $start_date);
        
        $end_date = substr($daterange, -10);
        $end_date = strtotime($end_date);
        $end_date = date("Y-m-d", $end_date);
        
        // $posts = Post::whereBetween('created_at', [$start_date, $end_date])->get();
        $posts = DB::select('SELECT DISTINCT(user_id)  FROM posts WHERE (DATE(created_at) BETWEEN "'.$start_date.'" AND "'.$end_date.'") ');
        $user_id = 6;    
        //$posts = DB::select('SELECT count(id) as userPost FROM posts WHERE (DATE(created_at) BETWEEN "'.$start_date.'" AND "'.$end_date.'") AND user_id='.$user_id.' ');
    
        return view('back.reports.search_by_date', compact('users', 'posts', 'start_date', 'end_date'));
    }

    public function userPostCountByDate($id,$start_date,$end_date){
        
        $user = User::findOrFail($id);
        $start_date = $start_date;
        $end_date = $end_date;
        $dateRange = [];
        $iDateFrom = mktime(1, 0, 0, substr($start_date, 5, 2), substr($start_date, 8, 2), substr($start_date, 0, 4));
        $iDateTo = mktime(1, 0, 0, substr($end_date, 5, 2), substr($end_date, 8, 2), substr($end_date, 0, 4));
        if ($iDateTo >= $iDateFrom) {
            array_push($dateRange, date('Y-m-d', $iDateFrom)); // first entry
            while ($iDateFrom<$iDateTo) {
                $iDateFrom += 86400; // add 24 hours
                array_push($dateRange, date('Y-m-d', $iDateFrom));
            }
        }
        // $totalUserPost = DB::select('SELECT DISTINCT DATE(created_at) FROM posts WHERE (DATE(created_at) BETWEEN "'.$start_date.'" AND "'.$start_date.'") AND user_id='.$user->id.' '); 
        return view('back.reports.userPostCountByDate', compact('user', 'dateRange','start_date','end_date'));
    }
    
    public function dateWisePostView(){
        // $views = Viewcount::orderBy('created_at','desc')->get();
        $today = Carbon::today()->toDateString();
        $first_day_of_month = Carbon::today()->startOfMonth()->toDateString();
        $views = Viewcount::whereBetween('date', [$first_day_of_month, $today])->orderBy('date','asc')->get();
        $total_views = $views->sum('view');
        // dd($views);
        return view('back.reports.dateWisePostView', compact('views', 'total_views'));
    }
    
    public function dateWisePostViewSearch(Request $request){
        $daterange = $request->date;
        $query = $request->date;
        $start_date = substr($daterange, 0,-13);
        $start_date = strtotime($start_date);
        $start_date = date("Y-m-d", $start_date);
        
        $end_date = substr($daterange, -10);
        $end_date = strtotime($end_date);
        // $end_date = date("Y-m-d h:i:s", $end_date);
        $end_date = date("Y-m-d", $end_date);
        
        $views = Viewcount::whereBetween('date', [$start_date, $end_date])->orderBy('date','asc')->get();
        $total_views = $views->sum('view');
        return view('back.reports.dateWisePostViewSearch', compact('views', 'total_views', 'start_date','end_date'));
    }
    public function loginReport(){
        return view('back.reports.loginReport');
    }
    public function logoutReport(){
        return view('back.reports.logoutReport');
    }
}
