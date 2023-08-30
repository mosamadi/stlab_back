<?php

namespace App\Notifications;

use App\Models\MerchSale;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MerchSaleNotification extends Notification
{
    use Queueable;

    /**
     * @var MerchSale
     */
    private $merchSale;

    /**
     * Create a new notification instance.
     *
     * @param MerchSale $merchSale
     */
    public function __construct(MerchSale $merchSale)
    {
        //
        $this->merchSale = $merchSale;
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
            'message' => sprintf('%s bought %s %s from you for %u USD!', $this->merchSale->name,
                $this->merchSale->amount,$this->merchSale->item_name, $this->merchSale->price),
            'details' => ['type' => "merch_sale", "item_id" => $this->merchSale->id
            ],
            "created_at" => $this->merchSale->created_at,
        ];
    }
}
