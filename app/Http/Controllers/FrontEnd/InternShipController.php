<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\InternShip;
use App\Models\RegisterIntern;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InternShipController extends Controller
{
    public function index()
    {
        $internships = InternShip::with(['getRegisteredInterns' => function ($query) {
            $query->where('status', 'registered')->where('deleted_at', null);
        }])->get();
        return view('frontend.internship.index', compact('internships'));
    }

    public function authUserInternRegister($internshipId = '')
    {
        $user = RegisterIntern::where('internship_id', $internshipId)->where('user_id', Auth::id())->first();
        $msgTxt = "registered";
        if (!empty($user)) {
            if ($user->status === "un-registered") {
                $status = "registered";
            } else {
                $status = "un-registered";
            }
            $user->update(['status' => $status]);
            $msgTxt = str_replace('-', '', $status);
        } else {
            $data['internship_id'] = (int)request()->internshipId;
            $data['user_id'] = Auth::id();
            $data['status'] = "registered";
            RegisterIntern::create($data);
        }
        return response()->json(['msg' => "You successfully {$msgTxt}!"], 200);
    }

    public function guestUserInternRegister()
    {
        RegisterIntern::updateOrCreate([
            'internship_id' => request()->internId,
            'guest_email' => request()->guestEmail,
            'visitor_ip' => request()->ip()
        ],[ 'guest_name' => request()->guestName,'status' => 'registered']);
        return response()->json(['msg' => "You successfully applied \n We are excited to see you here!"], 200);
    }
}
