<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\CMSHome;
use App\Models\CMSNews;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $resultSet = CMSNews::where('is_disabled',0)->latest()->first();
        $blogs = Blog::where('is_disabled',0)->where('is_active',1)->get();
        return view('website.pages.news',compact('resultSet','blogs'));
    }

    public function newsDetail($slug)
    {
        $blog = Blog::where('slug',$slug)->first();
        if(empty($blog))
        {
            abort(404);
        }
        return view('website.pages.news-detail',compact('blog'));
    }
}
