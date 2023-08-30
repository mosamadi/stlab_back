<?php

namespace App\Listeners;

use App\Models\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Notifications\Events\NotificationSent as NotificationSentAlias;
use Illuminate\Queue\InteractsWithQueue;

class NotificationSentListener implements ShouldQueue
{
    use Queueable;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NotificationSent  $event
     * @return void
     */
    public function handle(NotificationSentAlias $event)
    {
        //
        $notification = Notification::find( $event->notification->id);
        if ($notification->data["created_at"]){
            $notification->created_at = $notification->data["created_at"];
            $notification->save();
        }
    }
}
