<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\ResearchProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $proposals = ResearchProject::where('user_id',Auth::id())->get();
        $approvedProposals = $proposals->filter(function ($value){
            return $value->status === 'approved';
        })->count();
        $rejectedProposals = $proposals->filter(function ($value){
            return $value->status === 'rejected';
        })->count();
        return view('frontend.index',compact('approvedProposals','rejectedProposals'));
    }
}
