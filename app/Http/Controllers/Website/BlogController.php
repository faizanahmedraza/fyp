<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('is_active',1)->get();
        return view('website.pages.blog',compact('blogs'));
    }

    public function blogDetail($slug)
    {
        $blog = Blog::where('slug',$slug)->first();
        return view('website.pages.blog-detail',compact('blog'));
    }
}
