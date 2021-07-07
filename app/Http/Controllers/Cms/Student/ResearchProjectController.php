<?php

namespace App\Http\Controllers\Cms\Student;

use App\Events\StatusChanged;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\ResearchProject;
use App\Models\UploadSample;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ResearchProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:research-project-list|research-project-create|research-project-update', ['only' => ['index','addResearchData']]);
        $this->middleware('permission:research-project-create', ['only' => ['addResearch','addResearchData']]);
        $this->middleware('permission:research-project-update', ['only' => ['updateResearch','updateResearchData']]);
    }

    public function index()
    {
        $projects = ResearchProject::all();
        if(session()->has('notification'))
        {
            $notify = session()->get('notification');
            $notify->update([
                'is_read' => 1
            ]);
        }
        return view('cms.student.research-project.index', compact('projects'));
    }

    public function addResearch()
    {
        $students = User::role('student')->get();
        return view('cms.student.research-project.add',compact('students'));
    }

    public function addResearchData()
    {
        $studentData = array();
        request()->validate([
            'user_id' => 'required|in:'.implode(',',User::role('student')->pluck('id')->toArray()),
            'title' => 'required|max:150',
            'investigator_details' => 'required|max:150',
            'abstract' => 'required|max:250',
            'agency' => 'required|max:250',
            'amount' => 'required|max:250',
            'submission_date' => 'required|date',
            'upload_research' => 'required|file|mimes:doc,pdf,docx',
            'status' => 'required|in:approved,rejected',
        ]);

        $studentData['user_id'] = request()->user_id;
        $studentData['title'] = request()->title;
        $studentData['investigator_details'] = request()->investigator_details;
        $studentData['abstract'] = request()->abstract;
        $studentData['agency'] = request()->agency;
        $studentData['amount'] = request()->amount;
        $studentData['submission_date'] = request()->submission_date;
        $studentData['status'] = request()->status;
        $upload_research = request()->file('upload_research');

        if (!empty($upload_research)) {
            $newResearchName = uniqid('research-project-') . '.' . $upload_research->getClientOriginalExtension();
            if(!File::isDirectory(storage_path('app/public/uploads'))){
                File::makeDirectory(storage_path('app/public/uploads'),0755, true);
            }
            Storage::putFileAs('public/uploads',$upload_research,$newResearchName);
            $studentData['upload_research'] = $newResearchName;
        }

        ResearchProject::create($studentData);

        return redirect('/admin/user/research-projects')->with('success','Successfully submitted.');
    }

    public function updateResearch($researchId){
        $project = ResearchProject::with('getUser')->where('id',$researchId)->whereHas('getUser')->first();
        return view('cms.student.research-project.update', compact('project'));
    }

    public function updateResearchData($researchId){
        $project = ResearchProject::with('getUser')->where('id',$researchId)->whereHas('getUser')->first();
        $studentData = array();
        request()->validate([
            'title' => 'required|max:150',
            'investigator_details' => 'required|max:150',
            'abstract' => 'required|max:250',
            'agency' => 'required|max:250',
            'amount' => 'required|max:250',
            'submission_date' => 'required|date',
            'upload_research' => 'sometimes|nullable|file|mimes:doc,pdf,docx',
            'status' => 'required|in:approved,rejected',
        ]);

        $studentData['user_id'] = $project->user_id;
        $studentData['title'] = request()->title;
        $studentData['investigator_details'] = request()->investigator_details;
        $studentData['abstract'] = request()->abstract;
        $studentData['agency'] = request()->agency;
        $studentData['amount'] = request()->amount;
        $studentData['submission_date'] = request()->submission_date;
        $studentData['status'] = request()->status;
        $upload_research = request()->file('upload_research');

        if (!empty($upload_research)) {
            Storage::disk('local')->delete('public/uploads/'.$project->upload_research);
            $newResearchName = uniqid('research-project-') . '.' . $upload_research->getClientOriginalExtension();
            if(!File::isDirectory(storage_path('app/public/uploads'))){
                File::makeDirectory(storage_path('app/public/uploads'),0755, true);
            }
            Storage::putFileAs('public/uploads',$upload_research,$newResearchName);
            $studentData['upload_research'] = $newResearchName;
        } else {
            $studentData['upload_research'] = $project->upload_research;
        }

        $project->update($studentData);

        return redirect('/admin/user/research-projects')->with('success','Successfully updated.');
    }

    public function researchDetail($researchId){
        $project = ResearchProject::with('getUser')->where('id',$researchId)->whereHas('getUser')->first();
        return view('cms.student.research-project.detail', compact('project'));
    }

    public function changeStatus($researchId, $status)
    {
        $research = ResearchProject::findOrFail($researchId);

        $status === "approved" ? $flag = 'approved' : $flag = 'rejected';

        $research->update([
            'status' => $flag
        ]);

        Notification::create([
            'user_id' => $research->user_id,
            'type' => 'status-project-proposal',
            'message' => " project proposal request has been {$flag}."
        ]);

        event(new StatusChanged('project-proposal',$research));
        return response()->json(['msg' => "Successfully status updated", 'status' => ucfirst($flag)]);
    }

    public function uploadResearchTemplate(){
        return view('cms.upload-content.research-project');
    }

    public function uploadResearchTemplateData(){
        request()->validate([
            'template' => 'required|file|mimes:doc,pdf,docx',
        ]);

        $template = request()->file('template');
        $newResearchName = '';

        if (!empty($template)) {
            $newResearchName = 'research-project-' . Carbon::now()->timestamp . '.' . $template->getClientOriginalExtension();
            $template->storeAs('/public/uploads', $newResearchName);
        }

        UploadSample::create([
            'type' => 'research-project',
            'name' => $newResearchName
        ]);

        return redirect('/admin/upload-samples')->with('success','Successfully uploaded.');
    }
}
