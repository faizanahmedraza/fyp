<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\UploadSample;
use Illuminate\Http\Request;

class UploadSampleController extends Controller
{
    public function index(){
        $uploads = UploadSample::latest()->get();
        return view('cms.upload-content.index',compact('uploads'));
    }

    public function deleteUpload($uploadId){
        $msg = 'Something went wrong.';
        $code = 400;
        $upload = UploadSample::findOrFail($uploadId);

        if (!empty($upload)) {
            $upload->delete();
            $msg = "Successfully Deleted!";
            $code = 200;
        }
        return response()->json(['msg' => $msg], $code);
    }
}
