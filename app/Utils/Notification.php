<?php

namespace App\Utils;
use Pusher\Pusher;

class Notification{
    public  $options = [
        'cluster' => 'eu',
        'useTLS' => true
    ];
  
    public static function send($id,$message)
    {   
        $pusher = new Pusher(
            config('broadcasting.connections.pusher.key') ,
            config('broadcasting.connections.pusher.secret'),
            config('broadcasting.connections.pusher.app_id'),
            // $this->options
        );

        $data =['from'=>$id];
        $pusher->trigger('my-channel', 'my-event', $data);

    }
}