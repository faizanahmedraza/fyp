<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\CMSResearch;
use App\Models\ResearchProject;
use Illuminate\Http\Request;

class FypController extends Controller
{
    public function index()
    {
        $resultSet = CMSResearch::latest()->first();
        $projects = ResearchProject::with('getProposal')->has('getProposal')->where('type','fyp')->get();
        return view('website.pages.fyp-project',compact('resultSet','projects'));
    }
}
