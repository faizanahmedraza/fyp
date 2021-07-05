<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\ResearchProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $approvedProposals = ResearchProject::where('user_id',Auth::id())->where('status','approved')->count();
        $rejectedProposals = ResearchProject::where('user_id',Auth::id())->where('status','rejected')->count();
        return view('frontend.index',compact('approvedProposals','rejectedProposals'));
    }
}
