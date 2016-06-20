<?php

namespace App\Http\Controllers\Corporate;

use App\Notification;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NotificationsController extends CorporateController
{
    /**
     * @return mixed
     */
    public function index()
    {
        $notifications = $this->signedUser->notifications()->latest()->paginate(25);

        return view('corporate.notifications.index', compact('notifications'));
    }

    /**
     * @param Notification $notification
     * @return
     */
    public function read(Notification $notification)
    {
        $notification->unread = false;
        $notification->save();

        return redirect()->back()->with('success', 'notification marked as read successfully.');
    }
}
