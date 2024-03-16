<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TodayEventNotification extends Notification
{
    use Queueable;


    protected $event;

    public function __construct($event)
    {
        $this->event = $event;
    }

    public function via($notifiable)
    {
        return ['database']; // Send via database
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'Event Notification',
            'body' => 'You have an event today:',
            'event_title' => $this->event->title,
            'start_time' => $this->event->start,
            'end_time' => $this->event->end,
        ];
    }

}
