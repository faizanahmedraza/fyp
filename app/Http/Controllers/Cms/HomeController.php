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
    public function index()
    {
        $users = User::with('roles')->get();
        $proposals = ResearchProposal::get();
        $projects = ResearchProject::with('getProposal')->get();

        $students = $users->filter(function ($value) {
            return $value->roles()->first()->name === 'student';
        })->count();
        $researchers = $users->filter(function ($value) {
            return $value->roles()->first()->name === 'researcher';
        })->count();
        $oricMembers = $users->filter(function ($value) {
            return $value->roles()->first()->name === 'oric-member';
        })->count();
        $facultyMembers = $users->filter(function ($value) {
            return $value->roles()->first()->name === 'faculty';
        })->count();
        $focalPersons = $users->filter(function ($value) {
            return $value->roles()->first()->name === 'focal-person';
        })->count();
        $approvedFypProposals = $proposals->where('type', 'fyp')->filter(function ($value) {
            return $value->status === 'approved';
        })->count();
        $approvedFundedProposals = $proposals->where('type', 'funded')->filter(function ($value) {
            return $value->status === 'approved';
        })->count();
        $rejectedFypProposals = $proposals->where('type', 'fyp')->filter(function ($value) {
            return $value->status === 'rejected';
        })->count();
        $rejectedFundedProposals = $proposals->where('type', 'funded')->filter(function ($value) {
            return $value->status === 'rejected';
        })->count();
        $approvedFypProjects = $projects->where('type', 'fyp')->count();
        $approvedFundedProjects = $projects->where('type', 'funded')->count();
        $events = Event::count();
        $interns = InternShip::count();
        return view('cms.index', compact('approvedFypProposals', 'approvedFundedProposals', 'rejectedFypProposals', 'rejectedFundedProposals', 'students', 'researchers', 'oricMembers', 'facultyMembers', 'focalPersons', 'events', 'interns','approvedFypProjects', 'approvedFundedProjects'));
    }
}
