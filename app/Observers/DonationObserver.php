<?php

namespace App\Observers;

use App\Models\Donation;
use App\Notifications\DonationNotification;
use Illuminate\Support\Facades\Notification;

class DonationObserver
{
    /**
     * Handle the Donation "created" event.
     *
     * @param  \App\Models\Donation  $donation
     * @return void
     */
    public function created(Donation $donation)
    {
        //
        Notification::send($donation->user()->get(),new DonationNotification($donation));
    }

    /**
     * Handle the Donation "updated" event.
     *
     * @param  \App\Models\Donation  $donation
     * @return void
     */
    public function updated(Donation $donation)
    {
        //
    }

    /**
     * Handle the Donation "deleted" event.
     *
     * @param  \App\Models\Donation  $donation
     * @return void
     */
    public function deleted(Donation $donation)
    {
        //
    }

    /**
     * Handle the Donation "restored" event.
     *
     * @param  \App\Models\Donation  $donation
     * @return void
     */
    public function restored(Donation $donation)
    {
        //
    }

    /**
     * Handle the Donation "force deleted" event.
     *
     * @param  \App\Models\Donation  $donation
     * @return void
     */
    public function forceDeleted(Donation $donation)
    {
        //
    }
}
