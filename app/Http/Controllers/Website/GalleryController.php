<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index($slug)
    {
        $gallery = Gallery::with('getEvent')->whereHas('getEvent',function ($query) use ($slug){
            $query->where('slug',$slug);
        })->get();
        if(empty($gallery) || count($gallery) == 0)
        {
            $gallery = [];
        }
        return view('website.pages.gallery',compact('gallery'));
    }
}
