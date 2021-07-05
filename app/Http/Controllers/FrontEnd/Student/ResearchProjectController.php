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
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ResearchProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:student-project-proposal-list|student-project-proposal-create', ['only' => ['index', 'addStudentResearchData']]);
        $this->middleware('permission:student-project-proposal-create', ['only' => ['addStudentResearch', 'addStudentResearchData']]);
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
            'amount' => 'required|digits_between:1,8',
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
            $newResearchName = uniqid('research-project-') . '.' . $upload_research->getClientOriginalExtension();
            if(!File::isDirectory(storage_path('app/public/uploads'))){
                File::makeDirectory(storage_path('app/public/uploads'),0755, true);
            }
            Storage::putFileAs('public/uploads',$upload_research,$newResearchName);
            $studentData['upload_research'] = $newResearchName;
        }

        ResearchProject::create($studentData);

        $admin = User::role('super-admin')->first()->id;

        Notification::create([
            'user_id' => Auth::id(),
            'type' => 'project-proposal',
            'message' => ' is send approval request of research project.'
        ]);

        event(new \App\Events\FormSubmitted('apply', $admin));

        return redirect('/user/research-projects')->with('success', 'Successfully submitted.');
    }

    public function detailStudentResearch($researchId)
    {
        $research = ResearchProject::findOrFail($researchId);
        return view('frontend.student.research-project.detail', compact('research'));
    }

    public function downloadTemplate()
    {
        $template = $path = '';
        if (!empty(UploadSample::latest()->first()->name)) {
            $template = UploadSample::latest()->first()->name;
            $path = Storage::url('uploads/' . !empty($template) ? $template : 'research-project.pdf');
        } else {
            abort(404);
        }
        return Response::download($path);
    }
}
