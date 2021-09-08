<?php

namespace App\Http\Controllers\FrontEnd\User;

use App\Events\StatusChanged;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\ResearchProposal;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
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
        $proposals = ResearchProposal::with('getUser')->where('type','fyp')->where('user_id',Auth::id())->get();
        if(session()->has('notification'))
        {
            $notify = session()->get('notification');
            $notify->update([
                'is_read' => 1
            ]);
        }
        return view('frontend.user.proposal.fyp.index', compact('proposals'));
    }

    public function addProposal()
    {
        $user = Auth::user();
        return view('frontend.user.proposal.fyp.add',compact('user'));
    }

    public function addProposalData()
    {
        $studentData = array();
        request()->validate([
            'title' => 'required|max:150',
            'investigator_details' => 'required|max:150',
            'abstract' => 'required|max:250',
            'agency' => 'required|max:250',
            'amount' => 'required|max:250',
            'submission_date' => 'required|date',
            'upload_research' => 'required|file|mimes:doc,pdf,docx'
        ]);

        $studentData['user_id'] = Auth::id();
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

        $admin = User::role('super-admin')->first()->id;

        Notification::create([
            'user_id' => Auth::id(),
            'type' => 'fyp-project-proposal',
            'message' => ' is send approval request of fyp proposal.'
        ]);

        event(new \App\Events\FormSubmitted('fyp-project-proposal', $admin));

        return redirect('/admin/fyp-proposals')->with('success','Successfully submitted.');
    }

    public function proposalDetail($proposalId){
        $proposal = ResearchProposal::with('getUser')->where('id',$proposalId)->whereHas('getUser')->first();
        return view('frontend.user.proposal.fyp.detail', compact('proposal'));
    }
}
