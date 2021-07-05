<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\ResearchProject;
use App\Models\User;

class HomeController extends Controller
{
    public function index(){
        $activeUsers = User::where('is_block',0)->count();
        $blockUsers = User::where('is_block',1)->count();
        $approvedProposals = ResearchProject::where('status','approved')->count();
        $rejectedProposals = ResearchProject::where('status','rejected')->count();
        $admins = User::with('roles')->whereHas('roles',function ($query){
            $query->where('name','admin');
        })->count();
        $students = User::with('roles')->whereHas('roles',function ($query){
            $query->where('name','student');
        })->count();
        $researchers = User::with('roles')->whereHas('roles',function ($query){
            $query->where('name','researcher');
        })->count();
        return view('cms.index',compact('activeUsers','blockUsers','approvedProposals','rejectedProposals','admins','students','researchers'));
    }
}
