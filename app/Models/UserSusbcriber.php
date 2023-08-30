<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSusbcriber extends Model
{
    use HasFactory;
    protected $table = 'susbcribers';
    protected $fillable = ['user_id', 'name', 'subscription','created_at'];
    const SUBSCRIPTION_TIER1 = "Tier1";
    const SUBSCRIPTION_TIER2 = "Tier2";
    const SUBSCRIPTION_TIER3 = "Tier3";

    const SUBSCRIPTION_TIER1_PRICE = 5;
    const SUBSCRIPTION_TIER2_PRICE = 10;
    const SUBSCRIPTION_TIER3_PRICE = 15;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getPrice()
    {
        $price = 0;
        switch ($this->subscription) {
            case self::SUBSCRIPTION_TIER1:
                $price = self::SUBSCRIPTION_TIER1_PRICE;
                break;
            case self::SUBSCRIPTION_TIER2:
                $price = self::SUBSCRIPTION_TIER2_PRICE;
                break;
            case self::SUBSCRIPTION_TIER3:
                $price = self::SUBSCRIPTION_TIER3_PRICE;
                break;

        }

        return $price;
    }
}
