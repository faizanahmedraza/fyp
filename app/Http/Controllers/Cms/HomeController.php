<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\InternShip;
use App\Models\ResearchProject;
use App\Models\ResearchProposal;
use App\Models\User;

class HomeController extends Controller
{
    public function index(){
        $users = User::with('roles')->get();
        $proposals = ResearchProposal::get();
        $activeUsers = $users->filter(function ($value){
            return $value->is_block === 0;
        })->count();
        $blockUsers = $users->filter(function ($value){
            return $value->is_block === 1;
        })->count();
        $admins = $users->filter(function ($value){
            return $value->roles()->first()->name === 'admin';
        })->count();
        $students = $users->filter(function ($value){
            return $value->roles()->first()->name === 'student';
        })->count();
        $researchers = $users->filter(function ($value){
            return $value->roles()->first()->name === 'researcher';
        })->count();
        $oricMembers = $users->filter(function ($value){
            return $value->roles()->first()->name === 'oric-member';
        })->count();
        $facultyMembers = $users->filter(function ($value){
            return $value->roles()->first()->name === 'faculty';
        })->count();
        $focalPersons = $users->filter(function ($value){
            return $value->roles()->first()->name === 'focal-person';
        })->count();
        $approvedProposals = $proposals->filter(function ($value){
            return $value->status === 'approved';
        })->count();
        $rejectedProposals = $proposals->filter(function ($value){
            return $value->status === 'rejected';
        })->count();
        $events = Event::count();
        $interns = InternShip::count();
        return view('cms.index',compact('activeUsers','blockUsers','approvedProposals','rejectedProposals','admins','students','researchers','oricMembers','facultyMembers','focalPersons','events','interns'));
    }
}
