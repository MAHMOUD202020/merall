<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderNotifyEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $url;
    public $count;
    public $date;

    public function __construct($order)
    {
        $this->url = route('admin.order.show' , $order->id);
        $this->count = $order->product_count;
        $this->date = $order->created_at->format('Y.m.d H:i:s');
    }


    public function broadcastOn()
    {
        return ['order-notify'];
    }

//    public function broadcastAs()
//    {
//        return 'order-notify';
//    }
}
