<?php

namespace App\Http\View\Composers;

use App\Models\Notification;
use Illuminate\View\View;

class NotificationComposer
{
    public function compose(View $view)
    {
        $view->with('admin_notifications', Notification::whereNotIn('type',['status-project-proposal'])->where('is_read','=',0)->with('getUser')->latest()->get());
    }
}