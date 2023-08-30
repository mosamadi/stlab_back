<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\UserSusbcriber;

class UserSubscriberNotification extends Notification
{
    use Queueable;

    /**
     * @var UserSusbcriber
     */
    private $subscriber;

    /**
     * Create a new notification instance.
     *
     * @param UserSusbcriber $subcriber
     */
    public function __construct(UserSusbcriber $subcriber)
    {
        //
        $this->subscriber = $subcriber;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
            'message' => sprintf('%s (%s) subscribed to you!', $this->subscriber->name,
                $this->subscriber->subscription),
            'details' => ['type' => "subscribe", "item_id" => $this->subscriber->id],
            "created_at" => $this->subscriber->created_at,
        ];
    }
}
