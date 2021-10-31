<?php

namespace App\Http\Controllers\Cms\Student;

use App\Http\Controllers\Controller;
use App\Models\UploadSample;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class UploadProposalTemplate extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:upload-sample-list|upload-sample-delete', ['only' => ['index']]);
        $this->middleware('permission:upload-sample-delete', ['only' => ['deleteUpload']]);
    }

    public function index(){
        $uploads = UploadSample::latest()->get();
        return view('cms.upload-content.index',compact('uploads'));
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
            $newResearchName = 'project-proposal-' . Carbon::now()->timestamp . '.' . $template->getClientOriginalExtension();
            $template->storeAs('/public/uploads', $newResearchName);
        }

        UploadSample::create([
            'type' => 'project-proposal-form',
            'name' => $newResearchName
        ]);

        return redirect('/admin/research-proposal-template')->with('success','Successfully uploaded.');
    }

    public function deleteResearchTemplate($uploadId){
        $msg = 'Something went wrong.';
        $code = 400;
        $upload = UploadSample::findOrFail($uploadId);

        if (!empty($upload)) {
            $msgText = $upload->is_disabled ? "enabled" : "disabled";
            $upload->update(['is_disabled' => $upload->is_disabled ? 0 : 1]);
            $msg = "Successfully {$msgText}!";
            $code = 200;
        }
        return response()->json(['msg' => $msg], $code);
    }
}
