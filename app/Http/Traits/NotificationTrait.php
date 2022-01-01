<?php

namespace App\Http\Traits;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

trait NotificationTrait{
    public function AddNotification($userid , $notificationContent){
        $notification = new Notification();
        $notification->user_id = $userid;
        $notification->notification = $notificationContent;
        $notification->save();
    }
    public function NotificationCounter(){
        return Notification::where('user_id',Auth::id())->count();
    }
}
