<?php

namespace App\Observers;

use App\Models\MerchSale;

class MerchSaleObserver
{
    /**
     * Handle the MerchSale "created" event.
     *
     * @param  \App\Models\MerchSale  $merchSale
     * @return void
     */
    public function created(MerchSale $merchSale)
    {
        //
    }

    /**
     * Handle the MerchSale "updated" event.
     *
     * @param  \App\Models\MerchSale  $merchSale
     * @return void
     */
    public function updated(MerchSale $merchSale)
    {
        //
    }

    /**
     * Handle the MerchSale "deleted" event.
     *
     * @param  \App\Models\MerchSale  $merchSale
     * @return void
     */
    public function deleted(MerchSale $merchSale)
    {
        //
    }

    /**
     * Handle the MerchSale "restored" event.
     *
     * @param  \App\Models\MerchSale  $merchSale
     * @return void
     */
    public function restored(MerchSale $merchSale)
    {
        //
    }

    /**
     * Handle the MerchSale "force deleted" event.
     *
     * @param  \App\Models\MerchSale  $merchSale
     * @return void
     */
    public function forceDeleted(MerchSale $merchSale)
    {
        //
    }
}
