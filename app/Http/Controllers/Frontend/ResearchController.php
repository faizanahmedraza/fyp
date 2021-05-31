<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ResearchController extends Controller
{
    public function index(){
        return view('frontend.student.research.index');
    }

    public function downloadTemplate(){
        $path = public_path().'/storage/research-project.pdf';
        if (file_exists($path)) {
            return Response::download($path);
        }
    }

    public function addData(){
        return;
    }
}
