<?php

namespace App\Notifications;

use App\Models\Donation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DonationNotification extends Notification
{
    use Queueable;

    /**
     * @var Donation
     */
    private $donation;

    /**
     * Create a new notification instance.
     *
     * @param Donation $donation
     */
    public function __construct(Donation $donation)
    {
        //
        $this->donation = $donation;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            'message' => sprintf('%s donated %u %s to you!', $this->donation->name, $this->donation->amount,
                $this->donation->currency),
            'details' => ['type' => "donation", "item_id" => $this->donation->id,
                'donation_message'=> $this->donation->donation_message
            ],
            "created_at" => $this->donation->created_at,
        ];
    }
}
