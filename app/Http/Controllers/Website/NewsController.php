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
        $resultSet = CMSNews::latest()->first();
        $blogs = Blog::where('is_active',1)->get();
        return view('website.pages.news',compact('resultSet','blogs'));
    }
}
