<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestProperty;

class NotificationController extends Controller
{

    public function markAsRead(RequestProperty $requestproperty)
    {
        $requestproperty->update(['read' => true]);

        return redirect()->back()->with('success', 'Notification marked as read successfully');

   
    }
}
