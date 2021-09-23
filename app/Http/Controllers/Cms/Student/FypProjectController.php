<?php

namespace App\Http\Controllers\Cms\Student;

use App\Events\StatusChanged;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\ResearchProject;
use App\Models\ResearchProposal;
use App\Models\User;
use Illuminate\Http\Request;
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
        $projects = ResearchProject::where('type','fyp')->get();
        if(session()->has('notification'))
        {
            $notify = session()->get('notification');
            $notify->update([
                'is_read' => 1
            ]);
        }
        return view('cms.student.project.fyp.index', compact('projects'));
    }

    public function addProject()
    {
        $students = User::role('student')->get();
        $proposals = ResearchProposal::where('type','fyp')->get();
        return view('cms.student.project.fyp.add',compact('students','proposals'));
    }

    public function addProjectData()
    {
        $studentData = array();
        request()->validate([
            'student_name' => 'required|in:'.implode(',',User::role('student')->pluck('id')->toArray()),
            'proposal_title' => 'required|in:'.implode(',',ResearchProposal::where('type','fyp')->pluck('id')->toArray()),
            'submission_date' => 'required|date',
            'upload_project' => 'required|file|mimes:doc,pdf,docx'
        ]);

        $studentData['user_id'] = (int)request()->student_name;
        $studentData['title'] = (int)request()->proposal_title;
        $studentData['submission_date'] = \Carbon\Carbon::parse(request()->submission_date)->format('Y-m-d');
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

    public function updateProject($projectId){
        $project = ResearchProject::with(['getUser','getProposal'])->where('type','fyp')->where('id',$projectId)->first();
        $proposals = ResearchProposal::where('type','fyp')->get();
        return view('cms.student.project.fyp.update', compact('project','proposals'));
    }

    public function updateProjectData($projectId){
        $proposal = ResearchProject::where('type','fyp')->where('id',$projectId)->first();
        $studentData = array();
        request()->validate([
            'submission_date' => 'required|date',
            'upload_project' => 'required|file|mimes:doc,pdf,docx'
        ]);

        $studentData['user_id'] = $proposal->user_id;
        $studentData['research_proposal_id'] = $proposal->research_proposal_id;
        $studentData['submission_date'] = \Carbon\Carbon::parse(request()->submission_date)->format('Y-m-d');
        $studentData['type'] = 'fyp';
        $upload_project = request()->file('upload_project');

        if (!empty($upload_project)) {
            Storage::disk('local')->delete('public/uploads/'.$proposal->upload_project);
            $newResearchName = uniqid('project-project-') . '.' . $upload_project->getClientOriginalExtension();
            if(!File::isDirectory(storage_path('app/public/uploads'))){
                File::makeDirectory(storage_path('app/public/uploads'),0755, true);
            }
            Storage::putFileAs('public/uploads',$upload_project,$newResearchName);
            $studentData['upload_project'] = $newResearchName;
        } else {
            $studentData['upload_project'] = $proposal->upload_project;
        }

        $proposal->update($studentData);

        return redirect('/admin/fyp-projects')->with('success','Successfully updated.');
    }

    public function projectDetail($projectId){
        $project = ResearchProject::with('getUser')->where('id',$projectId)->whereHas('getUser')->first();
        return view('cms.student.project.fyp.detail', compact('project'));
    }
}
