<?php

namespace App\Http\Controllers\Cms\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\FundingOpportunity;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class FundingOpportunityController extends Controller
{
    public function index()
    {
        $resultSet = FundingOpportunity::where('amount',NULL)->get()->except(['funding_agency', 'amount']);
        return view('cms.website.pages.research.funding-opportunity.index', compact('resultSet'));
    }

    public function addFundingOpportunity()
    {
        return view('cms.website.pages.research.funding-opportunity.add');
    }

    public function addFundingOpportunityData()
    {
        request()->validate([
            'title' => ['required', 'unique:funding_opportunities,title,NULL,id,principle_investigator,' . request('principle_investigator') . ',department,' . request('department') . ',deleted_at,NULL'],
            'principle_investigator' => ['required'],
            'department' => ['required', 'max:50'],
        ]);

        FundingOpportunity::create([
            'title' => request()->title,
            'principle_investigator' => request()->principle_investigator,
            'department' => request()->department,
            'created_by' => Auth::id()
        ]);

        return redirect()->route('website.page.research.funding-opportunity')->with('success', 'Your data is successfully added!');
    }

    public function updateFundingOpportunity($fundingOpportunityId)
    {
        $updateResult = FundingOpportunity::findOrFail($fundingOpportunityId);
        return view('cms.website.pages.research.funding-opportunity.update', compact('updateResult'));
    }

    public function updateFundingOpportunityData($fundingOpportunityId)
    {
        $updateResult = FundingOpportunity::findOrFail($fundingOpportunityId);

        request()->validate([
            'title' => ['required', 'unique:funding_opportunities,title,' . $fundingOpportunityId . ',id,principle_investigator,' . request('principle_investigator') . ',department,' . request('department') . ',deleted_at,NULL'],
            'principle_investigator' => ['required'],
            'department' => ['required', 'max:50'],
        ]);

        $updateResult->update([
            'title' => request()->title,
            'principle_investigator' => request()->principle_investigator,
            'department' => request()->department,
            'updated_by' => Auth::id()
        ]);

        return redirect()->route('website.page.research.funding-opportunity')->with('success', 'Your data is successfully updated!');
    }

    public function deleteFundingOpportunity($fundingOpportunityId)
    {
        $msg = "Some thing went wrong!";
        $code = 400;
        $updateResult = FundingOpportunity::findOrFail($fundingOpportunityId);
        if (!empty($updateResult)) {
            $msgText = $updateResult->is_disabled ? "enabled" : "disabled";
            $updateResult->update(['is_disabled' => $updateResult->is_disabled ? 0 : 1]);
            $msg = "Successfully {$msgText}!";
            $code = 200;
        }

        return response()->json(['msg' => $msg], $code);
    }
}
