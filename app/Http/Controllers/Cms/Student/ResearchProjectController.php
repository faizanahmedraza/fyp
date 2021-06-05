<?php

namespace App\Http\Controllers\Cms\Student;

use App\Events\StatusChanged;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\ResearchProject;
use App\Models\UploadSample;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ResearchProjectController extends Controller
{
    public function index()
    {
        $projects = ResearchProject::all();
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
            $newResearchName = 'research-project-' . Carbon::now()->timestamp . '.' . $upload_research->getClientOriginalExtension();
            $upload_research->storeAs('/public/uploads', $newResearchName);
            $studentData['upload_research'] = $newResearchName;
        }

        ResearchProject::create($studentData);

        return redirect('/admin/student/research-projects')->with('success','Successfully submitted.');
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
            $newResearchName = 'research-project-' . Carbon::now()->timestamp . '.' . $upload_research->getClientOriginalExtension();
            $upload_research->storeAs('/public/uploads', $newResearchName);
            $studentData['upload_research'] = $newResearchName;
        } else {
            $studentData['upload_research'] = $project->upload_research;
        }

        $project->update($studentData);

        return redirect('/admin/student/research-projects')->with('success','Successfully updated.');
    }

    public function researchDetail($researchId){
        $project = ResearchProject::with('getUser')->where('id',$researchId)->whereHas('getUser')->first();
        return view('cms.student.research-project.detail', compact('project'));
    }

    public function changeStatus($researchId, $status)
    {
        $msg = 'Something went wrong.';
        $code = 400;

        $research = ResearchProject::findOrFail($researchId);

        if ($status == 'approved') {
            $user = User::where('id',$research->user_id)->first();
            $studentId = sprintf("%04d", (int)$research->user_id);

            $user->update([
                'student_id' => $studentId,
            ]);

            $research->update([
                'status' => 'approved'
            ]);

            Notification::create([
                'user_id' => $research->user_id,
                'type' => 'status-approved',
                'message' => ' request has been approved.'
            ]);

            $msg = "Successfully status updated";
            $status = 'Approved';
            $code = 200;

        } else {
            $research->update([
                'status' => 'rejected'
            ]);
            Notification::create([
                'user_id' => $research->user_id,
                'type' => 'status-rejected',
                'message' => ' request has been rejected.'
            ]);
            $msg = "Successfully status updated";
            $status = 'Rejected';
            $code = 200;
        }

        event(new StatusChanged('apply',$research));
        return response()->json(['msg' => $msg, 'status' => $status], $code);
    }

    public function uploadResearchTemplate(){
        return view('cms.upload-content.research-project');
    }

    public function uploadResearchTemplateData(){
        \request()->validate([
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
