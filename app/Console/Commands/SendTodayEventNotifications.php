<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendTodayEventNotifications extends Command
{
    protected $signature = 'send:today-event-notifications';

    protected $description = 'Send notifications for events happening today';

    public function handle()
    {
        $today = Carbon::today();
        $events = Event::whereDate('start', $today)->get();

        foreach ($events as $event) {
            $user = $event->user; // Assuming events are associated with users
            $user->notify(new TodayEventNotification($event));
        }
    }
}
