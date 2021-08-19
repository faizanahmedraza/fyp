<?php

namespace App\Http\Controllers\Cms\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\InternShip;
use App\Models\RegisterIntern;
use Illuminate\Http\Request;

class RegisterInternController extends Controller
{
    public function index()
    {
        $internships = InternShip::withCount(['getRegisteredInterns' => function($query) {
            $query->where('status','registered');
        }])->whereHas('getRegisteredInterns', function ($query) {
            $query->where('status','registered');
        })->get();
        return view('cms.website.pages.internship.register-intern.index',compact('internships'));
    }

    public function detailIntern($registerInternId)
    {
        $registeredUsers = InternShip::with('getRegisteredInterns')->where('id',$registerInternId)->first();
        return view('cms.website.pages.internship.register-intern.detail',compact('registeredUsers'));
    }

    public function deleteIntern($registerInternId)
    {
        $msgTxt = "Something went wrong!";
        $code = 400;

        $event = RegisterIntern::findORFail($registerInternId);

        if(!empty($event))
        {
            $event->delete();
            $msgTxt = "Successfully Deleted.";
            $code = 200;
        }
        return response()->json(['msg' => $msgTxt],$code);
    }
}
