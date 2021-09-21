<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Jobs\SendInquiryEmailJob;
use App\Models\CMSInquiry;
use App\Models\User;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function storeInquiry(){

        request()->validate([
            'name' => ['required','max:55'],
            'email' => ['required','email'],
            'phone' => ['sometimes', 'nullable', 'numeric', 'digits_between:10,13'],
            'subject' => ['required','max:200'],
            'message' => ['required', 'max:800']
        ]);

        CMSInquiry::create([
            'name' => request()->name,
            'email' => request()->email,
            'contact' => request()->phone,
            'subject' => request()->subject,
            'message' => request()->message,
        ]);

        return back()->with('success', 'Successfully submitted your message.');
    }
}
