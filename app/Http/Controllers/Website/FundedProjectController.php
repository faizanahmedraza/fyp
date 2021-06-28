<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\FundingOpportunity;
use Illuminate\Http\Request;

class FundedProjectController extends Controller
{
    public function index()
    {
        $projects = FundingOpportunity::where('amount','!=',NULL)->get();
        return view('website.pages.funded-project',compact('projects'));
    }
}
