<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:student-notification-list|student-notification-detail', ['only' => ['index','detailNotification']]);
        $this->middleware('permission:student-notification-detail', ['only' => ['detailNotification']]);
    }

    public function index(){
        $notifications = Notification::latest()->get();
        return view('frontend.notifications.index',compact('notifications'));
    }

    public function deleteNotification($notificationId){
        $msg = "Something went wrong.";
        $code = 400;
        $notification = Notification::findOrFail($notificationId);

        if (!empty($notification)) {
            $notification->delete();
            $msg = "Successfully Removed!";
            $code = 200;
        }

        return response()->json(['msg' => $msg], $code);
    }

    public function detailNotification($notificationId){
        $notify = Notification::where('id',$notificationId)->first();

        if($notify->type === "apply-scholarship"){
            return redirect('/student/apply-for-scholarship');
        } else {
            return redirect('/student/claim-for-scholarship');
        }
    }
}
