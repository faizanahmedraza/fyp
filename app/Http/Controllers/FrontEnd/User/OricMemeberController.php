<?php

namespace App\Http\Controllers\FrontEnd\User;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\ResearchProject;
use App\Models\UploadSample;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class OricMemeberController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:oric-member-project-proposal-list|oric-member-project-proposal-create', ['only' => ['index', 'addOricMemberResearchData']]);
        $this->middleware('permission:oric-member-project-proposal-create', ['only' => ['addOricMemberResearch', 'addOricMemberResearchData']]);
    }

    public function index()
    {
        $projects = ResearchProject::all();
        if (session()->has('notification')) {
            $notify = session()->get('notification');
            $notify->update([
                'is_read' => 1
            ]);
        }
        return view('frontend.user.project-proposal.oric-member.index', compact('projects'));
    }

    public function addOricMemberResearch()
    {
        return view('frontend.user.project-proposal.oric-member.add');
    }

    public function addOricMemberResearchData()
    {
        $focalPersonData = array();
        request()->validate([
            'title' => 'required|max:150',
            'investigator_details' => 'required|max:150',
            'abstract' => 'required|max:250',
            'agency' => 'required|max:250',
            'amount' => 'required|digits_between:1,8',
            'submission_date' => 'required|date',
            'upload_research' => 'required|file|mimes:doc,pdf,docx'
        ]);

        $focalPersonData['user_id'] = Auth::id();
        $focalPersonData['title'] = request()->title;
        $focalPersonData['investigator_details'] = request()->investigator_details;
        $focalPersonData['abstract'] = request()->abstract;
        $focalPersonData['agency'] = request()->agency;
        $focalPersonData['amount'] = request()->amount;
        $focalPersonData['submission_date'] = Carbon::parse(request()->submission_date)->format('Y-m-d');
        $focalPersonData['status'] = 'pending';
        $upload_research = request()->file('upload_research');

        if (!empty($upload_research)) {
            $newResearchName = uniqid('research-project-') . '.' . $upload_research->getClientOriginalExtension();
            if(!File::isDirectory(storage_path('app/public/uploads'))){
                File::makeDirectory(storage_path('app/public/uploads'),0755, true);
            }
            Storage::putFileAs('public/uploads',$upload_research,$newResearchName);
            $focalPersonData['upload_research'] = $newResearchName;
        }

        ResearchProject::create($focalPersonData);

        $admin = User::role('super-admin')->first()->id;

        Notification::create([
            'user_id' => Auth::id(),
            'type' => 'project-proposal',
            'message' => ' is send approval request of research project.'
        ]);

        event(new \App\Events\FormSubmitted('apply', $admin));

        return redirect('/user/oric-member-research-proposals')->with('success', 'Successfully submitted.');
    }

    public function detailOricMemberResearch($researchId)
    {
        $research = ResearchProject::findOrFail($researchId);
        return view('frontend.user.project-proposal.oric-member.detail', compact('research'));
    }

    public function downloadTemplate()
    {
        $query = UploadSample::latest()->first();
        if (!empty($query)) {
            return response()->download(public_path('storage/uploads/'. $query->name));
        } else {
            abort(404);
        }
    }
}
