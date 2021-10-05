<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\RegisterEvent;
use App\Models\RegisterIntern;
use App\Models\ResearchProject;
use App\Models\ResearchProposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $proposals = ResearchProposal::where('user_id',Auth::id())->get();
        $projects = ResearchProject::with('getProposal')->where('user_id',Auth::id())->get();
        $approvedFypProposals = $proposals->where('type','fyp')->filter(function ($value){
            return $value->status === 'approved';
        })->count();
        $approvedFundedProposals = $proposals->where('type','fyp')->filter(function ($value){
            return $value->status === 'approved';
        })->count();
        $rejectedFypProposals = $proposals->where('type','funded')->filter(function ($value){
            return $value->status === 'rejected';
        })->count();
        $rejectedFundedProposals = $proposals->where('type','funded')->filter(function ($value){
            return $value->status === 'rejected';
        })->count();
        $approvedFypProjects = $projects->where('type', 'fyp')->count();
        $approvedFundedProjects = $projects->where('type', 'funded')->count();
        $events = RegisterEvent::where('user_id',Auth::id())->count();
        $interns = RegisterIntern::where('user_id',Auth::id())->count();
        return view('frontend.index',compact('approvedFypProposals','approvedFundedProposals','rejectedFypProposals','rejectedFundedProposals','events','interns','approvedFypProjects','approvedFundedProjects'));
    }
}
