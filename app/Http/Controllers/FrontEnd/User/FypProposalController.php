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
    public function __construct()
    {
        $this->middleware('permission:user-fyp-proposal-list|user-fyp-proposal-create', ['only' => ['index', 'addProposalData']]);
        $this->middleware('permission:user-fyp-proposal-create', ['only' => ['addProposal', 'addProposalData']]);
    }

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
            'investigator_details_pi' => 'required|max:150',
            'investigator_details_copi' => 'required|max:150',
            'abstract' => 'required|max:250',
            'agency' => 'required|max:250',
            'submission_date' => 'required|date',
            'upload_research' => 'required|file|mimes:doc,pdf,docx'
        ],[
            'investigator_details_pi.required' => 'The investigator principal details is required.',
            'investigator_details_pi.max' => 'The investigator principal details may not be greater than 150 characters.',
            'investigator_details_copi.required' => 'The investigator co-principal details is required.',
            'investigator_details_copi.max' => 'The investigator co-principal details may not be greater than 150 characters.',
        ]);

        $studentData['user_id'] = Auth::id();
        $studentData['title'] = request()->title;
        $studentData['investigator_details_pi'] = request()->investigator_details_pi;
        $studentData['investigator_details_copi'] = request()->investigator_details_copi;
        $studentData['abstract'] = request()->abstract;
        $studentData['agency'] = request()->agency;
        $studentData['amount'] = request()->amount;
        $studentData['submission_date'] = Carbon::parse(request()->submission_date)->format('Y-m-d');
        $studentData['status'] = 'pending';
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

        try {
            event(new \App\Events\FormSubmitted('fyp-project-proposal', $admin));
        } catch (\Exception $exception) {
            $exception->getMessage();
        }

        return redirect('/user/fyp-proposals')->with('success','Successfully submitted.');
    }

    public function proposalDetail($proposalId){
        $proposal = ResearchProposal::with('getUser')->where('id',$proposalId)->whereHas('getUser')->first();
        return view('frontend.user.proposal.fyp.detail', compact('proposal'));
    }
}
