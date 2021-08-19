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
        $gallery = Event::where('slug',$slug)->with('getGalleries')->first();
        return view('website.pages.gallery',compact('gallery'));
    }
}
