<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\FundingOpportunity;
use Illuminate\Http\Request;

class FundingOpportunityController extends Controller
{
    public function index()
    {
        $opportunities = FundingOpportunity::where('amount',NULL)->get();
        return view('website.pages.funding-opportunity',compact('opportunities'));
    }
}
