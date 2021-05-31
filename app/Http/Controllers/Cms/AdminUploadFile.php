<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminUploadFile extends Controller
{
    public function researchTemplate(){
        return view('cms.upload-content.research-project');
    }

    public function addResearchTemplate(){
        return 'Working in Progress...';
    }
}
