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

class StatusChanged implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    protected $type, $data;

    public function __construct($type,$data)
    {
        $this->type = $type;
        $this->data = $data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('student-name.' . $this->data->user_id);
    }

    public function broadcastAs()
    {
        return 'studentFormStatus';
    }

    public function broadcastWith()
    {
        $notify = Notification::where('user_id',$this->data->user_id)->with('getUser')->orderBy('created_at','DESC')->first();
        return [
            'data' => $notify,
            'minutes' => Carbon::createFromTimestamp(strtotime($notify->created_at))->diffForHumans()
        ];
    }
}
