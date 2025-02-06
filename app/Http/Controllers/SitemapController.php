<?php
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Setting;
  
class SitemapController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index($value='')
    {
        $posts = Post::latest()->get();
  
        return response()->view('_front.sitemap.sitemap', [
            'posts' => $posts
        ])->header('Content-Type', 'text/xml');
    }
}