<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        return view('cms.index');
    }
}
