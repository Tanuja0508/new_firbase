<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\UserNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function sendNotification(Request $request): \Illuminate\Http\JsonResponse
    {
        //do your logic if any

        //any additional data if you want to send in notification.

        $data = [
            'title' => 'Notification Title',
        ];

        $subscribers = User::pluck('name', 'email')->toArray();

        Notification::route('mail', $subscribers) //Sending mail to subscribers
        ->notify(new UserNotify($data)); //With new post

        return response()->json([
            'success' => 'Mail Send Successfully'
        ]);
    }
}
