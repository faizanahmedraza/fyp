<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\UploadSample;
use Illuminate\Http\Request;

class UploadSampleController extends Controller
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

    public function deleteUpload($uploadId){
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
