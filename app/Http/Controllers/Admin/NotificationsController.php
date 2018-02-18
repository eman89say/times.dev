<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;


class NotificationsController extends Controller
{
    
     public function index()
     {
    	$not = auth()->user()->notifications;

    	return response()->view('admin.notifications.index', ['not'=>$not]);
    }

    public function markAsRead(Request $request)
    {
    	 Auth::user()->unreadNotifications->markAsRead();

      
      /// set unread notifications count to zero
       $output= 0;

             echo json_encode($output);

    }

   
}
