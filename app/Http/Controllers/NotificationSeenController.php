<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class NotificationSeenController extends Controller
{
    public function __invoke(DatabaseNotification $notification)
    {
        // dd(Auth::user());
        // dd($notification->notifiable_id);

        // if( Auth::user()->id == $notification->notifiable_id){
        //     dd('potaaa');
        // }

        $this->authorize('update', $notification);  

        $notification->markAsRead(); 

        return redirect()
        ->back()->with('success', 'Notification marked as read');
    }
}
