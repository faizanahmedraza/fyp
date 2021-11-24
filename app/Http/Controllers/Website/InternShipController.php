<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\InternShip;
use Illuminate\Http\Request;

class InternShipController extends Controller
{
    public function index()
    {
        $internships = InternShip::where('is_disabled',0)->get();
        return view('website.pages.internship',compact('internships'));
    }

    public function internshipDetail($slug)
    {
        $internship = InternShip::where('slug',$slug)->first();
        return view('website.pages.internship-detail',compact('internship'));
    }
}
