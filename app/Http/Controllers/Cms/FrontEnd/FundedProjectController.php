<?php

namespace App\Http\Controllers\Cms\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\FundingOpportunity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FundedProjectController extends Controller
{
    public function index()
    {
        $resultSet = FundingOpportunity::where('amount','!=',NULL)->get();
        return view('cms.website.pages.research.funded-project.index', compact('resultSet'));
    }

    public function addFundedProject()
    {
        return view('cms.website.pages.research.funded-project.add');
    }

    public function addFundedProjectData()
    {
        request()->validate([
            'title' => ['required', 'unique:funding_opportunities,title,NULL,id,principle_investigator,' . request('principle_investigator') . ',department,' . request('department'). ',funding_agency,' . request('funding_agency') . ',deleted_at,NULL'],
            'principle_investigator' => ['required','max:100'],
            'funding_agency' => ['required','max:100'],
            'amount' => ['required','numeric'],
            'department' => ['required', 'max:50'],
        ]);

        FundingOpportunity::create([
            'title' => request()->title,
            'principle_investigator' => request()->principle_investigator,
            'funding_agency' => request()->funding_agency,
            'amount' => request()->amount,
            'created_by' => Auth::id()
        ]);

        return redirect()->route('website.page.research.funded-project')->with('success', 'Your data is successfully added!');
    }

    public function updateFundedProject($fundedProjectId)
    {
        $updateResult = FundingOpportunity::findOrFail($fundedProjectId);
        return view('cms.website.pages.research.funded-project.update', compact('updateResult'));
    }

    public function updateFundedProjectData($fundedProjectId)
    {
        $updateResult = FundingOpportunity::findOrFail($fundedProjectId);

        request()->validate([
            'title' => ['required', 'unique:funding_opportunities,title,' . $fundedProjectId . ',id,principle_investigator,' . request('principle_investigator') . ',department,' . request('department'). ',funding_agency,' . request('funding_agency') . ',deleted_at,NULL'],
            'principle_investigator' => ['required','max:100'],
            'funding_agency' => ['required','max:100'],
            'amount' => ['required','numeric'],
            'department' => ['required', 'max:50'],
        ]);

        $updateResult->update([
            'title' => request()->title,
            'principle_investigator' => request()->principle_investigator,
            'department' => request()->department,
            'updated_by' => Auth::id()
        ]);

        return redirect()->route('website.page.research.funded-project')->with('success', 'Your data is successfully updated!');
    }

    public function deleteFundedProject($fundedProjectId)
    {
        $msg = "Some thing went wrong!";
        $code = 400;
        $updateResult = FundingOpportunity::findOrFail($fundedProjectId)->first();

        if (!empty($updateResult)) {
            $updateResult->delete();
            $msg = "Successfully Delete record!";
            $code = 200;
        }

        return response()->json(['msg' => $msg], $code);
    }
}
