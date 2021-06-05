<?php

namespace App\Http\Controllers\FrontEnd\Student;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\ResearchProject;
use App\Models\UploadSample;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ResearchProjectController extends Controller
{
    public function index()
    {
        $projects = ResearchProject::all();
        return view('frontend.student.research-project.index', compact('projects'));
    }

    public function addStudentResearch()
    {
        return view('frontend.student.research-project.add');
    }

    public function addStudentResearchData()
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
        $studentData['status'] = 'pending';
        $upload_research = request()->file('upload_research');

        if (!empty($upload_research)) {
            $newResearchName = 'research-project-' . Carbon::now()->timestamp . '.' . $upload_research->getClientOriginalExtension();
            $upload_research->storeAs('uploads', $newResearchName);
            $studentData['upload_research'] = $newResearchName;
        }

        ResearchProject::create($studentData);

        $admin = User::role('super-admin')->first()->id;

        Notification::create([
            'user_id' => Auth::id(),
            'type' => 'research-project',
            'message' => ' is send approval request of research project.'
        ]);

        event(new \App\Events\FormSubmitted('apply',$admin));

        return redirect('/student/research-projects')->with('success','Successfully submitted.');
    }

    public function downloadTemplate(){
        $template = $path = '';
        if(!empty(UploadSample::latest()->first()->name)){
            $template = UploadSample::latest()->first()->name;
            $path = Storage::url('uploads/'.!empty($template) ? $template : 'research-project.pdf');
        } else {
            abort(404);
        }
        return Response::download($path);
    }
}
