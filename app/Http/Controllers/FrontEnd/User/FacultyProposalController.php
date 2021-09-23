<?php

namespace App\Http\Controllers\FrontEnd\User;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\ResearchProject;
use App\Models\UploadSample;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FacultyProposalController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:faculty-project-proposal-list|faculty-project-proposal-create', ['only' => ['index', 'addFacultyResearchData']]);
        $this->middleware('permission:faculty-project-proposal-create', ['only' => ['addFacultyResearch', 'addFacultyResearchData']]);
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
        return view('frontend.user.project-proposal.faculty.index', compact('projects'));
    }

    public function addFacultyResearch()
    {
        return view('frontend.user.project-proposal.faculty.add');
    }

    public function addFacultyResearchData()
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

        return redirect('/user/faculty-research-proposals')->with('success', 'Successfully submitted.');
    }

    public function detailFacultyResearch($researchId)
    {
        $research = ResearchProject::findOrFail($researchId);
        return view('frontend.user.project-proposal.faculty.detail', compact('research'));
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
