<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\InternShip;
use App\Models\RegisterIntern;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InternShipController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user-internship-list', ['only' => 'index']);
    }

    public function index()
    {
        $internships = InternShip::with(['getRegisteredInterns' => function ($query) {
            $query->where('status', 'registered')->where('deleted_at', null);
        }])->get();
        return view('frontend.internship.index', compact('internships'));
    }

    public function authUserInternRegister($internshipId = '')
    {
        $intern = InternShip::firstOrFail(request()->internId);
        $internDate = explode(' - ', $intern->duration);
        if ($internDate[0] == now()->format('Y-m-d')) {
            $msg = "Whoops! Registrations are closed now. We will start back soon!";
            $code = 422;
        } else {
            $code = 200;
            $user = RegisterIntern::where('internship_id', $internshipId)->where('user_id', Auth::id())->first();
            if (!empty($user)) {
                if ($user->status === "un-registered") {
                    $status = "registered";
                } else {
                    $status = "un-registered";
                }
                $user->update(['status' => $status]);
                $msg = "You successfully " . str_replace('-', '', $status);
            } else {
                $msg = "You successfully registered!";
                $data['internship_id'] = (int)request()->internshipId;
                $data['user_id'] = Auth::id();
                $data['status'] = "registered";
                RegisterIntern::create($data);
            }
        }
        return response()->json(['msg' => $msg], $code);
    }

    public function guestUserInternRegister()
    {
        $intern = InternShip::where('id',request()->internId)->firstOrFail();
        $internDate = explode(' - ', $intern->duration);
        if ($internDate[0] == now()->format('Y-m-d')) {
            $msg = "Whoops! Registrations are closed now. We will start back soon!";
            $code = 422;
        } else {
            $msg = "You successfully applied \n We are excited to see you here!";
            $code = 200;
            RegisterIntern::updateOrCreate([
                'internship_id' => request()->internId,
                'guest_email' => request()->guestEmail,
                'visitor_ip' => request()->ip()
            ], ['guest_name' => request()->guestName, 'status' => 'registered']);
        }
        return response()->json(['msg' => $msg], $code);
    }
}
