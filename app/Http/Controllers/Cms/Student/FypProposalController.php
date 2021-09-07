<?php

namespace App\Http\Controllers\Cms\Student;

use App\Events\StatusChanged;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\ResearchProposal;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FypProposalController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('permission:research-project-list|research-project-create|research-project-update', ['only' => ['index','addResearchData']]);
//        $this->middleware('permission:research-project-create', ['only' => ['addResearch','addResearchData']]);
//        $this->middleware('permission:research-project-update', ['only' => ['updateResearch','updateResearchData']]);
//    }

    public function index()
    {
        $proposals = ResearchProposal::where('type','funded')->get();
        if(session()->has('notification'))
        {
            $notify = session()->get('notification');
            $notify->update([
                'is_read' => 1
            ]);
        }
        return view('cms.student.proposal.fyp.index', compact('proposals'));
    }

    public function addProposal()
    {
        $students = User::role('student')->get();
        return view('cms.student.proposal.fyp.add',compact('students'));
    }

    public function addProposalData()
    {
        $studentData = array();
        request()->validate([
            'student_name' => 'required|in:'.implode(',',User::role('student')->pluck('id')->toArray()),
            'title' => 'required|max:150',
            'investigator_details' => 'required|max:150',
            'abstract' => 'required|max:250',
            'agency' => 'required|max:250',
            'amount' => 'required|max:250',
            'submission_date' => 'required|date',
            'upload_research' => 'required|file|mimes:doc,pdf,docx'
        ]);

        $studentData['user_id'] = request()->student_name;
        $studentData['title'] = request()->title;
        $studentData['investigator_details'] = request()->investigator_details;
        $studentData['abstract'] = request()->abstract;
        $studentData['agency'] = request()->agency;
        $studentData['amount'] = request()->amount;
        $studentData['submission_date'] = request()->submission_date;
        $studentData['status'] = 'approved';
        $studentData['type'] = 'fyp';
        $upload_research = request()->file('upload_research');

        if (!empty($upload_research)) {
            $newResearchName = uniqid('research-project-') . '.' . $upload_research->getClientOriginalExtension();
            if(!File::isDirectory(storage_path('app/public/uploads'))){
                File::makeDirectory(storage_path('app/public/uploads'),0755, true);
            }
            Storage::putFileAs('public/uploads',$upload_research,$newResearchName);
            $studentData['upload_research'] = $newResearchName;
        }

        ResearchProposal::create($studentData);

        return redirect('/admin/fyp-proposals')->with('success','Successfully submitted.');
    }

    public function updateProposal($proposalId){
        $proposal = ResearchProposal::with('getUser')->where('type','fyp')->where('id',$proposalId)->first();
        return view('cms.student.proposal.fyp.update', compact('proposal'));
    }

    public function updateProposalData($proposalId){
        $proposal = ResearchProposal::where('type','fyp')->where('id',$proposalId)->first();
        $studentData = array();
        request()->validate([
            'title' => 'required|max:150',
            'investigator_details' => 'required|max:150',
            'abstract' => 'required|max:250',
            'agency' => 'required|max:250',
            'amount' => 'required|max:250',
            'submission_date' => 'required|date',
            'upload_research' => 'sometimes|nullable|file|mimes:doc,pdf,docx',
        ]);

        $studentData['user_id'] = $proposal->user_id;
        $studentData['title'] = request()->title;
        $studentData['investigator_details'] = request()->investigator_details;
        $studentData['abstract'] = request()->abstract;
        $studentData['agency'] = request()->agency;
        $studentData['amount'] = request()->amount;
        $studentData['submission_date'] = request()->submission_date;
        $studentData['status'] = 'approved';
        $studentData['type'] = 'fyp';
        $upload_research = request()->file('upload_research');

        if (!empty($upload_research)) {
            Storage::disk('local')->delete('public/uploads/'.$proposal->upload_research);
            $newResearchName = uniqid('research-proposal-') . '.' . $upload_research->getClientOriginalExtension();
            if(!File::isDirectory(storage_path('app/public/uploads'))){
                File::makeDirectory(storage_path('app/public/uploads'),0755, true);
            }
            Storage::putFileAs('public/uploads',$upload_research,$newResearchName);
            $studentData['upload_research'] = $newResearchName;
        } else {
            $studentData['upload_research'] = $proposal->upload_research;
        }

        $proposal->update($studentData);

        return redirect('/admin/fyp-proposals')->with('success','Successfully updated.');
    }

    public function proposalDetail($proposalId){
        $proposal = ResearchProposal::with('getUser')->where('id',$proposalId)->whereHas('getUser')->first();
        return view('cms.student.proposal.fyp.detail', compact('proposal'));
    }

    public function changeProposalStatus($proposalId, $status)
    {
        $research = ResearchProposal::findOrFail($proposalId);

        $status === "approved" ? $flag = 'approved' : $flag = 'rejected';

        $research->update([
            'status' => $flag
        ]);

        Notification::create([
            'user_id' => $research->user_id,
            'type' => 'status-fyp-proposal',
            'message' => " fyp proposal request has been {$flag}."
        ]);

        event(new StatusChanged('fyp-proposal',$research));
        return response()->json(['msg' => "Successfully status updated", 'status' => ucfirst($flag)]);
    }
}
