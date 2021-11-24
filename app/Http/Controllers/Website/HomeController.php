<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\CMSHome;
use App\Models\CMSHomeIntro;
use App\Models\CMSORICMember;
use App\Models\CMSTestimonial;
use App\Models\Event;
use App\Models\ResearchProject;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $resultSet = CMSHome::latest()->get();
        $aim = CMSHomeIntro::first();
        $users = User::with('roles')->whereHas('roles',function ($query){
            $query->where('name','!=','super-admin');
        })->count();
        $projects = ResearchProject::all();
        $approvedFypProjects = $projects->where('type','fyp')->count();
        $approvedFundedProjects = $projects->where('type','funded')->count();
        $blogs = Blog::where('is_disabled',0)->where('is_active',1)->orderBy('created_at','desc')->take(2)->get();
        $events = Event::where('is_disabled',0)->count();
        return view('website.pages.home',compact('resultSet','aim','blogs','users','approvedFundedProjects','approvedFypProjects','events'));
    }
}
