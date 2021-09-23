<?php

namespace App\Http\Controllers\FrontEnd\User;

use App\Events\StatusChanged;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\ResearchProject;
use App\Models\ResearchProposal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FypProjectController extends Controller
{
    //    public function __construct()
//    {
//        $this->middleware('permission:research-project-list|research-project-create|research-project-update', ['only' => ['index','addResearchData']]);
//        $this->middleware('permission:research-project-create', ['only' => ['addResearch','addResearchData']]);
//        $this->middleware('permission:research-project-update', ['only' => ['updateResearch','updateResearchData']]);
//    }

    public function index()
    {
        $projects = ResearchProject::with(['getUser','getProposal'])->where('type','fyp')->where('user_id',Auth::id())->get();
        if(session()->has('notification'))
        {
            $notify = session()->get('notification');
            $notify->update([
                'is_read' => 1
            ]);
        }
        return view('frontend.user.project.fyp.index', compact('projects'));
    }

    public function addProject()
    {
        $user = Auth::user();
        $proposals = ResearchProposal::where('type','fyp')->where('user_id',Auth::id())->get();
        return view('frontend.user.project.fyp.add',compact('proposals','user'));
    }

    public function addProjectData()
    {
        $studentData = array();
        request()->validate([
            'proposal_title' => 'required|in:'.implode(',',ResearchProposal::where('type','fyp')->pluck('id')->toArray()),
            'submission_date' => 'required|date',
            'upload_project' => 'required|file|mimes:doc,pdf,docx'
        ]);

        $studentData['user_id'] = Auth::id();
        $studentData['title'] = (int)request()->proposal_title;
        $studentData['submission_date'] = Carbon::parse(request()->submission_date)->format('Y-m-d');
        $studentData['type'] = 'fyp';
        $upload_project = request()->file('upload_project');

        if (!empty($upload_project)) {
            $newResearchName = uniqid('research-project-') . '.' . $upload_project->getClientOriginalExtension();
            if(!File::isDirectory(storage_path('app/public/uploads'))){
                File::makeDirectory(storage_path('app/public/uploads'),0755, true);
            }
            Storage::putFileAs('public/uploads',$upload_project,$newResearchName);
            $studentData['upload_project'] = $newResearchName;
        }

        ResearchProject::create($studentData);

        return redirect('/admin/fyp-projects')->with('success','Successfully submitted.');
    }

    public function projectDetail($projectId){
        $project = ResearchProject::with(['getUser','getProposal'])->where('id',$projectId)->first();
        return view('frontend.user.project.fyp.detail', compact('project'));
    }
}
