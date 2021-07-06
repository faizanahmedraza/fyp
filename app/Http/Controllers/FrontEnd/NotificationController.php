<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user-notification-list|user-notification-detail', ['only' => ['index','detailNotification']]);
        $this->middleware('permission:user-notification-detail', ['only' => ['detailNotification']]);
    }

    public function index(){
        $notifications = Notification::where('user_id',Auth::id())->whereIn('type',['status-project-proposal'])->latest()->get();
        foreach ($notifications as $val){
            $val->update([
                'is_read' => 1
            ]);
        }
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

        $notify->update([
            'is_read' => 1,
        ]);

        session()->forget('notification');

        if($notify->type === "status-project-proposal"){
            return redirect('/user/research-projects')->with('notification',$notify);
        }
    }
}
