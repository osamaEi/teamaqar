<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\RequestProperty;

class NotificationController extends Controller
{

    public function getReminders()
    {
        $today = Carbon::now()->startOfDay();
        $reminders = Event::whereDate('start', '=', $today)
            ->where('read', false)
            ->get();

        // Format reminder time
        foreach ($reminders as $reminder) {
            $reminder->formatted_time = $this->formatTime($reminder->start);
        }

        return $reminders;
    }

    private function formatTime($contactDatetime)
    {
        $contactTime = Carbon::parse($contactDatetime)->locale('ar');

        if ($contactTime->isToday()) {
            return 'اليوم في ' . $contactTime->isoFormat('h:i a');
        } elseif ($contactTime->isYesterday()) {
            return 'أمس في ' . $contactTime->isoFormat('h:i a');
        } else {
            return $contactTime->isoFormat('Y-m-d h:i a');
        }
    }


    public function markAsRead(Event $event)
    {
        $event->update(['read' => true]);

        return redirect()->back();
 
    }
}
