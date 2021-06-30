<?php


namespace App\Http\View\Composers;

use App\Models\Notification;
use Illuminate\View\View;

class StudentNotificationComposer
{
    public function compose(View $view)
    {
        $view->with('student_notifications', Notification::whereIn('type',['status-project-proposal'])->where('is_read','=',0)->with('getUser')->latest()->get());
    }
}