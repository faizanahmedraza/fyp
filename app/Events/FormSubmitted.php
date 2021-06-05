<?php

namespace App\Events;

use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FormSubmitted implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    protected $type, $adminId;

    public function __construct($type, $adminId)
    {
        $this->type = $type;
        $this->adminId = $adminId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('student-name.' . $this->adminId);
    }

    public function broadcastAs()
    {
        return 'studentFormSubmitted';
    }

    public function broadcastWith()
    {
        $notify = Notification::with('getUser')->orderBy('created_at','DESC')->first();

        return [
            'data' => $notify,
            'minutes' => Carbon::createFromTimestamp(strtotime($notify->created_at))->diffForHumans()
        ];
    }
}
