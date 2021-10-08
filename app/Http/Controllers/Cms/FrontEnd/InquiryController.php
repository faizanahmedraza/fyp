<?php

namespace App\Http\Controllers\Cms\FrontEnd;

use App\Http\Controllers\Controller;
use App\Jobs\SendInquiryEmailJob;
use App\Models\CMSInquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:inquiry-list', ['only' => ['index','inquiryDetail','submitAnswer']]);
    }

    public function index()
    {
        $inquires = CMSInquiry::where('is_answer',0)->latest()->get();
        return view('cms.website.pages.inquiry.index',compact('inquires'));
    }

    public function inquiryDetail($inquiryId)
    {
        $inquiry = CMSInquiry::findOrFail($inquiryId);
        return view('cms.website.pages.inquiry.detail',compact('inquiry'));
    }

    public function submitAnswer()
    {
        $inquiry = CMSInquiry::findOrFail((int)request()->inquiryId);
        request()->validate([
            'message' => ['required','max:1000']
        ]);
        $data['name'] = $inquiry->name;
        $data['subject'] = $inquiry->subject;
        $data['message'] = request()->message;
        $inquiry->update([
            'is_answer' => 1
        ]);
        dispatch(new SendInquiryEmailJob($inquiry->email,$data));
        return response()->json(['msg' => 'Successfully send message.']);
    }
}
