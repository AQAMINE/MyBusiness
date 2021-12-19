<?php

namespace App\Http\Traits;
use App\Models\Notification;

trait NotificationTrait{
    public function AddNotification($userid , $notificationContent){
        $notification = new Notification();
        $notification->user_id = $userid;
        $notification->notification = $notificationContent;
        $notification->save();
    }
}