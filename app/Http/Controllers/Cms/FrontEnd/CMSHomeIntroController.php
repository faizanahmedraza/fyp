<?php

namespace App\Http\Controllers\Cms\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\CMSHomeIntro;
use Illuminate\Support\Facades\Auth;


class CMSHomeIntroController extends Controller
{
    public function index()
    {
        $resultSet = CMSHomeIntro::get();
        return view('cms.website.pages.home.our-aim.index', compact('resultSet'));
    }

    public function addIntro()
    {
        return view('cms.website.pages.home.our-aim.add');
    }

    public function addIntroData()
    {
        request()->validate([
            'vision' => ['required', 'max:250'],
            'mission' => ['required', 'max:250'],
            'values' => ['required', 'max:250']
        ]);

        CMSHomeIntro::create([
            'vision' => request()->vision,
            'mission' => request()->mission,
            'values' => request()->values,
            'created_by' => Auth::id()
        ]);

        return redirect()->route('website.page.home.aim-intro')->with('success', 'Your data is successfully added!');
    }

    public function updateIntro($cmsIntroId)
    {
        $updateIntro = CMSHomeIntro::findOrFail($cmsIntroId);
        return view('cms.website.pages.home.our-aim.update', compact('updateIntro'));
    }

    public function updateIntroData($cmsIntroId)
    {
        $updateIntro = CMSHomeIntro::findOrFail($cmsIntroId);
        request()->validate([
            'vision' => ['required', 'max:250'],
            'mission' => ['required', 'max:250'],
            'values' => ['required', 'max:250']
        ]);

        $updateIntro->update([
            'vision' => request()->vision,
            'mission' => request()->mission,
            'values' => request()->values,
            'updated_by' => Auth::id()
        ]);

        return redirect()->route('website.page.home.aim-intro')->with('success', 'Your data is successfully updated!');
    }

    public function deleteIntro($cmsIntroId)
    {
        $msg = "Some thing went wrong!";
        $code = 400;
        $updateIntro = CMSHomeIntro::findOrFail($cmsIntroId)->first();
        if (!empty($updateIntro)) {
            $msgText = $updateIntro->is_disabled ? "enabled" : "disabled";
            $updateIntro->update(['is_disabled' => $updateIntro->is_disabled ? 0 : 1]);
            $msg = "Successfully {$msgText}!";
            $code = 200;
        }
        return response()->json(['msg' => $msg], $code);
    }
}
